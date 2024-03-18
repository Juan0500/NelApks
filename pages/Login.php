<!doctype html>
<html lang="en">
  <head>
    <title>NELAPKS</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" style="border-radius:100%;" href="../icono.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">


    

  </head>
  <body>

    <?php include "../header.php";
    if (isset($_SESSION['Correo']) || isset($_SESSION['Cedula'])) {
      header('location:juegos.php');
    }

    //ALERTA DE DATOS INCORRECTOS
    if (isset($_SESSION['login_error'])) {
      $Correo=$_SESSION['Correo_e'];
      ?>
      <script>
        Swal.fire({
          icon:'error',
          title:'Login Error!',
          html:'¡Los datos ingresados son incorrectos!. Por favor vuelve a intentarlo.',
          confirmButtonText:'Aceptar'
        })
      </script>
      <?php
      unset($_SESSION['login_error']);
    }
    else{
      $Correo = "";
    }

    //VOLVER AL MENU DE SELECCION DESPUES DEL LOGIN
    if (isset($_SESSION['VolverJuego']) && isset($_SESSION['VolverJuego2']) ) {
      $IDAppVolver = $_SESSION['VolverJuego'];
      $Tipo = $_SESSION['VolverJuego2'];
    }
    else {
      $IDAppVolver = "";
      $Tipo = "";
    }
    ?>

    <main style="display:flex;align-items:center;">
        <div class="container mt-5">
          <form action="../Datos/DatosCuenta.php" method="post">
            <input type="hidden" name="Login" value="1">
            <input type="hidden" name="IDApp" value="<?php echo $IDAppVolver ?>">
            <input type="hidden" name="Tipo" value="<?php echo $Tipo ?>">
           <div class="row justify-content-center">
                <div class="col-8 col-xs-8 col-sm-8 col-md-4 col-lg-4 div text-center">
                <label class="h4 mb-4 mt-4">  🅽🅴🅻🅰🅿🅺🆂 </label> <br>
                <input type="text" required name="Correo" class="form-control mb-3" placeholder="Correo electrónico" value="<?php echo $Correo ?>">
                <input type="password" required name="Password" class="form-control mb-3" placeholder="Contraseña" values="">
               
                <button class="btn btn-block btn-outline-primary mb-3 mt-3">
                    Iniciar Sesión
                </button>
                <label for="">¿No tienes cuenta?</label>
                <a href="Register.php"> Registrarse </a>
                </div>
           </div>
           </form>
        </div>
    </main>


    <?php include "../footer.html";?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    
    <!-- My JavaScritp -->
    <script src="../assets/myJS.js"></script>    
  </body>
</html>