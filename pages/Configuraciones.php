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
    //$ID = $_GET['id'];
    //Traer Datos del Usuario
    $sql="SELECT * FROM usuarios WHERE ID=$IDUsuario";
    $res = mysqli_query($conn,$sql);
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $Nombres = $row['Nombres'];
            $Apellidos = $row['Apellidos'];
            $Foto = $row['Foto'];
            $Correo = $row['Correo'];
            $Password = $row['Password'];
        }
    }

    ?>
    <main class="mt-5"> <br>
        <div class="container mt-5">
            <!-- INFORMACION PERSONAL -->
            <div class="row div pb-3">
                <div class="col-12 mt-3 text-center">
                    <label class="h4"> Informacion Personal </label> 
                </div>
                <div class="col-12 col-xs-12 col-sm-4 col-md-6 col-lg-2">
                    <?php
                    if (isset($IDUsuario)) {
                       ?>
                       <button class="btn" IDusuario="<?php echo $IDUsuario ?>" Foto="<?php echo $Foto ?>" id="Mod_Icono_user">
                           <img src="../Datos/<?php echo $Foto ?>" style="border-radius:100%;"  height="130px" width="130px">
                       </button>
                       <?php
                    }
                    else{
                        ?>
                        <img src="../Datos/<?php echo $Foto ?>"  height="130px">
                        <?php
                    }
                    ?>
                </div>
                <div class="col-12 col-xs-12 col-sm-12 col-md-8 col-lg-6 mt-10">
                    <?php
                    if (isset($Cedula)) {
                        $C_M = substr($Cedula, 0, 3);
                        ?>
                    <label class=""> Cedula: <?php echo $C_M. "*****" ?> </label>
                    <br>
                    <label class=""> Nombres:  <?php echo $Nombres ?></label>
                    <br>
                    <label class=""> Apellidos:  <?php echo $Apellidos ?> </label>
                    <?php

                    }
                    else {
                    ?>
                    <button class="btn" id="Mod_Nombre_User" IDUsuario="<?php echo $IDUsuario ?>"> <i class="fa-solid text-primary fa-pen-to-square"></i> </button> <label class="font-weight-bold"> Nombres: </label> <div class="Dis_inline_block" id="Nombre_User_Mostrar"> <?php echo $Nombres ?> </div>
                    <br>
                    <button class="btn" id="Mod_Apellido_User" IDUsuario="<?php echo $IDUsuario ?>"> <i class="fa-solid text-primary fa-pen-to-square"></i> </button> <label class="font-weight-bold"> Apellidos: </label> <div class="Dis_inline_block" id="Apellido_User_Mostrar">  <?php echo $Apellidos ?> </div>
                    <br>
                    <button class="btn" id="Mod_Correo_User"> <i class=" text-danger fa-solid fa-ban"></i> </button> <label class="font-weight-bold"> Correo electrónico: </label> <div class="Dis_inline_block" id="Correo_User_Mostrar"> <?php echo $Correo ?> </div>
                    <br>
                    <button class="btn" IDUsuario="<?php echo $IDUsuario ?>" id="ModPass_User"> <i class="fa-solid fa-pen-to-square text-primary"></i></button>
                    <label id="PasswordMostrar" class="font-weight-bold"> Contraseña: </label> <label for="">
                    <?php
                        $Cant_Caracteres = strlen($Password);
                        $i = 1;
                        while ($i <= $Cant_Caracteres) {
                            echo "*";
                            $i++;
                        }
                        
                    ?> 
                    </label>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <!-- COMENTARIOS -->
            <?php
            if (isset($IDUsuario)) {
                //Traer ID Juegos Comentados
                $sql="SELECT DISTINCT IDApp FROM comentarios WHERE IDUsuario = $IDUsuario";
                $res = mysqli_query($conn,$sql);
                if ($res && mysqli_affected_rows($conn) > 0) {
                    ?>
                    <div class="row div mt-2 pb-3 text-center">
                        <div class="col-12 text-left">
                            <label class="h6 p-3"> Aplicaciones que has comentado:</label>
                        </div>
                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        $IDApp=$row['IDApp'];

                        //Traer Nombre del Juego
                        $sql2="SELECT * FROM apps WHERE ID = $IDApp";
                        $res2 = mysqli_query($conn,$sql2);
                        if ($res2) {
                            while ($row2 = mysqli_fetch_assoc($res2)) {
                                $NombreJuego = $row2['Nombre'];
                                $IconoJuego = $row2['Icono'];
                            
                            }
                        }

                        ?>
                        <div class="col-6 col-cx-4 col-sm-2 col-md-2 col-lg-2">
                        <button class="btn JuegosComentados Most_Coment_Game_<?php echo $IDApp ?>" Foto="<?php echo $Foto ?>" IDApp="<?php echo $IDApp ?>">
                            <img style="border-radius:100%;" src="../Datos/<?php echo $IconoJuego ?>" height="50px">
                        </button>
                        <br>
                        <label> <?php echo $NombreJuego ?> </label>
                        </div>
                        <script>
                            $('.Most_Coment_Game_<?php echo $IDApp ?>').on('click', function() {
                                Boton = $(this);
                                var IDApp = $(this).attr('IDApp');
                                var Foto = $(this).attr('Foto');
                                
                                //Ajax
                                $.ajax({
                                url:'../assets/Ajax.php',
                                type:'POST',
                                data:{'MostComentario':1, 'IDApp':IDApp, 'IDUsuario': '<?php echo $IDUsuario ?>', 'Foto':Foto, 'Nombres':'<?php echo $Nombres ?>','Apellidos':'<?php echo $Apellidos ?>'},
                                }).done(function (res) {
                                    $('.JuegosComentados').css('background-color','white');
                                    Boton.css('background-color','rgb(0 123 255 / 42%)');
                                    $('.Coment_Game').css('display', 'flex');
                                    $('.Coment_Game').css('display', 'flex');
                                    $('.Coment_Game').html('<div class="col-12 alert alert-primary" role="alert"> Comentarios en <?php echo $NombreJuego ?> </div>'+res);
                                })
                            })
                        </script>
                        <?php
                    }
                }
            }
            ?>
            </div>
            <div style="display:none;max-height: 400px;overflow: auto;" class="Coment_Game row div mt-2 p-3 text-center"></div>
        </div>
        
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