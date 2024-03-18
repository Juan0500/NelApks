<?php
include "../conexion.php";

//HEADER

    if (isset($_POST['EliminarAppGame'])) {
        $IdApp = $_POST['IDGameOrApp'];
        $sql = "DELETE FROM apps WHERE ID = $IdApp";
        $res = mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }

//SELECCION
    if (isset($_POST['Buscar_Generos'])) {
    $sql="SELECT * FROM generos";
    $res= mysqli_query($conn,$sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $ID = $row['ID'];
            $Nombre = $row['Nombre'];

            ?>
            <option value="<?php echo $ID ?>"> <?php echo $Nombre ?> </option>
            <?php
        }
    }
    }
    if (isset($_POST['VerificarCorreo'])) {
        $Correo = $_POST['Correo'];
        $sql="SELECT * FROM usuarios WHERE Correo='$Correo'";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        echo $num_rows;
    }
    //LIKES
    if (isset($_POST['VerificarLike'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $IDComentario = $_POST['IDComentario'];
        $sql="SELECT * FROM likes WHERE IDUsuarios=$IDUsuario AND IDComentario=$IDComentario";
        $result = mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($result);
        echo $num_rows;
    }
    if (isset($_POST['AgregarLike'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $IDComentario = $_POST['IDComentario'];

        $sql="INSERT INTO likes(IDComentario, IDUsuarios) VALUES ($IDComentario,$IDUsuario)";
        $res = mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 2;
        }
    }
    if (isset($_POST['QuitarLike'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $IDComentario = $_POST['IDComentario'];

        $sql="DELETE FROM likes WHERE IDUsuarios=$IDUsuario AND IDComentario=$IDComentario";
        $res = mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 2;
        }
    }
    ///////////////
    //Comentarios
    if (isset($_POST['GuardarComentario'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $IDApp = $_POST['IDApp'];
        $Comentario = $_POST['Comentario'];
        $Estrellas = $_POST['Estrellas'];
        date_default_timezone_set('America/Montevideo');
        $Fecha = date('Y-m-d H:i:s');

        $SQLP="SELECT * FROM comentarios WHERE IDUsuario = $IDUsuario AND Comentario='$Comentario'";
        $RESP=mysqli_query($conn,$SQLP);
        $cantRow = mysqli_num_rows($RESP);
        if ($cantRow > 0) {
           echo 404;
        }
        else {
            $sql="INSERT INTO comentarios(IDUsuario, IDApp, Comentario, Fecha, Estrellas)VALUES($IDUsuario, $IDApp, '$Comentario', '$Fecha', '$Estrellas')";
            $res = mysqli_query($conn,$sql);
            if ($res) {
                $sql2="SELECT * FROM comentarios WHERE IDUsuario=$IDUsuario AND IDApp = $IDApp AND Comentario='$Comentario'";
                $res2=mysqli_query($conn,$sql2);
                if ($res2) {
                    while ($row2 = mysqli_fetch_assoc($res2)) {
                        $IDComentario = $row2['ID'];
                        echo $IDComentario;
                    }
                }
            }
            else{
                echo "Error al Guardar Comentario";
            }
        }

    }
    //Modificar Trailer
    if (isset($_POST['Modificar_Trailer'])) {
        $IDApp = $_POST['IDAPP'];
        $URL = $_POST['URL'];

        $sql = "UPDATE apps SET URL='$URL' WHERE ID = $IDApp";
        $res = mysqli_query($conn,$sql);
        if ($res && mysqli_affected_rows($conn) > 0) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
    //Modificar Nombre
    if (isset($_POST['Modificar_Nombre'])) {
        $IDApp = $_POST['IDApp'];
        $NuevoNombre = $_POST['NuevoNombre'];
        
        $sql="UPDATE apps SET Nombre='$NuevoNombre' WHERE ID = $IDApp";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
    //Modificar Version
    if (isset($_POST['Modificar_Version'])) {
        $IDApp = $_POST['IDApp'];
        $NuevaVersion = $_POST['NuevaVersion'];
        
        $sql="UPDATE apps SET Version='$NuevaVersion' WHERE ID = $IDApp";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
    //Modificar Desarollador
    if (isset($_POST['Modificar_Desarollador'])) {
        $IDApp = $_POST['IDApp'];
        $NuevoDesarollador = $_POST['NuevoDesarollador'];
        
        $sql="UPDATE apps SET Desarollador='$NuevoDesarollador' WHERE ID = $IDApp";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
     //Modificar Fecha
    if (isset($_POST['Modificar_Fecha'])) {
        $IDApp = $_POST['IDApp'];
        $NuevaFecha = $_POST['NuevaFecha'];
        
        $sql="UPDATE apps SET Actualizacion='$NuevaFecha' WHERE ID = $IDApp";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
     //Modificar Detalles
    if (isset($_POST['Modificar_Detalles'])) {
        $IDApp = $_POST['IDApp'];
        $NuevoDetalles = $_POST['NuevoDetalles'];
        
        $sql="UPDATE apps SET Detalles='$NuevoDetalles' WHERE ID = $IDApp";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
    //Eliminar Comentario
    if (isset($_POST['EliminarComentario'])) {
        $IDComentario = $_POST['IDComentario'];
        $sql="DELETE FROM comentarios WHERE ID=$IDComentario";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
        else{
            echo 404;
        }
    }
////////////////////


//Configuraciones
    //MOSTRAR COMENTARIO
    if (isset($_POST['MostComentario'])) {
        $IDApp = $_POST['IDApp'];
        $IDUsuario = $_POST['IDUsuario'];
        $Foto = $_POST['Foto'];
        $Nombres = $_POST['Nombres'];
        $Apellidos = $_POST['Apellidos'];
        $sql="SELECT * FROM comentarios WHERE IDApp=$IDApp AND IDUsuario = $IDUsuario ORDER BY Fecha DESC";
        $result = mysqli_query($conn,$sql);
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $IDComentario = $row['ID'];
                $Comentario = $row['Comentario'];
                $Fecha = $row['Fecha'];
                $Estrellas = $row['Estrellas'];

                //Traer likes del cometario
                $sql2="SELECT * FROM likes WHERE IDComentario=$IDComentario";
                $result2 = mysqli_query($conn,$sql2);
                $num_rows = mysqli_num_rows($result2);
                ?>  

                <div class="col-12 col-xs-12 col-sm-2 col-md-1 col-lg-1">
                    <img src="../Datos/<?php echo $Foto ?>" height="50px">
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-11 col-lg-11">
                    <label class=""> <?php echo $Nombres." ". $Apellidos ?> </label>
                    <label class="ml-3">
                        <?php
                        if ($Estrellas == 1) {
                        echo '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                        }
                        else if ($Estrellas == 2) {
                            echo '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                        
                        }
                        else if ($Estrellas == 3) {
                            echo '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                        
                        }
                        else if ($Estrellas == 4) {
                            echo '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                        
                        }
                        else if ($Estrellas == 5) {
                            echo '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i>';
                        
                        }
                        ?>
                    </label>
                    <br>
                    <label class="">
                        <?php 
                        date_default_timezone_set('America/Montevideo');
                        echo date('d/m/Y H:i:s') 
                        ?> 
                    </label>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 p-2 mb-3" style="word-wrap: break-word;box-shadow:0 1px 2px rgb(0,0,0,.2);border-radius:5px;">
                    <?php echo $Comentario ?>
                </div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-2 col-lg-2 mt-2">
                    <label class="text-primary"><i class="fa-solid fa-thumbs-up"></i></label>
                    <label class="ml-2"> <?php echo $num_rows  ?> </label>
                </div>
                <div class="col-6 col-xs-6 col-sm-6 col-md-2 col-lg-2"><button IDComentario="<?php echo $IDComentario ?>" class="mb-4 btn btn_delete_coment btn-danger"> <i class="fa-solid fa-eraser"></i> </button></div>
                <script>
                    $('.btn_delete_coment').on('click', function() {
                        var BTNDELETE = $(this);
                        var IDComent = $(this).attr('IDComentario');
                        Swal.fire({
                        title: 'Estas Seguro?',
                        text: "No podras revertir esta acción!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, Eliminar!',
                        cancelButtonText: 'Cancelar'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                            url:'../assets/Ajax.php',
                            type:'POST',
                            data:{'EliminarComentario':1, 'IDComentario':IDComent},
                            }).done(function(res) {
                            console.log(res);
                            if (res == 1) {
                                Swal.fire({
                                title:'Eliminado!',
                                icon:'success',
                                footer:'Se actualizara la pagina para realizar los cambios!',
                                showConfirmButton:false,
                                timer:'2500',
                                timerProgressBar:true,
                                })
                               
                               setInterval(() => {
                                location.reload();
                               }, 2500);
                            }
                            })
                        }
                        })
                    })
                </script>
                <?php
                
            
            }
        }
        else{
            echo "error";
        }
        
    }

    //Modificar Nombre
    if (isset($_POST['ModificarNombreUsuario'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $NuevoNombreUsuario = $_POST['NuevoNombreUsuario'];

        $sql="UPDATE usuarios SET Nombres='$NuevoNombreUsuario' WHERE ID=$IDUsuario";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
    }
    //Modificar Apellido
    if (isset($_POST['ModificarApellidoUsuario'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $NuevoApellidoUsuario = $_POST['NuevoApellidoUsuario'];

        $sql="UPDATE usuarios SET Apellidos='$NuevoApellidoUsuario' WHERE ID=$IDUsuario";
        $res=mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
    }
   
    //VERIFICAR CONTRASEÑA
    if (isset($_POST['VerificarPassword'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $Password = $_POST['Password'];

        //Comprobar contraseña anterior
        $sql = "SELECT * FROM usuarios WHERE ID=$IDUsuario AND Password LIKE BINARY '$Password'";
        $res=mysqli_query($conn,$sql);
        $num_rows=mysqli_num_rows($res);

        //Contraseña anterior correcta
        if ($num_rows == 1) {
            echo 1;
        }
        //Contraseña anterior incorecta
        else{
            echo 2;
        }
    }
    //CAMBIAR CONTRASEÑA
    if (isset($_POST['CambiarPassword'])) {
        $IDUsuario = $_POST['IDUsuario'];
        $NewPassword = $_POST['NewPassword'];

        $sql = "UPDATE usuarios SET Password='$NewPassword' WHERE ID=$IDUsuario";
        $res = mysqli_query($conn,$sql);
        if ($res) {
            echo 1;
        }
    }

///////////////

?>