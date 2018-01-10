/**
 * bitacora 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Julio cesar cortes
 * Email: Juliocesar.cortes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */
 // metodos de localstorage
 function setView(type){localStorage.setItem("viewAdmin", type);}
 function getView() {return localStorage.getItem("viewAdmin");}

 function showFade() {$('#preloader').fadeIn('slow');$('#status').fadeIn();}
 function hideFade() {$('#preloader').fadeOut('slow');$('#status').fadeOut();}

 function setMainPath(url) {localStorage.setItem("urlAdmin", url);}
 function getMainPath() {return localStorage.getItem("urlAdmin");}

 function routerUtilities(){
   //fechaActual()
   //horaActual()
 }
/*========================================================================*/
 // metodos de mensajes myApp.alert(mensaje);
 function message(mensaje) { alertify.alert(mensaje);}
/*========================================================================*/
 //metodos utiles
function set(div){
  return document.querySelector(div)
}

function search(nameKey, myArray){
  let ret = false
    for (var i=0; i < myArray.length; i++) {
        if (myArray[i].id === nameKey) {
            ret = true
        }
    }
    return ret
}

 function focusNow(elem) {
 	setTimeout(function(){
 		var x = window.scrollX, y = window.scrollY;
   	$(elem).focus();
   	window.scrollTo(x, y);
 	}, 1500);

 	$(elem).on('focus', function() {
     document.body.scrollTop = $(this).offset().top;
 	});
 }
/*========================================================================*/
 function getNameURLWeb() {
     var sPath = window.location.pathname;
     var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
     return sPage;
 }
/*========================================================================*/
 function volver() {window.history.back();}
/*========================================================================*/
 function reload() {document.location.reload();}
/*========================================================================*/
 function redirect(url) {window.location.href = url;}
/*========================================================================*/
 function acortador(text) {
     var total = text.length;
     if (text.indexOf('-') != -1) {alert(text);}
     return str.substring(8, total);
 }
/*========================================================================*/
 function fechaActual() {
     var fecha = new Date();
     var dd = fecha.getDate();
     var mm = fecha.getMonth() + 1; //January is 0!
     var yyyy = fecha.getFullYear();
     if (dd < 10) {
         dd = '0' + dd;
     };
     if (mm < 10) {
         mm = '0' + mm;
     };
     fecha = yyyy + '-' + mm + '-' + dd;
     if(set(".today") != null){
       set(".today").value = fecha
     }
     return fecha;
 }

function cleanForm(form){
document.getElementById(form).reset();
}

 /*========================================================================*/
 function horaActual() {
     var fecha = new Date();
     var hora = fecha.getHours();
     var minuto = fecha.getMinutes();
     var segundo = fecha.getSeconds();
     if (hora < 10) {
         hora = "0" + hora
     };
     if (minuto < 10) {
         minuto = "0" + minuto
     };
     if (segundo < 10) {
         segundo = "0" + segundo
     };
     var horita = hora + ":" + minuto;

     if(set(".time") != null){
       set(".time").value = horita
     }
     return horita;
 }
 /*========================================================================*/
 function horsa() {
     var fecha = new Date()
     var hora = fecha.getHours()
     var minuto = fecha.getMinutes()
     var meridiano = " am"
     if (hora > 12) {
         hora -= 12;
         meridiano = " pm"
     }
     if (hora < 10) {
         hora = "0" + hora
     }
     if (minuto < 10) {
         minuto = "0" + minuto
     }
     puntos == ":" ? puntos = " " : puntos = ":"
     var horita = hora + puntos + minuto + meridiano;
     return horita;
 }
 /*========================================================================*/
 function formatAMPM() {
     var date = new Date()
     var hours = date.getHours();
     var minutes = date.getMinutes();
     var ampm = hours >= 12 ? 'pm' : 'am';
     hours = hours % 12;
     hours = hours ? hours : 12; // the hour '0' should be '12'
     minutes = minutes < 10 ? '0' + minutes : minutes;
     var strTime = hours + ':' + minutes + ' ' + ampm;
     return strTime;
 }
 /*========================================================================*/
 //metodos para validar formularios
 function validatePassword(pass, pass2) {

   if(pass == pass2) {
     return true;
   } else {
     message("Las contraseñas introducidas no coinciden, por favor introdúcelas nuevamente.");
     return false;
   }
 }
/*========================================================================*/
 function validateEmail(email) {
   if(!(/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email))) {
     message('Introduzca un e-mail válido.');
     return false;
   } else {
     return true;
   }
 }
/*========================================================================*/
function numberFormat(ob){
  var val = $(ob).val();
  console.log(typeof val)
  if(typeof val == 'string'){
    val = removeNumber(val);
  }
  $(ob).val(formatNumber.new(val));
}
//metodos para obtener numero en decimales
var formatNumber = {
        separador: ".", // separador para los miles
        sepDecimal: ',', // separador para los decimales
        formatear: function(num) {
          if(num){
             num += '';
          var splitStr = num.split('.');
          var splitLeft = splitStr[0];
          var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
          var regx = /(\d+)(\d{3})/;
          while (regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
          }
          return splitLeft + splitRight
          }
          else{
            return null;
          }

        },
        new: function(num, simbol) {
          //this.simbol = simbol || '$';
          return this.formatear(num);
        }
      }

    // formatNumber.new(123456779.18, "$") // retorna "$123.456.779,18"
    // formatNumber.new(123456779.18) // retorna "123.456.779,18"
    // formatNumber.new(123456779) // retorna "$123.456.779"
    function removeNumber(num){
      num = num.split('$').join('');
      num = num.split('.').join('');
      num = num.split(',').join('');
      return parseInt(num);
    }
 /*========================================================================*/
 //metodos responsive
 function obenerescreen() {
     if (screen.width < 1024)
         document.write("Pequeña")
     else
     if (screen.width < 1280)
         document.write("Mediana")
     else
         document.write("Grande")
 }
/*========================================================================*/
 function validateImage(archivo, validate){
   extensiones_permitidas = new Array(".gif", ".jpg",".png");
   error = "";
   if (!archivo){error = "No has seleccionado ningúna imagen";}
   else{
      //recupero la extensión de este nombre de archivo
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase();
      //compruebo si la extensión está entre las permitidas
      permitida = false;
      for (var i = 0; i < extensiones_permitidas.length; i++) {
       if (extensiones_permitidas[i] == extension) {
        permitida = true;
        break;
      }
    }
    if (!permitida) {
     error = "Sube un formato de imagen valido.";
   }else{
     return true;
   }
 }
   //si estoy aqui es que no se ha podido submitir
   if(validate>0){
     message(error);
   }
   return false;
 }
