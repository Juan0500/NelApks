<?php
include "../conexion.php";
session_start();

//Registrarse
if (isset($_POST['Registrar'])) {
    $Nombres=$_POST['Nombres'];
    $Apellidos=$_POST['Apellidos'];
    $Correo=$_POST['Correo'];
    $Password=$_POST['Password'];

    $Foto="Fotos/user_icon.png";

    $sql="INSERT INTO usuarios(Nombres, Apellidos, Correo, Password, Foto)VALUES('$Nombres', '$Apellidos', '$Correo', '$Password', '$Foto')";
    $res=mysqli_query($conn,$sql);
    if ($res) {
       $_SESSION['Correo'] = $Correo;
       $_SESSION['Register_success'] = 1;

       //Comprobar si vino del menu de seleccion
       $IDApp = $_POST['IDApp'];
       $Tipo = $_POST['Tipo'];
       if ($IDApp != "" && $Tipo != "") {
           header('location:../pages/Seleccion.php?/='.$Tipo.'&id='.$IDApp);
       }
       else{
           header('location:../pages/juegos.php');
       }
    }
    else{
        //header('location:../pages/Login.php');
        echo $Nombres. '<br>' . $Apellidos. '<br>' .$Correo. '<br>' .$Password;
    }
}

//Login
if (isset($_POST['Login'])) {
    $Correo = $_POST['Correo'];
    $Password= $_POST['Password'];

    if (is_numeric($Correo)) {
        $sql="SELECT * FROM admin WHERE Cedula=$Correo AND Password LIKE BINARY '$Password'";
        $res=mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($res);
        if ($num_rows == 1) {
            $_SESSION['success_login'] = 1;
            $_SESSION['Cedula'] = $Correo;
            $_SESSION['success_login'] = 1;

            //Comprobar si vino del menu de seleccion
            $IDApp = $_POST['IDApp'];
            $Tipo = $_POST['Tipo'];
            if ($IDApp != "" && $Tipo != "") {
                unset($_SESSION['VolverJuego']);
                unset($_SESSION['VolverJuego2']);
                header('location:../pages/Seleccion.php?/='.$Tipo.'&id='.$IDApp);
            }
            else{
                header('location:../pages/juegos.php');
            }
        }
        else{
            $_SESSION['Correo_e'] = $Correo;
            $_SESSION['login_error'] = 1;
            header('location:../pages/Login.php');

        }
        
    }
    else{
        $sql = "SELECT * FROM usuarios WHERE Correo='$Correo' AND Password LIKE BINARY '$Password'";
        $res=mysqli_query($conn,$sql);
        $num_rows=mysqli_num_rows($res);
        if ($num_rows == 1) {
            $_SESSION['success_login'] = 1;
            $_SESSION['Correo'] = $Correo;

            //Comprobar si vino del menu de seleccion
            $IDApp = $_POST['IDApp'];
            $Tipo = $_POST['Tipo'];
            if ($IDApp != "" && $Tipo != "") {
                header('location:../pages/Seleccion.php?/='.$Tipo.'&id='.$IDApp);
            }
            else{
                header('location:../pages/juegos.php');
            }
        }
        else{
            $_SESSION['Correo_e'] = $Correo;
            $_SESSION['login_error'] = 1;
            header('location:../pages/Login.php');

        }
    }
}

//Cerrar Sesión
if (isset($_GET['cs'])) {
    if (isset($_SESSION['Cedula'])) {
        unset($_SESSION['Cedula']);
        unset($_SESSION['VolverJuego']);
        unset($_SESSION['VolverJuego2']);
    }
    else {
        unset($_SESSION['Correo']);
        unset($_SESSION['VolverJuego']);
        unset($_SESSION['VolverJuego2']);
    }
    header('location:../pages/juegos.php');
}

//Modificar Icono de Usuario
if (isset($_POST['ModificarIconoUser'])) {
    $ID = $_POST['IDUsuario'];
    $FotoAnterior = $_POST['FotoAnterior'];

    $NumeroAleatorio1 = mt_rand(0, 9);
    $NumeroAleatorio2 = mt_rand(0, 9);
    $NumeroAleatorio3 = mt_rand(0, 9);
    $NumeroAleatorio4 = mt_rand(0, 9);

     /////NUEVO Icono

     //Nombre
     $Icono=$_FILES['NuevoIcono']['name'];

     //URL Temporal
     $url_temp_Icono=$_FILES['NuevoIcono']['tmp_name'];

     //URL Guardar
     $url_insert_Icono = "Fotos";

     //URL Guardar 2
     $url_target_Icono = str_replace('\\', '/', $url_insert_Icono) . '/'. '-' .$NumeroAleatorio1 . $NumeroAleatorio2 . $NumeroAleatorio3 . $NumeroAleatorio4 . '-' . $Icono ;

     //Crear Carpeata si no existe
     if (!file_exists($url_insert_Icono)) {
         mkdir($url_insert_Icono, 0777, true);
     };

     //Mover Imagenes de temporal a la Carpeta donde quedaran alojada
     if (!move_uploaded_file($url_temp_Icono, $url_target_Icono)) {
         echo "hubo un error al cargar tu archivo.";
     }    

    ///////////////////////////////////////////////
    
    
    $sql = "UPDATE usuarios SET Foto = '$url_target_Icono' WHERE ID=$ID";
    $res = mysqli_query($conn,$sql);
    if ($res) {
     if (file_exists($FotoAnterior)) {
        if ($FotoAnterior != "Fotos/user_icon.png") {
            unlink($FotoAnterior);
        }
     }
     $_SESSION['mod_Icono_success'] = 1;
     header('location:../pages/Configuraciones.php');
     
    }
    else{
     echo "error al guardar";
    }
}

?>