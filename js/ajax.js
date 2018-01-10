/**
 * bitacora 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Julio cesar cortes
 * Email Juliocesar.cortes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */

function post(url, metodo, data) {
   //showFade();
     var datos = data + '&token=' + getToken() + '&typeView=' + getView();
     $.ajax({
       type: "POST",
       dataType: "json",
       url: getMainPath() + url,
       data: datos,
       beforeSend: function(resp) {},
       success: function(resp) {},
       complete: function(resp) {},
       error: function(resp) {
         sinConexion(resp)
       }
     }).done(function(resp) {
       //hideFade();
        metodo(resp);
     });
 }
/*========================================================================*/
 function postContent(url, metodo, data) {
     showFade();
     data.append("token", getToken());
     data.append("typeView", getView());
     $.ajax({
       type: "POST",
       dataType: "json",
       cache: false,
       processData: false,
       contentType: false,
       url: getMainPath() + url,
       data: data,
       beforeSend: function(resp) {},
       success: function(resp) {},
       complete: function(resp) {},
       error: function(resp) {
         sinConexion(resp);
       }
     }).done(function(resp) {
       hideFade();
       metodo(resp);
     });
 }

/*========================================================================*/

function status(response) {
  if (response.status >= 200 && response.status < 300) {
    return Promise.resolve(response)
  } else {
    return Promise.reject(new Error(response.statusText))
  }
}

function postX(url, data){
   // Return a new promise.
   return new Promise(function(resolve, reject) {

     if(self.fetch) {
       // ejecutar petición fetch
       var headersOptions = {
           'Content-Type': 'application/json'
       }
       var headers = new Headers(headersOptions);

       var params = {
                  method: 'POST',
                  mode: 'cors',
                  cache: 'default'
       };

       //params.headers = headers;

       data.append("token", getToken());
       data.append("typeView", getView());

       params.body = data;

       var request = new Request(getMainPath()+url, params);
       fetch(request)
       .then(status)
       .then(res => res.json())
       .then(data => {
         //console.log('Request succeeded with JSON response', data);
         // Resolve the promise with the response text
         resolve(data);

       }).catch(error => {
         //console.log('Request failed', error);
         reject(Error('Request failed', error));
       });
     }
     else {
         // ¿hacer algo con XMLHttpRequest?
     }
  });
}

function sinConexion(err){
  console.log(err)
  message("Detectamos que posees una conexion inestable de internet.")
}
