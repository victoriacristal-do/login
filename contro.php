<?php
/* A continuación, realizamos la conexión con nuestra base de datos en MySQL */ 
//$link = mysql_connect("localhost","root","");
include ("conexion.php");

//mysql_select_db("sesion", $link); 

/* El query valida si el usuario ingresado existe en la base de datos. Se utiliza la función htmlentities para evitar inyecciones SQL. */ 



$myusuario = $mysqli->query("SELECT id from usuario where usuario = '".htmlentities($_POST["usuario"])."'");

$nmyusuario = $myusuario->num_rows;

//$reg =mysqli_fetch_array($myusuario); 

//Si existe el usuario, validamos también la contraseña ingresada y el estado del usuario... 
if($nmyusuario != 0)
{
  //$passHash = password_hash($_POST["clave"], PASSWORD_BCRYPT);
  //$hash=password_hash(htmlentities($_POST["clave"]), PASSWORD_BCRYPT)."\n";
  //$pass=password_verify($reg['password'], $hash);
  $sql = "SELECT password from usuario where usuario = '".htmlentities($_POST["usuario"])."' "; 
  $myclave = $mysqli->query($sql);
  $fila = $myclave->fetch_object();
  print_r($fila);
  print_r($_POST["pass"]);
  $verify = password_verify($_POST["pass"], ($fila->password));
  print_r($verify);
  $passHash = password_hash(1234567, PASSWORD_BCRYPT);
  print_r($passHash);
  //$finfo = $myclave->fetch_field();

//if (password_verify($_POST["password"], ($fila->password))) 
//{
  // echo '¡La contraseña es válida!';
//}
  
  //$nmyclave = $myclave->num_rows; 
  //Si el usuario y clave ingresado son correctos (y el usuario está activo en la BD), creamos la sesión del mismo. 
  //if($nmyclave != 0)
  if (password_verify($_POST["pass"], ($fila->password))){ 
      session_start(); 
      //Guardamos dos variables de sesión que nos auxiliará para saber si se está o no "logueado" un usuario 
      $_SESSION["autentica"] = "SIP";
      $sql = "SELECT * from usuario where usuario = '".htmlentities($_POST["usuario"])."' "; 
      $myclave = $mysqli->query($sql);
      $fila = $myclave->fetch_object();
      $_SESSION["usuarioactual"] = $fila->usuario;//mysql_result($myclave,0,1); 
      
      //nombre del usuario logueado. 
      //Direccionamos a nuestra página principal del sistema. 
      //header ("Location: paginaprincipal.php"); 
   }else{ 
      echo"<script>alert('La contrase\u00f1a del usuario no es correcta.'); 
      //window.location.href=\"index.php\"</script>";

      
      
   } 
  //} else {
  //  echo 'La contraseña no es válida.';
    
  //  }
}
else
{ 
    echo"<script>alert('El usuario no existe.');
      window.location.href=\"index.php\"</script>";
} 
mysqli_close($mysqli); 
?>