<?php
$servername = 'localhost';
$username= 'root';
$password= '';
$bdname='nelapks';
$conn = new mysqli($servername, $username, $password, $bdname);
$conn->set_charset("utf8");
if (!$conn) {
   ?>
   <script>
    alert("Error de conexion");
   </script>
   <?php 
}

?>