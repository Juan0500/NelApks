<?php
if (!isset($_GET['id'])) {
  header('location:juegos.php');
}

?>
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
    <?php include "../header.php"; ?>
    <main><br class="EnTer"><br class="EnTer"><br><br>
      <?php
      $IDApp = $_GET['id'];

      //VERIFICAR SI ES JUEGO O APP
      $juegoORapp = $_GET['/'];
      if ($juegoORapp == "j") {
        $Tipo = "Juego";
        ?>
        <!-- ACTIVAR NAV DE JUEGO O APP -->
        <script>
          $('.nav-item_juego').addClass('active');
          $('.nav-item_juego a').removeClass('text-light');
          $('.nav-item_juego a').addClass('text-warning');
          $('.nav-item_apps').removeClass('active');
          $('.nav-item_apps a').removeClass('text-warning');
          $('.nav-item_apps a').addClass('text-light');
        </script>
        <!-------------------------->
        <?php
      }
      else{
        $Tipo = "App";
        ?>
        <!-- ACTIVAR NAV DE JUEGO O APP -->
        <script>
          $('.nav-item_juego').removeClass('active');
          $('.nav-item_juego a').addClass('text-light');
          $('.nav-item_juego a').removeClass('text-warning');
          $('.nav-item_apps').addClass('active');
          $('.nav-item_apps a').addClass('text-warning');
          $('.nav-item_apps a').removeClass('text-light');
        </script>
        <!-------------------------->
        <?php
      }

      $_SESSION['VolverJuego'] = $IDApp;
      $_SESSION['VolverJuego2'] = $juegoORapp;
      $sql = "SELECT * FROM apps WHERE ID=$IDApp AND Tipo='$Tipo'";
      $res=mysqli_query($conn,$sql);
      if ($res && mysqli_affected_rows($conn) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
          $Nombre=$row['Nombre'];
          $Detalles=$row['Detalles'];
          $Icono=$row['Icono'];
          $Poster=$row['Poster'];
          $Version=$row['Version'];
          $Actualizacion=$row['Actualizacion'];
          $Requisitos=$row['Requisitos'];
          $Genero=$row['Genero'];
          $apk=$row['apk'];
          $URL=$row['URL'];
          $Desarollador=$row['Desarollador'];

          $sqlBuscarGenero = "SELECT * FROM generos WHERE ID=$Genero";
          $resBuscarGenero = mysqli_query($conn,$sqlBuscarGenero);
          if ($resBuscarGenero) {
            while ($row = mysqli_fetch_assoc($resBuscarGenero)) {
              $NombreGenero = $row['Nombre'];

          ?>
          <!-- POSTER DE FONDO DEL MAIN -->
          <style>
            main{
              background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.9)), url("../Datos/<?php echo $Poster ?>");
              background-repeat: no-repeat;
              background-size: 100% 100%;
            }
          </style>
            <!-- Modificar POSTER -->
            <?php
            if (isset($Cedula)) {
              ?>
              <div class="container mt-3">
                <div class="row text-center">
                  <div class="col-12">
                    <button id="mod_Poster" tipo='<?php echo $juegoORapp ?>' IDApp="<?php echo $IDApp ?>" class="btn btn-outline-light"> <i class='fa-solid fa-pen-to-square'></i> Cambiar Fondo </button>
                  </div>
                </div>
              </div>
              <?php
            }
            ?>
          <!------------------------------->
          <!-- Contenido Principal -->
          <div class="container div mt-5">
            <div class="row p-2">
              <div class="col-12 mb-3">
                <a href="<?php if ($juegoORapp == "a") {
                  echo "apps.php";
                }else { echo "juegos.php"; } ?>"> <?php if ($juegoORapp == "a") {
                  echo "Apps";
                }else { echo "Juegos"; } ?> </a> > Categorias > <a href="Search.php?g=<?php echo base64_encode($NombreGenero) ?>&tipo=<?php echo base64_encode($juegoORapp); ?>&idg=<?php echo base64_encode($Genero) ?>"><?php echo $NombreGenero ?>  </a> > <div style="display:inline-block;" class="Nombre_v1"> <?php echo $Nombre ?> </div>
              </div>
              <div class="col-12 col-xs-12 col-sm-12 col-md-4 col-lg-2 text-center">
                <!-- Imagen y Trailer -->
                <?php
                if (isset($Cedula)) {
                  ?>
                  <button class="btn" id="mod_Icono" tipo="<?php echo $juegoORapp ?>" Icono="<?php echo $Icono ?>" IDApp="<?php echo $IDApp ?>"> <abbr title="Modificar Icono" style="cursor:pointer;"> <img style="border-radius:100%;" src="../Datos/<?php echo $Icono ?>" width="120px" height="120px"></button></abbr>
                  <br><br>
  
                  <button class="btn btn-outline-warning" id="View_Trailer" URL="<?php echo $URL ?>"><i class="fa-solid fa-play"></i> Ver Trailer</button>
                  <?php
                  //PARA EDITAR TRAILER
                  ?>
                  <label class="ml-3 text-info" style="cursor:pointer;" id='mod_trailer' IDApp="<?php echo $IDApp ?>" URL='<?php echo $URL ?>'> <i class="fa-solid fa-pen-to-square"></i> </label>
                  <?php
                }
                else{
                  ?>
                   <img style="border-radius:100%;" src="../Datos/<?php echo $Icono ?>" width="120px" height="120px">
                  <br><br>
                  <button class="btn btn-outline-warning" id="View_Trailer" URL="<?php echo $URL ?>"><i class="fa-solid fa-play"></i> Ver Trailer</button>
                  <?php
                }
                ?>
              </div>
              <div class="col-12 col-xs-6 col-sm-6 col-md-4 col-lg-6 mt-5">
              <?php if (isset($Cedula)) { echo "<button id='mod_name' IDApp='". $IDApp ."' class='mr-2 btn'><i class='fa-solid fa-pen-to-square'></i></button>"; }  ?> <label> <i class="fa-solid fa-signature"></i> </label> <div style="display:inline-block;" id="Name" class="font-weight-bold"> <?php echo $Nombre ?>  </div>
                <br>
                <?php if (isset($Cedula)) { echo "<button id='mod_version' IDApp='". $IDApp ."' class='mr-2 btn text-success'><i class='fa-solid fa-pen-to-square'></i></button>"; }  ?> <label> <i class="fa-solid fa-rotate"></i> </label> <div style="display:inline-block;" id="Version" class="text-success">  <?php echo $Version ?> </div>
                <br>
                <?php if (isset($Cedula)) { echo "<button  id='mod_desarollador' IDApp='". $IDApp ."' class='mr-2 btn text-primary'><i class='fa-solid fa-pen-to-square'></i></button>"; }  ?> <label> <i class="fa-solid fa-code"></i> by </label> <div style="display:inline-block;" id="Desarollador" class="text-info"> <?php echo $Desarollador ?> </div>
                <br>
                <?php if (isset($Cedula)) { echo "<button id='mod_fecha' IDApp='". $IDApp ."' class='mr-2 btn text-warning'><i class='fa-solid fa-pen-to-square'></i></button>"; }  ?> <label> <i class="fa-solid fa-calendar-days"></i> </label> <div style="display:inline-block;" id="Fecha">  <?php echo  $Actualizacion ?></div>
              </div>
              <div class="col-12 col-xs-6 col-sm-6 col-md-4 col-lg-4 text-center"> <br> <br>
                <a href="<?php echo $apk ?>" target="_blank" class="btn"> <img src="../assets/imagenes/btn-download.png" width="100%"> </a>
               
                <?php
                if (isset($Cedula)) {
                  echo "<button id='mod_APK' tipo='". $juegoORapp ."' apk='". $apk ."' IDApp='". $IDApp ."' class='mt-2 btn btn-outline-success'><i class='fa-solid fa-pen-to-square'></i> Modificar APK</button>";
                }
                ?>
              </div>
            </div>
          </div>
          <!------------------------------->
          <!-- Detalles del Juego --->
          <div class="container div mt-2 pb-3">
            <?php
            if (isset($Cedula)) {
              ?>
              <div style="display:inline-block;">  <button IDApp="<?php echo $IDApp; ?>" id="mod_detalles" class="btn btn-outline-info"> <i class='fa-solid fa-pen-to-square'></i></button> </div>
              <?php
            }
            ?>
            <div class="Nombre_v2 ml-5 p-2 mt-2" style="display:inline-block;" > <label class="h5"> Acerca de <?php echo $Nombre ?> </label> </div> 
            <p id="Detalles" style="word-wrap: break-word;"> <?php echo $Detalles ?> </p>
          </div>
          <!------------------------------->
          <!-- Mas info del Juego -->
          <div class="container div mt-2 p-3">
            <label class="ml-5 h6"> Informacón Adicional de Juego </label>
            <div class="ml-5 row Info_Ad_Game">
              <div class="col-6 mt-4">
                <label> Última Versión </label>
                <br>
                <i class="fa-solid text-success fa-rotate"></i> <div style="display:inline-block;" class="ml-2 Version_1 text-success"><?php echo $Version ?> </div>
              </div>
              <div class="col-6 mt-4">
                <label for="">  Actualización </label>
                <br>
                <i class="fa-solid text-primary fa-calendar-days"></i> <div style="display:inline-block;" class="ml-2 Fecha_1 text-info"> <?php echo $Actualizacion ?> </div>
              </div>
              <div class="col-6 mt-3">
                <label for="">Requisitos</label>
                <br>
                <i class="fa-brands text-success fa-android"></i> <div style="display:inline-block;" class="ml-2 Requisitos_1 text-success">  <?php echo $Requisitos ?> </div>
              </div>
              <div class="col-6 mt-3">
                <label for="">Categoría</label>
                <br>
                <i class="fa-solid text-primary fa-gamepad"></i> <div style="display:inline-block;" class="ml-2 Categoria_1 text-info">  <?php echo $NombreGenero ?> </div>
              </div>
              <div class="col-6 mt-3">
                <label for="">Desarollador</label>
                <br>
                <i class="fa-solid text-success fa-code"></i><div style="display:inline-block;" class="ml-2 Desarollador_1 text-success"> <?php echo $Desarollador ?> </div>
              </div>
              <div class="col-6 mt-3">
                <label for="">Disponible en</label>
                <br>
                <i class="fa-brands text-primary fa-google-play"></i><div style="display:inline-block;" class="ml-2 Disponible_1 text-info">  Play Store </div>
              </div>
            </div>
          </div>
          <!------------------------------->
          <!-- Mas Juegos del Genero -->
          <?php
            $sqlMasGame="SELECT * FROM apps WHERE Tipo='$Tipo' AND Genero=$Genero AND ID != $IDApp";
            $resMasGame=mysqli_query($conn,$sqlMasGame);
            if ($resMasGame && mysqli_affected_rows($conn) > 0) {
              ?>
              <div class="container div mt-2 p-3">
                <div class="row">
                  <div class="col-6 mb-4">
                    <label class="h5 font-weight-bold">Más juego de <?php echo $NombreGenero ?></label>
                  </div>
                  <div class="col-6 text-right">
                    <a href="Search.php?g=<?php echo base64_encode($NombreGenero) ?>&idg=<?php echo base64_encode($Genero) ?>" class="sub_titulo h5 mr-5">Ver mas <i class="fa-solid fa-angles-right"></i></a>
                  </div>
                  <?php
                    while ($row=mysqli_fetch_assoc($resMasGame)) {
                      $IDMasGame=$row['ID'];
                      $NombreMasGame=$row['Nombre'];
                      $IconoMasGame=$row['Icono'];

                  ?>
                  <div class="col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
                    <a href="Seleccion.php?/=<?php echo $juegoORapp ?>&id=<?php echo $IDMasGame ?>">
                      <img style="border-radius:100%;" src="../Datos/<?php echo $IconoMasGame;?>" width="80px" height="80px">
                    </a>
                    <label> <?php echo $NombreMasGame ?> </label>
                  </div>
                  <?php
                      }
                    }
                  ?>
                  </div>
                </div>
          <!------------------------------------>
          <!-- Comentarios -->
          <div class="div container mt-2 DiVComent">
            <div class="">
            <!-- ENVIAR COMENTARIO -->
            <div class="row">
              <div class="col-12 text-center mt-2">
                <hr>
                <h3> Comentarios </h3>
                <hr>
              </div>
              <div class="col-12 mt-4">
                <textarea id="ComentarioEnviar" onkeyup="return noEnter(this.value, event)" onkeyPress="return noEnter(this.value, event)" name="Comentario" placeholder="¿Qué opinas del Juego?" style="resize:none;" class="form-control txtarea_coment"></textarea>
              </div>
              <div class="col-12 text-center p-3">
                <p class="text_cal Nombre_v3"> Por favor califica <?php echo $Nombre ?>: </p>
                <div class="pr-5 pl-5 pt-2 pb-2 div_estrellas" style="display:inline-block;box-shadow:0 1px 2px rgb(0,0,0, .4);font-size:20px;border-radius:5px;">
                  <button class="btn est_1"><i class="fa-solid fa-star estrella_1" style="color:gray;"></i></button>
                  <button class="btn est_2"><i class="fa-solid fa-star estrella_2" style="color:gray;"></i></button>
                  <button class="btn est_3"><i class="fa-solid fa-star estrella_3" style="color:gray;"></i></button>
                  <button class="btn est_4"><i class="fa-solid fa-star estrella_4" style="color:gray;"></i></button>
                  <button class="btn est_5"><i class="fa-solid fa-star estrella_5" style="color:gray;"></i></button>
                  <button class="btn ml-2 estr_x" style="display:none;"><i class="fa-solid fa-circle-xmark"></i></button>
                </div>

              </div>
              <div class="col-2"></div>
              <div class="col-8">
                <button id="Enviar_Comentario" disabled class="btn btn-outline-success btn-lg btn-block mt-3 mb-3"> Enviar  </button>
              </div>
            </div>
            <hr style="color:black;background-color:transparent;box-shadow:0 0 0;">
            <div style="display:none;" class="row COMENTARIO_SUCCESS">
              <div class="col-12 alert alert-success text-center" role="alert"> Comentaro Agregado exitosamente! </div>
            </div>
            <div class="row ROW_COMENTARIO"></div>
            <?php
            if (isset($IDUsuario)) {
              ?>
              <script>
                function noEnter(texto, e) {
                  var Comentario = $('.txtarea_coment').val();
                  if (Comentario == "") {
                    $('#Enviar_Comentario').attr('disabled',true);
                    if (navigator.appName == "Netscape") tecla = e.which;
                    else tecla = e.keyCode;
                    if (tecla == 13) return false;
                    if (tecla == 60) return false;
                    if (tecla == 62) return false;
                    else return true;
                    
                  }
                  else{
                    $('#Enviar_Comentario').attr('disabled',false);
                    //$('#Enviar_Comentario').attr('disabled',true);
                    if (navigator.appName == "Netscape") tecla = e.which;
                    else tecla = e.keyCode;
                    if (tecla == 60) return false;
                    if (tecla == 62) return false;
                    else return true;
                  }
                }
                $('#Enviar_Comentario').on('click', function () {
                  var Comentario = $('.txtarea_coment').val();
                  var estrella_1 = $('.estrella_1').css('color');
                  var estrella_2 = $('.estrella_2').css('color');
                  var estrella_3 = $('.estrella_3').css('color');
                  var estrella_4 = $('.estrella_4').css('color');
                  var estrella_5 = $('.estrella_5').css('color');
                  //Estrellas Seleccionadas
                    if (estrella_1 == "rgb(255, 165, 0)" && estrella_2 != "rgb(255, 165, 0)" && estrella_3 != "rgb(255, 165, 0)" && estrella_4 != "rgb(255, 165, 0)" && estrella_5 != "rgb(255, 165, 0)") {
                      var CantEstrellas = 1;
                    }
                    else if(estrella_1 == "rgb(255, 165, 0)" && estrella_2 == "rgb(255, 165, 0)" && estrella_3 != "rgb(255, 165, 0)" && estrella_4 != "rgb(255, 165, 0)" && estrella_5 != "rgb(255, 165, 0)"){
                      var CantEstrellas = 2;
                    }
                    else if(estrella_1 == "rgb(255, 165, 0)" && estrella_2 == "rgb(255, 165, 0)" && estrella_3 == "rgb(255, 165, 0)" && estrella_4 != "rgb(255, 165, 0)" && estrella_5 != "rgb(255, 165, 0)"){
                      var CantEstrellas = 3;
                    }
                    else if(estrella_1 == "rgb(255, 165, 0)" && estrella_2 == "rgb(255, 165, 0)" && estrella_3 == "rgb(255, 165, 0)" && estrella_4 == "rgb(255, 165, 0)" && estrella_5 != "rgb(255, 165, 0)"){
                      var CantEstrellas = 4;
                    }
                    else if(estrella_1 == "rgb(255, 165, 0)" && estrella_2 == "rgb(255, 165, 0)" && estrella_3 == "rgb(255, 165, 0)" && estrella_4 == "rgb(255, 165, 0)" && estrella_5 == "rgb(255, 165, 0)"){
                      var CantEstrellas = 5;
                    }
                    else{
                      var CantEstrellas = 0;
                    }
                  ////////////////////////////
                  
                  if (CantEstrellas != 0) {
                    //Ajax
                    $.ajax({
                      url:'../assets/Ajax.php',
                      type:'POST',
                      data:{'GuardarComentario':1, 'Comentario':Comentario, 'Estrellas':CantEstrellas, 'IDUsuario':'<?php echo $IDUsuario ?>', 'IDApp':'<?php echo $IDApp ?>'},
                    }).done(function (res) {
                      console.log(res);
                      if (res == 404) {
                        Swal.fire({
                          icon:'error',
                          toast:true,
                          title:'Comentario repetido!',
                          footer:'No puede realizar comentarios iguales!',
                          timer:'5500',
                          position:'top-end',
                          timerProgressBar:true,
                          showConfirmButton:false,
                          showCloseButton:true,
                        })
                      }
                      else if (res != 404) {
                        //ESTRELLAS QUE SE MUESTRAN
                        if (CantEstrellas == 1) {
                          var MostrarEstrellas = '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                          
                        }
                        else if(CantEstrellas == 2){
                          var MostrarEstrellas = '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';
                          
                        }
                        else if(CantEstrellas == 3){
                          var MostrarEstrellas = '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';

                        }
                        else if(CantEstrellas == 4){
                          var MostrarEstrellas = '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:gray;" class="fa-solid fa-star"></i>';

                        }
                        else if(CantEstrellas == 5){
                          var MostrarEstrellas = '<i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i><i style="color:orange;" class="fa-solid fa-star"></i>';

                        }

                        $('.ROW_COMENTARIO').prepend('<div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-1"><img src="../Datos/<?php echo $Foto ?>" height="50px"></div> <div class="col-12 col-xs-12 col-sm-12 col-md-11 col-lg-11"><label class=""> <?php echo $Nombres." ". $Apellidos ?> </label><label class="ml-3">'+ MostrarEstrellas +'</label><br><label class=""> <?php date_default_timezone_set('America/Montevideo');  echo date('d/m/Y H:i:s') ?> </label></div><div class="col-1"></div><div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 p-2 mb-3" style="word-wrap:break-word;box-shadow:0 1px 2px rgb(0,0,0,.2);border-radius:5px;">'+ Comentario +'</div><div class="col-3 mt-2"><button style="background-color:white;color:#007bff;" class="btn btn-primary btn_mi_coment_'+res +'"><i class="fa-solid fa-thumbs-up"></i></button><input type="hidden" class="Like_'+ res +'" value="0"><label class="ml-2 cant_likes_'+res+'"> 0 </label> </div>');
                        $('.COMENTARIO_SUCCESS').show();
                        $('.COMENTARIO_PRIMARY').show();
                        
                        Swal.fire({
                          icon:'success',
                          title:'Enviado con éxito!',
                          toast:true,
                          position:'top-end',
                          showConfirmButton:false,
                          timer:'2500',
                          timerProgressBar:true
                        })

                        //Cuando se hace click en el Boton like
                        $('.btn_mi_coment_'+res).on('click',function() {
                          var Boton = $(this);
                        
                          //si tiene like propio(Verificar Color del boton)
                          if (Boton.css('color') == 'rgb(255, 255, 255)') {
                            $.ajax({
                              url:'../assets/Ajax.php',
                              type:'POST',
                              data:{'QuitarLike':1, 'IDComentario':res, 'IDUsuario':'<?php echo $IDUsuario ?>'},
                            }).done(function (res2) {
                              if (res2 == 1) {
                                Boton.css({'background-color':'white','color':'#007bff'});

                                var likesAnterior = $('.Like_'+res).val();
                                var likesAnteriorInt=parseInt(likesAnterior);
                                $('.Like_'+res).val(likesAnteriorInt - 1);
                                $('.cant_likes_'+res).html(likesAnteriorInt - 1);

                              }
                            })
                            
                          }
                          //si no tiene like propio
                          else{
                            $.ajax({
                              url:'../assets/Ajax.php',
                              type:'POST',
                              data:{'AgregarLike':1, 'IDComentario':res, 'IDUsuario':'<?php echo $IDUsuario ?>'},
                            }).done(function (res3) {
                              if (res3 == 1) {
                                Boton.css({'background-color':'#007bff','color':'white'});
                                var likesAnterior = $('.Like_'+res).val();
                                var likesAnteriorInt=parseInt(likesAnterior);
                                $('.Like_'+res).val(likesAnteriorInt + 1);
                                $('.cant_likes_'+res).html(likesAnteriorInt + 1);
                              }
                            })
                            
                          }
                        })
                        
                      }
                    })
                  }
                  else{
                  Swal.fire({
                    toast:true,
                    position:'top-start',
                    icon:'error',
                    title:'Por favor califica <?php echo $Nombre ?> para comentar',
                    showConfirmButton:false,
                    timer:'1500',
                    timerProgressBar:true
                  })
                  }

                })
                  
              </script>
              <?php
            }
            else if(isset($Cedula)){
              ?>
              <script>
                $('#ComentarioEnviar').attr('placeholder', 'Accion no permitida para Administradores!');
                $('#ComentarioEnviar').attr('disabled', true);
                $('.est_1').attr('disabled', true);
                $('.est_2').attr('disabled', true);
                $('.est_3').attr('disabled', true);
                $('.est_4').attr('disabled', true);
                $('.est_5').attr('disabled', true);
              </script>
              <?php
            }
            else{
              ?>
              <script>
                function noEnter(texto, e) {
                  $('#ComentarioEnviar').val('');
                  Swal.fire({
                    icon:'info',
                    title:'¡Inicia Sesión!',
                    html:'<label>Por favor acceda para realizar un comentario.</label><br><a href="Login.php" class="btn btn-outline-info">Iniciar Sesión</a><label class="p-2"> o </label> <a href="Register.php" class="btn btn-outline-warning">Registrarse</a>',
                    showConfirmButton:false,
                    showCloseButton:true,
                  })
                }
                $('.est_1').attr('disabled', true);
                $('.est_2').attr('disabled', true);
                $('.est_3').attr('disabled', true);
                $('.est_4').attr('disabled', true);
                $('.est_5').attr('disabled', true);
              </script>
              <?php
            }
            ?>
            </div>
            <div class="container ContComent" style="overflow: auto;max-height: 470px;">

            <!-- Comentarios De Usuarios -->
            <?php
            //Traer Datos del Comentario
            $sqlComentarios="SELECT * FROM comentarios WHERE IDApp=$IDApp ORDER BY Fecha DESC";
            $resComentarios=mysqli_query($conn,$sqlComentarios);
            if ($resComentarios) {
              while ($row = mysqli_fetch_assoc($resComentarios)) {
                $IDComentario=$row['ID'];
                $IDUsuarioComento=$row['IDUsuario'];
                $Comentario=$row['Comentario'];
                $Fecha=$row['Fecha'];
                $Estrellas=$row['Estrellas'];

                //Traer Datos del Usuario que realizo el comentario
                $sqlUsuario="SELECT * FROM usuarios WHERE ID=$IDUsuarioComento";
                $resUsuario=mysqli_query($conn,$sqlUsuario);
                if ($resUsuario) {
                  while ($row=mysqli_fetch_assoc($resUsuario)) {
                    $NombresUsuario=$row['Nombres'];
                    $ApellidosUsuario=$row['Apellidos'];
                    $Foto=$row['Foto']; 
                  }
                }
                ?>
                <div class="row mt-4 ComentarioUser_<?php echo $IDComentario ?>">
                  <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-1">
                    <img src="../Datos/<?php echo $Foto ?>" height="50px">
                  </div>
                  <div class="col-12 col-xs-12 col-sm-12 col-md-11 col-lg-11">
                    <label class=""> <?php echo $NombresUsuario." ". $ApellidosUsuario ?> </label>
                    <!-- Estrellas -->
                    <label class="ml-3">
                            <?php
                            if ($Estrellas == 1) {
                               ?>
                               <i style="color:orange;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <?php
                            }
                            else if($Estrellas == 2){
                                ?>
                               <i style="color:orange;" class="fa-solid fa-star"></i>
                               <i style="color:orange;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <i style="color:gray;" class="fa-solid fa-star"></i>
                               <?php
                            }
                            else if($Estrellas == 3){
                                ?>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:gray;" class="fa-solid fa-star"></i>
                                <i style="color:gray;" class="fa-solid fa-star"></i>
                                <?php
                            }
                            else if($Estrellas == 4){
                                ?>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:gray;" class="fa-solid fa-star"></i>
                                <?php
                            }
                            else{
                                ?>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <i style="color:orange;" class="fa-solid fa-star"></i>
                                <?php
                            }
                            ?>
                        </label>
                    <br>
                    <label> <?php echo date('d/m/Y H:i:s', strtotime($Fecha)) ?> </label>
                  </div>
                  <div class="col-1"></div>
                  <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-8 p-2 mb-3" style="word-wrap:break-word;box-shadow:1px 1px 10px rgb(0,0,0,.3);border-radius:5px;">
                    <?php echo $Comentario ?>
                  </div>
                  <div class="col-12 col-xs-12 col-sm-12 col-md-2 col-lg-1 mt-2">
                    <?php
                      //Si hay una cuenta iniciada
                     if (isset($IDUsuario)) {
                      ?>
                      <button class="btn btn-primary btn_mi_coment_<?php echo $IDComentario ?>"><i class="fa-solid fa-thumbs-up"></i></button>
                      <script>
                        //Verificar Si tiene like del usuario logueado
                        $.ajax({
                          url:'../assets/Ajax.php',
                          type:'POST',
                          data:{'VerificarLike':1, 'IDUsuario':'<?php echo $IDUsuario ?>', 'IDComentario':'<?php echo $IDComentario ?>'},
                        }).done(function(res){
                          //Si no tiene(Queda el fono blanco)
                          if (res == 0) {
                            $('.btn_mi_coment_<?php echo $IDComentario ?>').css({'background-color':'white','color':'#007bff'});
                          }

                          //Cuando se hace click en el Boton like
                          $('.btn_mi_coment_<?php echo $IDComentario ?>').on('click',function() {
                            var Boton = $(this);
                          
                            //si tiene like propio(Verificar Color del boton)
                            if ($(this).css('color') == 'rgb(255, 255, 255)') {
                              $.ajax({
                                url:'../assets/Ajax.php',
                                type:'POST',
                                data:{'QuitarLike':1, 'IDComentario':'<?php echo $IDComentario ?>', 'IDUsuario':'<?php echo $IDUsuario ?>'},
                              }).done(function (res) {
                                if (res == 1) {
                                  Boton.css({'background-color':'white','color':'#007bff'});

                                  var likesAnterior = $('.Like_<?php echo $IDComentario ?>').val();
                                  var likesAnteriorInt=parseInt(likesAnterior);
                                  $('.Like_<?php echo $IDComentario ?>').val(likesAnteriorInt - 1);
                                  $('.cant_likes_<?php echo $IDComentario ?>').html(likesAnteriorInt - 1);

                                }
                              })
                              
                            }
                            //si no tiene like propio
                            else{
                              $.ajax({
                                url:'../assets/Ajax.php',
                                type:'POST',
                                data:{'AgregarLike':1, 'IDComentario':'<?php echo $IDComentario ?>', 'IDUsuario':'<?php echo $IDUsuario ?>'},
                              }).done(function (res) {
                                if (res == 1) {
                                  Boton.css({'background-color':'#007bff','color':'white'});
                                  var likesAnterior = $('.Like_<?php echo $IDComentario ?>').val();
                                  var likesAnteriorInt=parseInt(likesAnterior);
                                  $('.Like_<?php echo $IDComentario ?>').val(likesAnteriorInt + 1);
                                  $('.cant_likes_<?php echo $IDComentario ?>').html(likesAnteriorInt + 1);
                                }
                              })
                              
                            }
                          })
                        
                        })
                      </script>
                      <?php
                     }
                      //Si no hay cuenta iniciada(No puede dar like)
                     else{
                      ?>
                      <button  class="btn btn-primary btn_disabled_like"><i class="fa-solid fa-thumbs-up"></i></button>
                      <?php
                      if (isset($Cedula)) {
                        ?>
                        <script>
                          $('.btn_disabled_like').on('click', function() {
                          Swal.fire({
                            toast:true,
                            position:'top-start',
                            icon:'info',
                            title:'Accion no permitida para administradores!',
                            timer:'1500',
                            timerProgressBar:true,
                            showConfirmButton:false,
                          })
                          })
                        </script>
                        <?php
                      }
                      else{
                        ?>
                        <script>
                          $('.btn_disabled_like').on('click', function() {
                          Swal.fire({
                            icon:'info',
                            title:'Iniciar Sesión!',
                            html:'<label class="h6"> Por favor </label><a class="btn btn-outline-primary m-1" href="Login.php"> Inicia Sesión </a> <label class="h6"> o </label><a class="btn btn-outline-info m-1" href="Register.php"> Registrarte </a><label class="h6"> para realizar esta acción.</label>',
                            showConfirmButton:false,
                            showCloseButton:true
                          })
                          })
                        </script>
                        <?php
                      }
                     }
                    ?>
                   
                    <!-- Cantidad de likes -->
                    <?php
                    $sql="SELECT * FROM likes WHERE IDComentario=$IDComentario";
                    $result = mysqli_query($conn,$sql);
                    $num_rows = mysqli_num_rows($result);
                    ?>
                    <input type="hidden" class="Like_<?php echo $IDComentario ?>" value="<?php echo $num_rows ?>">
                    <label class="cant_likes_<?php echo $IDComentario ?>"> <?php echo $num_rows ?> </label>
                  </div>
                </div>
                <?php
                if (isset($IDUsuario)){
                  //Boton para eliminar Su comentario(usuario logueado)
                  if ($IDUsuario == $IDUsuarioComento) {
                  echo '<div class="row"><div class="col-9"></div><div class="col-2"><button IDComentario="'.$IDComentario.'" class="mb-4 btn btn_delete_coment btn-danger"> <i class="fa-solid fa-eraser"></i> </button></div></div>';
                  }
                }

              }
            }
            ?>
          </div> 
          </div><br>  
                
          <?php
          }
        }
        }
      }
      else{
        if ($juegoORapp == 'j') {
          echo "<script> window.location.href='juegos.php' </script>";
        }
        else{
          echo "<script> window.location.href='apps.php' </script>";
        }
      }
      ?>
    </main>
    
    <?php include "../footer.html"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


    
    <!-- My JavaScritp -->
    <script src="../assets/myJS.js"></script>    
  </body>
</html>