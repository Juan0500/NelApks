
<!-- CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/js/all.min.js" integrity="sha512-2bMhOkE/ACz21dJT8zBOMgMecNxx0d37NND803ExktKiKdSzdwn+L7i9fdccw/3V06gM/DBWKbYmQvKMdAA9Nw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

 <!-- JQUERY JS -->
 <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <!-- SWEET ALERT JS -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php
    header("Content-Type: text/html;charset=utf-8");
include "../conexion.php";
session_start();

//ALERTA DE BIENVENIDA RECIEN REGISTRADO
if (isset($_SESSION['Register_success'])) {
   ?>
   <script>
    Swal.fire({
        toast:true,
        icon:'success',
        title:'Registro exitoso!',
        html:'¡Bienvenido a 🅽🅴🅻🅰🅿🅺🆂 ! <br><br> Accede a las mejores APK/S del momento !',
        timer:'4500',
        timerProgressBar:true,
        showConfirmButton:false,
        showCloseButton:true,
        position:'top-end'
    })
   </script>
   <?php
   unset($_SESSION['Register_success']);
}
//ALERTA DE BIENVENIDA LOGUEADO
if (isset($_SESSION['success_login'])) {
   ?>
   <script>
    Swal.fire({
        toast:true,
        icon:'success',
        title:'Inicio de Sesión exitoso!',
        html:'¡Bienvenido de nuevo a 🅽🅴🅻🅰🅿🅺🆂 !',
        timer:'3500',
        timerProgressBar:true,
        showConfirmButton:false,
        position:'top-end'
    })
   </script>
   <?php
   unset($_SESSION['success_login']);
}
//ALERTA DE MODIFICACION DE APK
if (isset($_SESSION['mod_apk_success'])) {
    ?>
    <script>
        Swal.fire({
            icon:'success',
            title:'APK Modificada con éxito!',
            toast:true,
            position:'top-end',
            timer:'2500',
            timerProgressBar:true,
            showConfirmButton:false
        })
    </script>
    <?php
    unset($_SESSION['mod_apk_success']);
}
//ALERTA DE MODIFICACION DE Icono
if (isset($_SESSION['mod_Icono_success'])) {
    ?>
    <script>
        Swal.fire({
            icon:'success',
            title:'Icono Modificado con éxito!',
            toast:true,
            position:'top-end',
            timer:'2500',
            timerProgressBar:true,
            showConfirmButton:false
        })
    </script>
    <?php
    unset($_SESSION['mod_Icono_success']);
}
//ALERTA DE MODIFICACION DE Poster
if (isset($_SESSION['mod_Poster_success'])) {
    ?>
    <script>
        Swal.fire({
            icon:'success',
            title:'Poster Modificado con éxito!',
            toast:true,
            position:'top-end',
            timer:'2500',
            timerProgressBar:true,
            showConfirmButton:false
        })
    </script>
    <?php
    unset($_SESSION['mod_Poster_success']);
}

//ALERTA DE MODIFICACION DE FOTO DE PERFIL
if (isset($_SESSION['mod_Foto_success'])) {
    ?>
    <script>
        Swal.fire({
            icon:'success',
            title:'Foto Modificada con éxito!',
            toast:true,
            position:'top-end',
            timer:'2500',
            timerProgressBar:true,
            showConfirmButton:false
        })
    </script>
    <?php
    unset($_SESSION['mod_Foto_success']);
}

