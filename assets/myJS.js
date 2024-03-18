//header.php
  //BOTON DE ADMINISTRADOR
  $('.btn-flotante-admin').click(function () {
    /* AJAX PARA TRAER DATOS */

    $.ajax({
        url:'../assets/Ajax.php',
        type:'POST',
        data:{'Buscar_Generos':1},
        
      }).done(function(res){
        $('.modal-title').html('Agregar Nueva App');
        $('.modal-footer').hide();
        $('.modal-body').html('<form method="POST" action="../Datos/DatosApps.php" enctype="multipart/form-data"><div class="container"><div class="row text-center"><div class="col-12 mb-2 alert alert-info"> Tipo de Aplicación: <br> <select class="form-control" name="TipoApp" required> <option value="" disabled selected> Seleccionar: </option> <option value="Juego">Juego</option><option value="App">App</option></select> </div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4"> <label>Nombre</label><br> <input type="text" name="Nombre" class="form-control" required> </div> <div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4"> <label>Genero</label><br><select class="form-control" name="Genero" required> <option value="" disabled selected> Seleccionar: </option> '+ res +' </select></div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 mt-1"><label>Versión</label><br><input type="text" name="Version" class="form-control" required></div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 mt-1"><label>Fecha de Actualización</label><br><input type="date" name="Actualizacion" class="form-control" required></div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 mt-1"><label>Requisitos (Versión de Android)</label><br><input type="text" name="Requisitos" class="form-control" required></div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 mt-1"><label>URL</label><br><input type="text" name="URL" class="form-control"></div><div class="col-12 col-xs-12 col-sm-6 col-md-4 col-lg-4 mt-1"><label>Desarollador</label><br><input type="text" name="Desarollador" class="form-control"></div><div class="col-12 col-xs-12 col-sm-8 col-md-8 col-lg-8 mt-1"><label>Detalles</label> <textarea class="form-control" name="Detalles" required></textarea></div><div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-1"><label>Icono</label><br><input type="file" name="Icono" required></div><div class="col-12 col-xs-12 col-sm-6 col-md-6 col-lg-6 mt-1"><label>Poster</label><br><input type="file" name="Poster" required></div><div class="col-12 mt-1"><label>URL del APK</label><br><input type="text" name="URLAPK" class="form-control" required></div><div class="col-12 mt-5"><input type="submit" value="Guardar" class="btn btn-primary"></div> </div></div>  <input type="hidden" name="GuardarJuego" value="1"></form>');
      })

  })

  //FOTO USUARIO
  $('#Foto_Usuario').on('click',function() {
      $('.Menu_Desplegable_Perfil').fadeIn();
  })
  $('#Foto_Usuario').mouseleave(function() {
      $('.Menu_Desplegable_Perfil').hide();
  })
  $('.Menu_Desplegable_Perfil').hover(function() {
      $('.Menu_Desplegable_Perfil').show();
  })
  $('.Menu_Desplegable_Perfil').mouseleave(function() {
      $('.Menu_Desplegable_Perfil').hide();
  })
/////////////////////////////////////

//juegos.php y apps.php

  //RECARGAR VIDEO AL PASAR CARUSEL
  $('.carousel-control-prev').on('click',function () {
    $('.iframe_trailer').each(function() {
      $(this).attr('src', $(this).attr('src'));
    });
    
  })
  $('.carousel-control-next').on('click',function () {
    $('.iframe_trailer').each(function() {
      $(this).attr('src', $(this).attr('src'));
    });
    
  })

  //VER MAS INFORMACIÓN DE LA APP
  $('.btn_more_info_game').on('click',function () {
    var info = $('.more_info_game').css('display');
    if (info == 'none') {
      $('.more_info_game').fadeIn();
      $('.fa-chevron-down').hide()
      $('.fa-chevron-up').show()
    }
    else{
      $('.more_info_game').fadeOut();
      $('.fa-chevron-down').show()
      $('.fa-chevron-up').hide()
    }
  })
/////////////////////////////////////

