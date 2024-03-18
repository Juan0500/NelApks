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

    <?php include "../header.php";?>

    <main class="mt-5"> <br> <br>
      <!-- SI NO HAY RESULTADOS -->
      <?php
      if (isset($_POST['b'])) {
        $b = $_POST['b'];
        $sqlP = "SELECT * FROM apps WHERE Nombre LIKE '%$b%' ORDER BY RAND()";
        $resP = mysqli_query($conn,$sqlP);
        $num_rowsP = mysqli_num_rows($resP);
        //SI NO HAY RESULTADOS
        if ($num_rowsP == 0) {
          ?>
          <div class="container">
            <form action="Search.php" method="post">
            <div class="row text-center">
              <div class="col-12 alert alert-danger" role="alert">
                <label class="h3 text-danger"> <i class="fa-solid fa-face-sad-tear"></i> <i class="fa-solid fa-s"></i> <i class="fa-solid fa-i"></i> <i class="fa-solid fa-n"></i> <i class="fa-solid fa-r ml-2"></i> <i class="fa-solid fa-e"></i> <i class="fa-solid fa-s"></i> <i class="fa-solid fa-u"></i> <i class="fa-solid fa-t"></i> <i class="fa-solid fa-a"></i> <i class="fa-solid fa-d"></i> <i class="fa-solid fa-o"></i> <i class="fa-solid fa-exclamation"></i> <i class="fa-solid fa-face-sad-tear"></i></label>
                
              </div>
              <div class="col-12 mb-2"> <hr> Por favor vuelve a intentarlo.  </div>
              <div class="col-4 text-right mt-1"></div>
              <div class="col-4">
                <input type="text" name="b" placeholder="Buscar" class="form-control">
              </div>
              <div class="col-4 text-left">
                <button type="submit" class="btn"> <i class="fa-solid fa-magnifying-glass text-primary"></i> </button>
                
              </div>
              </form>
              <div class="col-12 mt-2"> <hr> </div>
            </div>
          </div>
          <?php
        }
        ////////////////////////////////////////////////

        //MOSTRAR RESULTADOS
        $sql = "SELECT * FROM apps WHERE TIPO = 'Juego' AND Nombre LIKE '%$b%' ORDER BY RAND()"; //SQL PARA TRAER JUEGOS
        $sql2 = "SELECT * FROM apps WHERE TIPO = 'App' AND Nombre LIKE '%$b%' ORDER BY RAND()"; //SQL PARA TRAER APPS

        $res = mysqli_query($conn,$sql); //DIRECCION DE SENTENCIA
        $res2 = mysqli_query($conn,$sql2); //DIRECCION DE SENTENCIA
        
        $num_rows_1 = mysqli_num_rows($res); //CANTIDAD DE FILAS DEL RESULTADO
        $num_rows_2 = mysqli_num_rows($res2); //CANTIDAD DE FILAS DEL RESULTADO

        //COMPROBAR SI SE ENCUENTRAN APPS Y JUEGOS
        if ($num_rows_1 > 0 && $num_rows_2 > 0) {
          ?>
          <div class="container div mt-3">
            <!-- TITULO -->
            <div class="row p-3">
              <div class="col-12   pt-2 pb-3">
                <label class="h2 sub_titulo">
                  <?php
                  if ($b == "") {
                    echo "Todas las Aplicaciones:";
                  }
                  else{
                    echo "Resultados de '". $b ."' :";
                  }
                  ?>
                </label>
              </div>
            </div>
            <!------------->
            <!-- SUBTITULO -->
            <div class="row">
              <div id="MostOcult_Game" class="col-12 text-center p-1 div m-2">
                <label class="h5 sub_titulo"> Juegos(<?php echo $num_rows_1 ?>) </label>
                <i class="fa-solid fa-caret-down ml-3 caret-down_1"></i>
                <i style="display:none;" class="fa-solid fa-caret-up ml-3 caret-up_1"></i>
              </div>
            </div>
            <!-------------->
            <div id="Game" class="row text-center text-center p-2 mt-3">
              <?php
                while ($row = mysqli_fetch_assoc($res)) {
                  $IDApp = $row['ID'];
                  $Nombre = $row['Nombre'];
                  $Icono = $row['Icono'];
                  $Tipo = $row['Tipo'];
        
                  ?>
                  <div class="col-4 col-xs-2 col-sm-2 text-center col-md-2 col-lg-1">
                  <a href="Seleccion.php?/=j&id=<?php echo $IDApp ?>">
                    <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
                  </a>
                  <label> <?php echo $Nombre ?> </label>
                  </div> <!-- CLOSE ROW GAME -->
                    <?php
                }
          ?></div> <!-- CLOSE DIV CONTAINER --> <?php
        
          ?>
          <!-- MENU DE RESULTADOS DE APPS -->
          <div class="row">
            <div id="MostOcult_APP" class="col-12 div text-center m-2 p-1">
              <label class="h5 sub_titulo"> APPS(<?php echo $num_rows_2 ?>) </label>
              <i class="fa-solid fa-caret-down ml-3 caret-down_2"></i>
              <i style="display:none;" class="fa-solid fa-caret-up ml-3 caret-up_2"></i>
            </div>
          </div>
          <div id="APP" class="row p-2 mt-3">
          <?php
          while ($row2 = mysqli_fetch_assoc($res2)) {
            $IDApp = $row2['ID'];
            $Nombre = $row2['Nombre'];
            $Icono = $row2['Icono'];
            $Tipo = $row2['Tipo'];
          ?>
          <div class="col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
            <a href="Seleccion.php?/=a&id=<?php echo $IDApp ?>">
              <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
            </a>
            <label> <?php echo $Nombre ?> </label>
          </div>
              <?php
            }
        }
        //COMPROBAR SI SE ENCUENTRA SOLO JUEGOS
        else if ($num_rows_1 > 0 && $num_rows_2 == 0) {
          ?>
          <div class="container div mt-3">
            <!-- Titulo -->
            <div class="row p-3">
              <div class="col-12 pt-2 pb-3">
                <label class="h2 sub_titulo">
                  <?php
                    if ($b == "") {
                      echo "Todas las Aplicaciones:";
                    }
                    else{
                      echo "Resultados de '". $b ."' :";
                    }
                  ?>
                </label>
              </div>
            </div>
            <!------------>
            <!-- SUBTITULO -->
            <div class="row">
              <div id="MostOcult_Game" class="col-12 text-center p-1 div m-2">
                <label class="h5 sub_titulo"> Juegos(<?php echo $num_rows_1 ?>) </label>
                <i class="fa-solid fa-caret-down ml-3 caret-down_1"></i>
                <i style="display:none;" class="fa-solid fa-caret-up ml-3 caret-up_1"></i>
              </div>
            </div>
            <!-------------->
            <div id="Game" class="row p-2 mt-3">
              <?php
                while ($row = mysqli_fetch_assoc($res)) {
                  $IDApp = $row['ID'];
                  $Nombre = $row['Nombre'];
                  $Icono = $row['Icono'];
                  $Tipo = $row['Tipo'];
        
                  ?>
                  <div class="col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
                  <a href="Seleccion.php?/=j&id=<?php echo $IDApp ?>">
                    <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
                  </a>
                  <label> <?php echo $Nombre ?> </label>
                  </div> <!-- CLOSE ROW GAME -->
                    <?php
                }
          ?></div> <!-- CLOSE DIV CONTAINER --> <?php
        
          ?>
          </div>
          <?php
        }
        //COMPROBAR SI SE ENCUENTRA SOLO APPS
        else if ($num_rows_1 == 0 && $num_rows_2 > 0) {
          ?>
          <div class="container div mt-3">
            <!-- Titulo -->
            <div class="row p-3">
              <div class="col-12 pt-2 pb-3">
                <label class="h2 sub_titulo">
                  <?php
                    if ($b == "") {
                      echo "Todas las Aplicaciones:";
                    }
                    else{
                      echo "Resultados de '". $b ."' :";
                    }
                  ?>
                </label>
              </div>
            </div>
            <!------------>
            <!-- SUBTITULO -->
            <div class="row">
              <div id="MostOcult_Game" class="col-12 text-center p-1 div m-2">
                <label class="h5 sub_titulo"> APPS(<?php echo $num_rows_2 ?>) </label>
                <i class="fa-solid fa-caret-down ml-3 caret-down_1"></i>
                <i style="display:none;" class="fa-solid fa-caret-up ml-3 caret-up_1"></i>
              </div>
            </div>
            <!-------------->
            <div id="Game" class="row p-2 mt-3">
              <?php
                while ($row = mysqli_fetch_assoc($res2)) {
                  $IDApp = $row['ID'];
                  $Nombre = $row['Nombre'];
                  $Icono = $row['Icono'];
                  $Tipo = $row['Tipo'];
        
                  ?>
                  <div class="col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
                  <a href="Seleccion.php?/=a&id=<?php echo $IDApp ?>">
                    <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
                  </a>
                  <label> <?php echo $Nombre ?> </label>
                  </div> <!-- CLOSE ROW GAME -->
                    <?php
                }
          ?></div> <!-- CLOSE DIV CONTAINER --> <?php
        
          ?>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
    <?php
      }
      elseif ($_GET['idg']) {
        $tipo= base64_decode($_GET['tipo']);
        $IDGenero = base64_decode($_GET['idg']);
        $NombreGenero = base64_decode($_GET['g']);
        $sql = "SELECT * FROM apps WHERE Genero = '$IDGenero'";
        $res = mysqli_query($conn,$sql);
        if ($res && mysqli_affected_rows($conn) > 0) {
          ?>
          <div class="container div">
            <div class="row p-3 text-center">
              <div class="col-12">
                <label class="h4 sub_titulo">Más <?php if( $tipo == "a" ){ echo "Aplicaciones"; } else{ echo "Juegos"; }  ?> de <?php echo $NombreGenero ?> :  </label>
              </div>
          <?php
          while ($row = mysqli_fetch_assoc($res)) {
            $IDApp=$row['ID'];
            $Nombre=$row['Nombre'];
            $Detalle=$row['Detalles'];
            $Icono= $row['Icono'];
            $Poster=$row['Poster'];
            $Version=$row['Version'];
            $Actualizacion=$row['Actualizacion'];
            $Requisitos=$row['Requisitos'];
            $Genero=$row['Genero'];
            ?>
            <div class="col-4 col-xs-2 col-sm-2 col-md-2 col-lg-1">
              <a href="Seleccion.php?/=<?php echo $tipo ?>&id=<?php echo $IDApp ?>">
                <img src="../Datos/<?php echo $Icono;?>" class="bordeR" width="80px" height="80px">
              </a>
              <label> <?php echo $Nombre ?> </label>
            </div>
            <?php
          }
          ?>
           </div>
          </div>
          <?php
        }
      }
      else{
          header("location:juegos.php");
      }
      ?>
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