//SI ES ADMIN
if (isset($_SESSION['Cedula'])) {
    $Cedula = $_SESSION['Cedula'];
    $sql = "SELECT * FROM admin WHERE Cedula=$Cedula";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $Nombres = $row['Nombres'];
            $Apellidos = $row['Apellidos'];
            $Foto = $row['Foto'];
        }
    }

    ?>
    <!-- Boton para ADMINISTRADOR PARA AGREGAR -->
     <div class="btn-flotante-admin" data-toggle="modal" data-target="#ModalP">
        <i class="fa-solid text-light fa-plus"></i>
      </div>
    <!------------------------------->
    <!-- Modal -->
        <div class="modal fade" id="ModalP" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Body
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
            </div>
        </div>
        </div>
    <!------------------------------->
    
    <!-- BOTON PARA ELIMINAR APP/JUEGO -->
    <button class="btn btn-outline-danger btn-delete-app-game">
        <i class="fa-solid fa-trash"></i>
    </button>

        <!-- SI ESTA EN EL MENU DE SELECCION -->
        <?php
        if (isset($_GET['id'])) {

            $Tipo = $_GET['/'];
            if ($Tipo == "j") {
                ?>
                <input type="hidden" value="juegos.php" id="DireVolverDelete">
                <?php
            }
            else{
                ?>
                <input type="hidden" value="apps.php" id="DireVolverDelete">
                <?php
            }
            ?>
           <script>
            var DireVolver = $('#DireVolverDelete').val();
            $('.btn-delete-app-game').on('click', function() {
                
                Swal.fire({
                title: 'Estas seguro que deseas eliminar?',
                text: "No podras revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar ahora!'
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                      url:'../assets/Ajax.php',
                      type:'POST',
                      data:{'EliminarAppGame':1, 'IDGameOrApp': '<?php echo $_GET['id']; ?>'},
                    }).done(function(res) {
                      console.log(res);
                      if (res == 1) {
                        Swal.fire({
                            icon:'success',
                            text:'Eliminado con éxito!',
                            footer:'seras redirigido para finalizar los cambios',
                            showConfirmButton:false,
                            timer:'2500',
                            timerProgressBar:true,
                        })
                        setTimeout(() => {
                            location.href=DireVolver;
                            
                        }, 2000);
                      }
                      else if(res == 404){
                          alert('Error al eliminar app/game');
                      }
                    })
                }
                })

            })
           </script>
           <?php
        }
        else{
            
           echo "<script> $('.btn-delete-app-game').hide(); </script>";
           
        }
        ?>

    <?php
}
//SI ES USUARIP
else if (isset($_SESSION['Correo'])) {
    $Correo = $_SESSION['Correo'];
    $sql = "SELECT  * FROM usuarios WHERE Correo='$Correo'";
    $res=mysqli_query($conn,$sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $IDUsuario=$row['ID'];
            $Nombres = $row['Nombres'];
            $Apellidos = $row['Apellidos'];
            $Foto = $row['Foto'];
        }
    }
}
?>
<meta charset="UTF-8">
<nav class="navbar navbar-expand-sm navbar-light header">
    <label class="navbar-brand text-light p-1 ml-3 mr-5">🅽🅴🅻🅰🅿🅺🆂</label>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item nav-item_juego">
                <a class="nav-link font-weight-bold text-light" href="juegos.php">Juegos</a>
            </li>
            <li class="nav-item nav-item_apps">
                <a class="nav-link font-weight-bold text-light" href="apps.php">Apps</a>
            </li>
           
        </ul>
        <form class="form-inline my-2 my-lg-0 mr-2" method="POST" action="Search.php">
            <input class="form-control mr-sm-2" type="text" name="b" value="<?php if (isset($_POST['b'])) { echo $_POST['b']; } ?>" placeholder="Buscar">
            <button class="btn oculto btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

        <?php
        if (isset($_SESSION['Correo'])) {
            ?>
            <div>
                <button class="btn" id="Foto_Usuario">
                    <img style="border-radius:100%;" src="../Datos/<?php echo $Foto ?>" class="mr-3" height="60px">
                </button>
                <!-- MENU DESPLEGABLE DE CONFIGUACIONES -->
                <div class="Menu_Desplegable_Perfil">
                    <label class="h6 ml-4" id="NombUserHeader"> <?php echo $Nombres ?> </label>
                    <a href="Configuraciones.php" class="btn btn-block">Configuraciones</a>
                    
                    <a href="../Datos/DatosCuenta.php?cs=0" class="btn btn-block">Cerrar Sesión</a>
                </div>
            </div>
            <?php
        }
        else if(isset($_SESSION['Cedula'])){
            ?>
            <div>
                <button class="btn" id="Foto_Usuario">
                    <img src="../Datos/<?php echo $Foto ?>" class="mr-3" height="60px">
                </button>
                <!-- MENU DESPLEGABLE DE CONFIGUACIONES -->
                <div class="Menu_Desplegable_Perfil">
                    <label class="h6 ml-4"> <?php echo $Nombres ?> </label>
                    <a href="Configuraciones.php?id=<?php echo $Cedula?>" class="btn btn-block">Configuraciones</a>
                    
                    <a href="../Datos/DatosCuenta.php?cs=0" class="btn btn-block">Cerrar Sesión</a>
                </div>
            </div>
            <?php
        }
        else{
            ?>
            <div class="Login_or_Register">
                <a href="Register.php" class="btn btn-dark">Registrarse</a>
                <a href="Login.php" class="btn btn-light">Iniciar Sesión</a>
            </div>
            <?php
        }
        ?>

    </div>
</nav>

<script>
if (window.history.replaceState) { // verificamos disponibilidad
    window.history.replaceState(null, null, window.location.href);
}
</script>