//SELECCION

  //VER TRAILER 
    $('#View_Trailer').on('click', function() {
      var URL = $(this).attr('URL');
      Swal.fire({
      html: '<div style="height:90vh;width:100%;display:flex;justify-content: center;align-items: center;"><iframe class="iframe_trailer" width="800px" height="400px" src="'+ URL +'" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>',
      grow:'fullscreen',
      showConfirmButton:false,
      showCloseButton:true,
      background:'rgb(0,0,0, .3)',
    
      })
      $('.swal2-modal').on('click', function () {
        swal.close();
      })
    })

  //EDITAR APP (PARA ADMINISTRADORES)
    //MODIFICAR TRAILER
    $('#mod_trailer').on('click', function () {
      var IDAPP = $(this).attr('IDApp');
      var URL = $(this).attr('URL');
      Swal.fire({
        title:'<label class="text-primary">Actualizar URL:</label>',
        html:'<label>URL Actual:</label><input type="text" disabled class="form-control text-info" value="'+ URL +'"><br><label> Nueva URL: </label><input type="text"  class="form-control" id="NewURL"><button id="Modificar_URL" class="btn btn-warning mt-3" disabled> Modificar </button>',
        showConfirmButton:false,
        showCloseButton:true
      })
      $('#NewURL').keyup(function() {
        if ($(this).val() != "") {
         $('#Modificar_URL').attr('disabled', false);
        }
        else{
          $('#Modificar_URL').attr('disabled', true);
        }
      })
      $('#Modificar_URL').on('click', function() {
        var nuevaURL = $('#NewURL').val();
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Trailer':1 ,'IDAPP':IDAPP, 'URL':nuevaURL},
        }).done(function(res) {
          if (res == 1) {
            swal.close();
            Swal.fire({
              icon:'success',
              //toast:true,
              html:'¡Modificado con éxito!',
              footer:'la pagina se recargara para aplicar cambios.',
              timer:'2500',
              timerProgressBar:true,
              showConfirmButton:false
            })
            setTimeout(() => {
              location.reload();
            }, 2450);
          }
          
        })
      })
    })
    //MODIFICAR NOMBRE
    $('#mod_name').on('click', function () {
      var IDApp = $(this).attr('IDApp');
      var NameAnt = $.trim($('#Name').html());
      $('#Name').html('<input type="text" name="Nombre" value="'+NameAnt+'" class="form-control InpNom">');
      $('.InpNom').focus();//ENFOCAR INPUT

      //Guardar Cambios (AL PERDER FOCO)
      $('.InpNom').blur(function () {
        var NuevoNombre = $(this).val();
        //ajax
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Nombre':1, 'NuevoNombre':NuevoNombre, 'IDApp': IDApp},
        }).done(function (res) {
          if (res == 1) {
            //Quitar input de modificar
            $('#Name').html(NuevoNombre);
            $('.Nombre_v1').html(NuevoNombre);
            $('.Nombre_v2').html('<label class="h5"> Acerca de '+ NuevoNombre +' </label>');
            $('.Nombre_v3').html('Por favor califica '+NuevoNombre+':');
            //alerta
            Swal.fire({
              icon:'success',
              title:'Modificado con éxito!',
              toast:true,
              position:'top-end',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false
            })
          }
        })
      })
    })
    //MODIFICAR VERSION
    $('#mod_version').on('click', function () {
      var IDApp = $(this).attr('IDApp');
      var VersionAnt = $.trim($('#Version').html());
      $('#Version').html('<input type="text" name="Version" value="'+VersionAnt+'" class="form-control InpVer">');
      $('.InpVer').focus();//ENFOCAR INPUT

      //Guardar Cambios (AL PERDER FOCO)
      $('.InpVer').blur(function () {
        var NuevaVersion = $(this).val();
        //ajax
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Version':1, 'NuevaVersion':NuevaVersion, 'IDApp': IDApp},
        }).done(function (res) {
          if (res == 1) {
            //Quitar input de modificar
            $('#Version').html(NuevaVersion);
            $('.Version_1').html(NuevaVersion);
            //alerta
            Swal.fire({
              icon:'success',
              title:'Modificado con éxito!',
              toast:true,
              position:'top-end',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false
            })
          }
        })
      })
    })
    //MODIFICAR DESAROLLADOR
    $('#mod_desarollador').on('click', function () {
      var IDApp = $(this).attr('IDApp');
      var DesarolladorAnt = $.trim($('#Desarollador').html());
      $('#Desarollador').html('<input type="text" name="Desarollador" value="'+DesarolladorAnt+'" class="form-control InpVer">');
      $('.InpVer').focus();//ENFOCAR INPUT

      //Guardar Cambios (AL PERDER FOCO)
      $('.InpVer').blur(function () {
        var NuevoDesarollador = $(this).val();
        //ajax
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Desarollador':1, 'NuevoDesarollador':NuevoDesarollador, 'IDApp': IDApp},
        }).done(function (res) {
          if (res == 1) {
            //Quitar input de modificar
            $('#Desarollador').html(NuevoDesarollador);
            $('.Desarollador_1').html(NuevoDesarollador);
            //alerta
            Swal.fire({
              icon:'success',
              title:'Modificado con éxito!',
              toast:true,
              position:'top-end',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false
            })
          }
        })
      })
    })
    //MODIFICAR FECHA
    $('#mod_fecha').on('click', function () {
      var IDApp = $(this).attr('IDApp');
      var FechaAnt = $.trim($('#Fecha').html());
      $('#Fecha').html('<input type="date" name="Fecha" value="'+FechaAnt+'" class="form-control InpFecha">');
      $('.InpFecha').focus();//ENFOCAR INPUT

      //Guardar Cambios (AL PERDER FOCO)
      $('.InpFecha').blur(function () {
        var NuevaFecha = $(this).val();
        //ajax
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Fecha':1, 'NuevaFecha':NuevaFecha, 'IDApp': IDApp},
        }).done(function (res) {
          if (res == 1) {
            //Quitar input de modificar
            $('#Fecha').html(NuevaFecha);
            $('.Fecha_1').html(NuevaFecha);
            //alerta
            Swal.fire({
              icon:'success',
              title:'Modificado con éxito!',
              toast:true,
              position:'top-end',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false
            })
          }
        })
      })
    })
    //MODIFICAR APK
    $('#mod_APK').on('click', function() {
      var IDAPP = $(this).attr('IDApp');
      var apk = $(this).attr('apk');
      var tipo = $(this).attr('tipo');
      Swal.fire({
        title:'Modificar APK',
        html:'<form method="POST" enctype="multipart/form-data" action="../Datos/DatosApps.php"><input type="hidden" name="tipo" value="'+tipo+'"><input type="hidden" name="IDApp" value="'+IDAPP+'"><input type="hidden" value="1" name="ModificarAPK"><label class="mb-4">Nuevo APK:</label><input id="FileNewApk" name="NuevaAPK" type="text" class="form-control" required><input type="submit" value="Modificar" class="btn btn-success mt-3"></form>',
        showConfirmButton:false,
        showCloseButton:true
      })
    })
    //MODIFICAR ICONO
    $('#mod_Icono').on('click', function() {
      var IDAPP = $(this).attr('IDApp');
      var Icono = $(this).attr('Icono');
      var tipo = $(this).attr('tipo');
      Swal.fire({
        title:'Modificar Icono',
        html:'<form method="POST" enctype="multipart/form-data" action="../Datos/DatosApps.php"><input type="hidden" name="tipo" value="'+tipo+'"><input type="hidden" name="Icono" value="'+Icono+'"><input type="hidden" name="IDApp" value="'+IDAPP+'"><input type="hidden" value="1" name="ModificarIcono"><label class="mb-4">Nuevo Icono:</label><input id="FileNewIcono" name="NuevoIcono" accept=".png, .jpg, .jpeg" type="file" required><input type="submit" value="Modificar" class="btn btn-success mt-3"></form>',
        showConfirmButton:false,
        showCloseButton:true
      })
      //VALIDAR EXTENCION DEL ARCHIVO(SOLO APK Y XAPK)
      $("#FileNewIcono").change(function(){
        var fileName = this.files[0].name;
        var ext = fileName.split('.');
        ext = ext[ext.length-1];
        switch (ext) {
					case 'png':
            break;	
            case 'jpg': 
					break;
            case 'jpeg': 
					break;
					default:
            $(this).val('');
						alert('Solo estan permitidos los formatos: png/jpg/jpeg');
					break;	
				}
      });
    })
    //MODIFICAR ICONO
    $('#mod_Poster').on('click', function() {
      var IDAPP = $(this).attr('IDApp');
      var Poster = $(this).attr('Poster');
      var tipo = $(this).attr('tipo');
      Swal.fire({
        title:'Modificar Poster',
        html:'<form method="POST" enctype="multipart/form-data" action="../Datos/DatosApps.php"><input type="hidden" name="tipo" value="'+tipo+'"><input type="hidden" name="Poster" value="'+Poster+'"><input type="hidden" name="IDApp" value="'+IDAPP+'"><input type="hidden" value="1" name="ModificarPoster"><label class="mb-4">Nuevo Poster:</label><input id="FileNewPoster" name="NuevoPoster" accept=".png, .jpg, .jpeg" type="file" required><input type="submit" value="Modificar" class="btn btn-success mt-3"></form>',
        showConfirmButton:false,
        showCloseButton:true
      })
      //VALIDAR EXTENCION DEL ARCHIVO(SOLO APK Y XAPK)
      $("#FileNewPoster").change(function(){
        var fileName = this.files[0].name;
        var ext = fileName.split('.');
        ext = ext[ext.length-1];
        switch (ext) {
          case 'png':
            break;	
            case 'jpg': 
          break;
            case 'jpeg': 
          break;
          default:
            $(this).val('');
            alert('Solo estan permitidos los formatos: png/jpg/jpeg');
          break;	
        }
      });
    })
    //MODIFICAR DETALLES
    $('#mod_detalles').on('click', function() {
      var IDApp = $(this).attr('IDApp');
      var DetallesAnt = $.trim($('#Detalles').html());
      $('#Detalles').html('<textarea class="form-control TextareaDetalles" style="resize:none;height:200px;">'+DetallesAnt+'</textarea>');
      $('.TextareaDetalles').focus();//ENFOCAR INPUT

      //Guardar Cambios (AL PERDER FOCO)
      $('.TextareaDetalles').blur(function () {
        var NuevoDetalles = $(this).val();
        //ajax
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'Modificar_Detalles':1, 'NuevoDetalles':NuevoDetalles, 'IDApp': IDApp},
        }).done(function (res) {
          console.log(IDApp);
          console.log(res);
          if (res == 1) {
            //Quitar input de modificar
            $('#Detalles').html(NuevoDetalles);
            //alerta
            Swal.fire({
              icon:'success',
              title:'Modificado con éxito!',
              toast:true,
              position:'top-end',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false
            })
          }
        })
      })
    })
  
      


    

    //Comentarios
      //Estrellas Comentarios
      $('.est_1').on('click',function() {
        $('.estrella_1').css('color','orange');
        $('.estrella_2').css('color','gray');
        $('.estrella_3').css('color','gray');
        $('.estrella_4').css('color','gray');
        $('.estrella_5').css('color','gray');
        $('.estr_x').fadeIn();
      })
      $('.est_2').on('click',function() {
        $('.estrella_1').css('color','orange');
        $('.estrella_2').css('color','orange');
        $('.estrella_3').css('color','gray');
        $('.estrella_4').css('color','gray');
        $('.estrella_5').css('color','gray');
        $('.estr_x').fadeIn();
      })
      $('.est_3').on('click',function() {
        $('.estrella_1').css('color','orange');
        $('.estrella_2').css('color','orange');
        $('.estrella_3').css('color','orange');
        $('.estrella_4').css('color','gray');
        $('.estrella_5').css('color','gray');
        $('.estr_x').fadeIn();
      })
      $('.est_4').on('click',function() {
        $('.estrella_1').css('color','orange');
        $('.estrella_2').css('color','orange');
        $('.estrella_3').css('color','orange');
        $('.estrella_4').css('color','orange');
        $('.estrella_5').css('color','gray');
        $('.estr_x').fadeIn();
      })
      $('.est_5').on('click',function() {
        $('.estrella_1').css('color','orange');
        $('.estrella_2').css('color','orange');
        $('.estrella_3').css('color','orange');
        $('.estrella_4').css('color','orange');
        $('.estrella_5').css('color','orange');
        $('.estr_x').fadeIn();
      })
      $('.estr_x').on('click', function() {
        $('.estrella_1').css('color','gray');
        $('.estrella_2').css('color','gray');
        $('.estrella_3').css('color','gray');
        $('.estrella_4').css('color','gray');
        $('.estrella_5').css('color','gray');
        $('.estr_x').fadeOut();
      })

      //Borrar Comentario
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
                Swal.fire(
                  'Eliminado!',
                  'Tu comntario fue eliminado con éxito.',
                  'success'
                )
                $('.ComentarioUser_'+IDComent).hide();
                BTNDELETE.hide();
              }
            })
          }
        })
      })
