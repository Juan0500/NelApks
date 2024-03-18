<?php
include "../conexion.php";
session_start();

//GUARDAR JUEGO
if (isset($_POST['GuardarJuego'])) {
    $Nombre=$_POST['Nombre'];
    $Genero=$_POST['Genero'];
    $Version=$_POST['Version'];
    $Actualizacion=$_POST['Actualizacion'];
    $Requisitos=$_POST['Requisitos'];
    $URL=$_POST['URL'];
    $Detalle=$_POST['Detalles'];
    $Desarollador=$_POST['Desarollador'];
    $TipoApp=$_POST['TipoApp'];
    $URLAPK = $_POST['URLAPK'];

    //////IMAGENES
        //Nombre
        $Icono=$_FILES['Icono']['name'];
        $Poster=$_FILES['Poster']['name'];

        //URL Temporal
        $url_temp_Icono=$_FILES['Icono']['tmp_name'];
        $url_temp_Poster=$_FILES['Poster']['tmp_name'];

        //URL Guardar
        $url_insert_Icono = "Iconos";
        $url_insert_Poster = "Posters";

        //URL Guardar 2
        $url_target_Icono = str_replace('\\', '/', $url_insert_Icono) . '/' . $Icono;
        $url_target_Poster = str_replace('\\', '/', $url_insert_Poster) . '/' . $Poster;

        //Crear Carpeata si no existe
        if (!file_exists($url_insert_Icono)) {
            mkdir($url_insert_Icono, 0777, true);
        };
        if (!file_exists($url_insert_Poster)) {
            mkdir($url_insert_Poster, 0777, true);
        };

        //Mover Imagenes de temporal a la Carpeta donde quedaran alojada
        if (!move_uploaded_file($url_temp_Icono, $url_target_Icono)) {
            echo "error al cargar tu archivo.";
        }

        if (!move_uploaded_file($url_temp_Poster, $url_target_Poster)) {
            echo "error al cargar tu archivo.";
        }

    ///////////////////////////////////////////////
    
    


    if ($TipoApp == "Juego") {
        $sql="INSERT INTO apps(Nombre, Detalles, Icono, Poster, Version, Actualizacion, Requisitos, Genero, apk, URL, Desarollador, Tipo)VALUES('$Nombre', '$Detalle', '$url_target_Icono', '$url_target_Poster', '$Version', '$Actualizacion', '$Requisitos', '$Genero', '$URLAPK', '$URL', '$Desarollador', 'Juego')";
        $res= mysqli_query($conn,$sql);
    
        if ($res) {
            header('location:../pages/juegos.php');
        }        
    }
    else{
        $sql="INSERT INTO apps(Nombre, Detalles, Icono, Poster, Version, Actualizacion, Requisitos, Genero, apk, URL, Desarollador, Tipo)VALUES('$Nombre', '$Detalle', '$url_target_Icono', '$url_target_Poster', '$Version', '$Actualizacion', '$Requisitos', '$Genero', '$URLAPK', '$URL', '$Desarollador', 'App')";
        $res= mysqli_query($conn,$sql);
    
        if ($res) {
            header('location:../pages/apps.php');
        }        
        
    }



}

//MODIFICAR APK
if (isset($_POST['ModificarAPK'])) {
    $ID = $_POST['IDApp'];
    $tipo = $_POST['tipo'];
    $URLAPK=$_POST['NuevaAPK'];
    
    $sql = "UPDATE apps SET apk = '$URLAPK' WHERE ID=$ID";
    $res = mysqli_query($conn,$sql);
    if ($res) {
        $_SESSION['mod_apk_success'] = 1;
        header('location:../pages/Seleccion.php?/='.$tipo.'&id='.$ID);
    
    }
    else{
        echo "error al guardar";
    }
    
    
}

//MODIFICAR Icono
if (isset($_POST['ModificarIcono'])) {
    $ID = $_POST['IDApp'];
    $IconoAnterior = $_POST['Icono'];
    $tipo = $_POST['tipo'];
    /////NUEVO Icono

     //Nombre
     $Icono=$_FILES['NuevoIcono']['name'];

     //URL Temporal
     $url_temp_Icono=$_FILES['NuevoIcono']['tmp_name'];

     //URL Guardar
     $url_insert_Icono = "Iconos";

     //URL Guardar 2
     $url_target_Icono = str_replace('\\', '/', $url_insert_Icono) . '/' . $Icono;

     //Crear Carpeata si no existe
     if (!file_exists($url_insert_Icono)) {
         mkdir($url_insert_Icono, 0777, true);
     };

     //Mover Imagenes de temporal a la Carpeta donde quedaran alojada
     if (!move_uploaded_file($url_temp_Icono, $url_target_Icono)) {
         echo "hubo un error al cargar tu archivo.";
     }    

    ///////////////////////////////////////////////
    
    //ELIMINAR Icono ANTERIOR
    
       $sql = "UPDATE apps SET Icono = '$url_target_Icono' WHERE ID=$ID";
       $res = mysqli_query($conn,$sql);
       if ($res) {
        if (file_exists($IconoAnterior)) {
            unlink($IconoAnterior);
        }
        $_SESSION['mod_Foto_success'] = 1;
        header('location:../pages/Seleccion.php?/='.$tipo.'&id='.$ID);
        
       }
       else{
        echo "error al guardar";
       }
    
    
}

//MODIFICAR POSTER
if (isset($_POST['ModificarPoster'])) {
    $ID = $_POST['IDApp'];
    $PosterAnterior = $_POST['Poster'];
    $tipo = $_POST['tipo'];
    /////NUEVO Poster

     //Nombre
     $Poster=$_FILES['NuevoPoster']['name'];

     //URL Temporal
     $url_temp_Poster=$_FILES['NuevoPoster']['tmp_name'];

     //URL Guardar
     $url_insert_Poster = "Posters";

     //URL Guardar 2
     $url_target_Poster = str_replace('\\', '/', $url_insert_Poster) . '/' . $Poster;

     //Crear Carpeata si no existe
     if (!file_exists($url_insert_Poster)) {
         mkdir($url_insert_Poster, 0777, true);
     };

     //Mover Imagenes de temporal a la Carpeta donde quedaran alojada
     if (!move_uploaded_file($url_temp_Poster, $url_target_Poster)) {
         echo "hubo un error al cargar tu archivo.";
     }    

    ///////////////////////////////////////////////
    
    //ELIMINAR Poster ANTERIOR
    
       $sql = "UPDATE apps SET Poster = '$url_target_Poster' WHERE ID=$ID";
       $res = mysqli_query($conn,$sql);
       if ($res) {
        if (file_exists($PosterAnterior)) {
            unlink($PosterAnterior);
        }
        $_SESSION['mod_Poster_success'] = 1;
        header('location:../pages/Seleccion.php?/='.$tipo.'&id='.$ID);
        
       }
       else{
        echo "error al guardar";
       }
    
    
}