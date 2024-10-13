<!doctype html>
<html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" style="border-radius:100%;" href="../icono.png">

  <title>NELAPKS</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/style.css">



  

    

  </head>
  <body>

    <?php include "../header.php";?>
    

    <!-- ACTIVAR NAV DE JUEGO -->
    <script>
      $('.nav-item_juego').addClass('active');
      $('.nav-item_juego a').removeClass('text-light');
      $('.nav-item_juego a').addClass('text-warning');
      $('.nav-item_apps').removeClass('active');
      $('.nav-item_apps a').removeClass('text-warning');
      $('.nav-item_apps a').addClass('text-light');
    </script>
    <!-------------------------->

    <br><br>
    <main class="mt-5">
      <?php
      $sqlIA="SELECT * FROM apps WHERE Tipo = 'Juego' ORDER BY RAND() LIMIT 1";
      $resIA=mysqli_query($conn,$sqlIA);
      if ($resIA && mysqli_affected_rows($conn) > 0) {
        ?>
        <!-- Carusel Principal -->
        <div class="container caruselP div pb-5">
          <div id="carouselId" class="carousel slide" data-interval="false">
            <div class="carousel-inner borde" role="listbox">
              <!-- ITEM ACTIVO del Carusel -->
        <?php
        while ($rowIA=mysqli_fetch_assoc($resIA)) {
          $IdIA=$rowIA['ID'];
          $NombreIA=$rowIA['Nombre'];
          $PosterIA=$rowIA['Poster'];
          $DetallesIA=$rowIA['Detalles'];
          $apkIA=$rowIA['apk'];
          $URLIA=$rowIA['URL'];
          ?>
          <div class="carousel-item active" IdItem="<?php echo $IdIA ?>">
            <hr>
            <h3 class="text-center sub_titulo">  SUGERENCIAS </h3>
            <hr>
            <h5 class="font-weight-bold"> <?php echo $NombreIA ?> </h5>
            <iframe class="iframe_trailer" width="800px" height="450px" src="<?php echo $URLIA ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            <br>
            <button class="btn btn-outline-info btn_more_info_game">Acerca <i class="fa-solid fa-chevron-down"></i> <i class="fa-solid fa-chevron-up" style="display:none;"></i></button>
            <a href="Seleccion.php?/=j&id=<?php echo $IdIA ?>" class="btn btn-outline-warning">Más información</a>
            <a href="<?php echo $apkIA ?>" target="_blank" class="btn btn-outline-success ">Descargar</a>
            <div style="display:none;" class="more_info_game">
              <hr>
              <p class="font-weight-bold h5"> <?php echo $NombreIA ?> </p>
              <p> <?php echo $DetallesIA ?> </p>
              <hr>
            </div>

          
          </div>
          <?php
        }
        // ITEMS INACTIVOS del Carusel
        $sqlI="SELECT * FROM apps  WHERE Tipo='Juego' AND ID != $IdIA ORDER BY RAND()";
        $resI=mysqli_query($conn,$sqlI);
        if ($resI) {
          while ($rowI = mysqli_fetch_assoc($resI)) {
            $IdI=$rowI['ID'];
            $NombreI=$rowI['Nombre'];
            $PosterI=$rowI['Poster'];
            $DetallesI=$rowI['Detalles'];
            $URLI=$rowI['URL'];
            $apkI=$rowI['apk'];
            

            ?>
            <div class="carousel-item " IdItem="<?php echo $IdI ?>">
              <hr>
              <h3 class="text-center sub_titulo">  SUGERENCIAS </h3>
              <hr>
              <h5 class="font-weight-bold"> <?php echo $NombreI ?> </h5>
              <iframe class="iframe_trailer" width="800px" height="450px" src="<?php echo $URLI ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
              <br><button class="btn btn-outline-info btn_more_info_game">Acerca <i class="fa-solid fa-chevron-down"></i> <i class="fa-solid fa-chevron-up" style="display:none;"></i></button>
              <a href="Seleccion.php?/=j&id=<?php echo $IdI ?>" class="btn btn-outline-warning ">Más información</a>
              <a href="<?php echo $apkI ?>" target="_blank" class="btn btn-outline-success">Descargar</a>
              <div style="display:none;" class="more_info_game">
                <hr>
                <p class="font-weight-bold h5"> <?php echo $NombreI ?> </p>
                <p> <?php echo $DetallesI ?> </p>
                <hr>
              </div>

            
            </div>            
            <?php
          }
        }
        ?>
          <!------------------------------>
        </div>
        <div id="DIV_BTNS_NEXT_PREV_CARRUSEL">
          <a class="carousel-control-prev bg-dark btn-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
          </a>
          <a class="carousel-control-next bg-dark btn-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
          </a>
        </div>

          </div>
        </div>
        <!----------------------->
            
            <?php
      }
      else {
        echo "<div class='alert alert-info text-center p-4'><h4>No hay Juegos Guardados :(</h4></div>";
      }
      
      ?>
           

      <div class="container ContXCategoria mt-5 div">
        <div class="row">
        <div class="col-12 mt-4">
                <hr>
                <label class="h2 sub_titulo ml-5"> Categorias </label>
                <hr>
              </div>
        </div>
      <!-- CONTENIDOS POR CATEGORIA -->
        <?php
        $sql="SELECT * FROM generos";
        $res=mysqli_query($conn,$sql);
        $num_rows = mysqli_num_rows($res);
        if ($res && $num_rows > 0) {
          while ($row = mysqli_fetch_assoc($res)) {
            $IDGenero = $row['ID'];
            $NombreGenero = $row['Nombre'];

            $sql2="SELECT * FROM apps WHERE Tipo='Juego' AND Genero=$IDGenero ORDER BY RAND() LIMIT 12";
            $res2=mysqli_query($conn,$sql2);
            if ($res2 && mysqli_affected_rows($conn) > 0) {

              ?>
               
              <div class="div" style="display:flex;justify-content:space-between;">
                <label class="ml-3 mt-2 h5 sub_titulo Genero_<?php echo $IDGenero ?>"> Juegos de <?php echo $NombreGenero ?>  </label> <a href="Search.php?tipo=<?php echo base64_encode('j'); ?>&g=<?php echo base64_encode($NombreGenero) ?>&idg=<?php echo base64_encode($IDGenero) ?>" class="h5 btn sub_titulo"> VER MÁS <i class="fa-solid fa-angles-right"></i> </a>
              </div>
                <div class="row text-center mt-3 FilaGenero">
                <!-- Juegos del Genero -->
              <?php
              while ($row2 = mysqli_fetch_assoc($res2)) {
                $IDApp=$row2['ID'];
                $Nombre=$row2['Nombre'];
                $Detalle=$row2['Detalles'];
                $Icono= $row2['Icono'];
                $Poster=$row2['Poster'];
                $Version=$row2['Version'];
                $Actualizacion=$row2['Actualizacion'];
                $Requisitos=$row2['Requisitos'];
                $Genero=$row2['Genero'];
                ?>
                <div class="ml-7 col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
                  <a href="Seleccion.php?/=j&id=<?php echo $IDApp ?>">
                    <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
                  </a>
                  <label> <?php echo $Nombre ?> </label>
                </div>
                <?php
              }
              ?>
                </div>
              <?php
            }
          }
        }
        else {
          ?>
          <div class="col-12 alert alert-danger">
            NO hay generos guarados!
          </div>
          <?php
        }
        ?>
      <!----------------------->
    </main>
    
    
    

    <?php include "../footer.html"; ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
    <!-- My JavaScritp -->
    <script src="../assets/myJS.js"></script>   
  </body>
</html>