/////////////////////////////////////

//Register.php

//Verificar si existe el correo
$('#Correo').blur(function() {
 var Correo = $('#Correo').val();
 if (Correo != null) {

  //AJAX PARA VERIFICAR SI EXISTE EL CORREO
 $.ajax({
  url:'../assets/Ajax.php',
  type:'POST',
  data:{'VerificarCorreo':1,'Correo':Correo},
 }).done(function(res) {
  if (res == 1) {
    $('#Registrar').attr('disabled', true);
    $('#Correo').css('border','1px solid red');
    $('#Correo').focus();
    $('#Password').val('');
    $('#Password2').val('');

    Swal.fire({
      icon:'error',
      toast:true,
      html:'Correo ya registrado, Por favor ingrese otro.',
      showConfirmButton:false,
      timerProgressBar: true,
      position:'top-end',
      timer:'2500'
    })
  }
  else{
    $('#Correo').css('border','1px solid #ced4da');
    $('#Registrar').attr('disabled', false);
  }
 })

  
 }
})

//Verificar si las contraseñas son iguales
$('#Password2').mouseleave(function() {
  var Password1 = $('#Password').val();
  var Password2 = $(this).val();

  if (Password1 != null) {
   if (Password2 != Password1) {
    $('#Registrar').attr('disabled', true);
    $('#Password2').css('border','1px solid red');
    $('#Password2').focus();    
   } 
   else{  
    $('#Password2').css('border','1px solid #ced4da');
    $('#Registrar').attr('disabled', false);  
   }
  }
})
/////////////////////////////////////


//Search.php
$('#MostOcult_Game').on('click', function() {
  var Game = $('#Game');
  var Caret_1 = $('.caret-down_1');
  var Caret_2 = $('.caret-up_1');

  if (Game.css('display') != 'none') {
    Game.fadeOut();
  }
  else{
    Game.fadeIn();
  }

  if (Caret_1.css('display') != "none") {
    Caret_1.css('display', 'none');
    Caret_2.css('display', 'inline-block');
  }
  else{
    Caret_1.css('display', 'inline-block');
    Caret_2.css('display', 'none');
  }

  

  
})
$('#MostOcult_APP').on('click', function() {
  var APP = $('#APP');
  var Caret_1 = $('.caret-down_2');
  var Caret_2 = $('.caret-up_2');

  if (APP.css('display') != 'none') {
    APP.fadeOut();
  }
  else{
    APP.fadeIn();
  }

  if (Caret_1.css('display') != "none") {
    Caret_1.css('display', 'none');
    Caret_2.css('display', 'inline-block');
  }
  else{
    Caret_1.css('display', 'inline-block');
    Caret_2.css('display', 'none');
  }
  
})

/////////////////////////////////////



//Configuraciones:
  //Modificar Icono
  $('#Mod_Icono_user').on('click', function() {
    var IDUsuario = $(this).attr('IDusuario');
    var FotoAnterior = $(this).attr('Foto');
    Swal.fire({
      title:'Cambiar Icono de usuario',
      html:'<form method="POST" enctype="multipart/form-data" action="../Datos/DatosCuenta.php"><input type="hidden" value="1" name="ModificarIconoUser"><input type="hidden" value="'+IDUsuario+'" name="IDUsuario"><input type="hidden" value="'+FotoAnterior+'" name="FotoAnterior"><input type="file" name="NuevoIcono"><br><input type="submit" value="Cambiar" class="mt-3 btn btn-outline-primary"></form>',
      showCloseButton:true,
      showConfirmButton:false,
    })
  })

  //Modificar Nombre
  $('#Mod_Nombre_User').on('click', function() {
    var IDUsuario = $(this).attr('IDUsuario');
    var NombreAcutal = $.trim($('#Nombre_User_Mostrar').html());
    $('#Nombre_User_Mostrar').html('<input type="text" value="'+ NombreAcutal+'" id="Inp_Nombre_User" class="form-control">');
    $('#Inp_Nombre_User').focus();
    $('#Inp_Nombre_User').blur(function() {
      if ( $('#Inp_Nombre_User').val() != "") {
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'ModificarNombreUsuario':1, 'IDUsuario':IDUsuario, 'NuevoNombreUsuario':$('#Inp_Nombre_User').val()},
        }).done(function(res) {
          if(res == 1){
            Swal.fire({
              icon:'success',
              toast:true,
              title:'Nombres de Usuario modificado con éxito',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false,
              position:'top-end'
            })
            $('#Nombre_User_Mostrar').html($('#Inp_Nombre_User').val());
            location.reload();
          }
          
        })
      }
      else{
        $('#Inp_Nombre_User').focus();
        $('#Inp_Nombre_User').css('border', '2px solid red');
      }
    })
  })
  //Modificar Apellido
  $('#Mod_Apellido_User').on('click', function() {
    var IDUsuario = $(this).attr('IDUsuario');
    var ApellidoAcutal = $.trim($('#Apellido_User_Mostrar').html());
    $('#Apellido_User_Mostrar').html('<input type="text" value="'+ ApellidoAcutal+'" id="Inp_Apellido_User" class="form-control">');
    $('#Inp_Apellido_User').focus();
    $('#Inp_Apellido_User').blur(function() {
      if ($('#Inp_Apellido_User').val() != "") {
        $.ajax({
          url:'../assets/Ajax.php',
          type:'POST',
          data:{'ModificarApellidoUsuario':1, 'IDUsuario':IDUsuario, 'NuevoApellidoUsuario':$('#Inp_Apellido_User').val()},
        }).done(function(res) {
          if(res == 1){
            Swal.fire({
              icon:'success',
              toast:true,
              title:'Apellidos de Usuario modificado con éxito',
              timer:'1500',
              timerProgressBar:true,
              showConfirmButton:false,
              position:'top-end'
            })
            $('#Apellido_User_Mostrar').html($('#Inp_Apellido_User').val());
          }
          
        })
      }
      else{
        $('#Inp_Apellido_User').focus();
        $('#Inp_Apellido_User').css('border', '2px solid red');
      }
    })
  })
  //Modificar Correo
  $('#Mod_Correo_User').on('click', function() {
    Swal.fire({
      icon:'error',
      title:'No esta permitido modificar el correo!',
      html:'Si necesitas ayuda comunícate conmigo através de mis rede sociales:<br><br><a target="_blank" href="https://www.facebook.com/emaanuelcarballo"><i class="fa-brands fa-facebook mr-3 icon-size"></i></a><a target="_blank" href="https://www.instagram.com/emaanuelcarballo/"><i class="fa-brands fa-instagram mr-3 icon-size text-danger"></i></a><a target="_blank" href="https://twitter.com/EmanuelCarbal16"><i class="fa-brands fa-twitter icon-size"></i></a>',
      showConfirmButton:false,
      showCloseButton:true,
    })
  })
  //Modificar Contraseña
  $('#ModPass_User').on('click', function() {
    var IDUsuario = $(this).attr('IDUsuario');
    Swal.fire({
      icon:'warning',
      title:'Modificar Contraseña:',
      html:'<label></label><br><input type="password" placeholder="Contraseña Anterior" id="Inp_Verificar_Password" class="form-control"><div id="CofirmPasswordError" style="display:none;" class="alert mt-2 alert-danger" role="alert"><label class="h6 font-weight-bold text-danger">Contraseña incorrecta, Por favor vuelve a intentarlo.</label></div><br><input type="password" placeholder="Nueva Contraseña" id="Inp_New_Password" class="form-control"><div style="display:none;" id="ErrorNewPassword" class="alert alert-danger mt-2" role="alert"><label class="h6 font-weight-bold text-danger"> La contraseña debe tener entre 8 a 16 caracteres. </label></div><button class="mt-3 btn btn-outline-warning" id="Btn_C" disabled> Confirmar </button>',
      showConfirmButton:false,
      showCloseButton:true
    })
    $('#Inp_Verificar_Password').keyup(function() {
      var Password = $(this).val();
      var NewPassword = $('#Inp_New_Password').val();
      if (Password == "" || NewPassword == "") {
        $('#Btn_C').attr('disabled', true);
      }
      else{
        $('#Btn_C').attr('disabled', false);
      }

      //QUITAR ERROR
      $('#CofirmPasswordError').fadeOut();
      $('#Inp_Verificar_Password').css('border', '1px solid #ced4da');
    })
    $('#Inp_New_Password').keyup(function() {
      var Password = $('#Inp_Verificar_Password').val();
      var NewPassword = $(this).val();
      if (Password == "" || NewPassword == "") {
        $('#Btn_C').attr('disabled', true);
      }
      else{
        $('#Btn_C').attr('disabled', false);
      }

      //QUITAR ERROR
      $('#ErrorNewPassword').fadeOut();
      $('#Inp_New_Password').css('border', '1px solid #ced4da');
    })
    $('#Btn_C').on('click', function() {
      var Password = $('#Inp_Verificar_Password').val();
      var NewPassword = $('#Inp_New_Password').val();
      var CantCaracteres = $('#Inp_New_Password').val().length;

      $.ajax({
        url:'../assets/Ajax.php',
        type:'POST',
        data:{'VerificarPassword':1,'IDUsuario':IDUsuario, 'Password':Password},
      }).done(function(res) {
        //Exito
        if (res == 1) {
          $('#Inp_Verificar_Password').css('border','1px solid green');
          
          if (CantCaracteres >=8 && CantCaracteres <=16) {
            $.ajax({
            url:'../assets/Ajax.php',
            type:'POST',
            data:{'CambiarPassword':1, 'IDUsuario':IDUsuario, 'NewPassword': NewPassword},
            }).done(function (res) {
            if (res == 1) {
              Swal.fire({
                icon:'success',
                title:'Contraseña renovada con éxito!',
                showConfirmButton:false,
                timer:'1500',
                timerProgressBar:true,
                footer:'La pagina se recargara para aplicar cambios.'
              })
              setTimeout(() => {
                location.reload();
              }, 1400);
            }
            })
          }
          else{
            $('#ErrorNewPassword').fadeIn();
            $('#Inp_New_Password').css('border', '1px solid red');
          }
        }
        //Contraseña anterior incorrecta
        else{
          $('#CofirmPasswordError').fadeIn();
          $('#Inp_Verificar_Password').css('border', '1px solid red');
        }

      })
        
    })

  })

/////////////////////////////////////

