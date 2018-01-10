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

function setToken(id) {localStorage.setItem("tokenAdmin", id);}
function getToken() {return localStorage.getItem("tokenAdmin");}

function setidUser(id) {localStorage.setItem("setidUser", id);}
function getidUser() {return localStorage.getItem("setidUser");}
/*=======================================================================
function routerAuth(){
  if(getNameURLWeb() != 'index.php'){
    validateToken();
    profile();
  }
}
========================================================================
function validateToken() {
  if(getToken() == null){
    localStorage.clear();
    setTimeout(function(){redirect('index.php');}, 300)
  }
}
/*========================================================================*/
function logOut() {
  alertify.confirm("¿Confirma que deseas cerrar sesión?", function () {
    localStorage.clear();
    setTimeout(function(){redirect('index.php');}, 300)
  }, function() {}
  );
}
/*========================================================================*/
function requestAuth(resp) {
  if (resp.success) {
    if(resp.token){
       setToken(resp.token);
       redirect('principal.php');
    }else{message(resp.Msg);}
  } else {message(resp.Msg);}
}
/*========================================================================*/
function register() {
  var datos = $('#form-register').serialize();
  var url = 'backend/auth/register';
  post(url, requestAuth, datos);
}
/*========================================================================*/
function login() {
  /*var datos = $('#form-login').serialize();
  var url = 'backend/auth/login';
  post(url, requestAuth, datos);*/
    location.href = get_base_url() + 'Admin';
}

/*========================================================================*/
function lostAuth() {
  myApp.prompt('Introduzca su e-mail', 'Recuperar contraseña.', function(value) {
    if (value) {
      if (validateEmail(value)) {
        GetIt(value);
      } else {
        lostUser();
      }
    }
  }, function(value) {});
}

function GetIt(user) {
  var datos = '&email=' + user;
  var url = 'backend/auth/lost';
  post(url, requestGetIt, datos);
}

function requestGetIt(resp) {
  message(resp.Msg);
}
/*========================================================================*/
function profile() {
    var data = '';
    var url = 'backend/auth/profile';
    post(url, requestProfile, data);
}

function requestProfile(resp) {
    var directory = getMainPath() + 'backend/files/images/users/' + resp[0].picture;
    $('.get-user-image').attr('src', directory);
    $('.get-user-name').html(resp[0].name);
    if(getNameURLWeb() == 'profile.php'){
      $('.get-user').val(resp[0].name);
      $('.get-email').val(resp[0].email);
      $('.get-mobile').val(resp[0].mobile);
    }
    setidUser(resp[0].id)
}
/*========================================================================*/
function updateProfile() {
  var datos = $('#form-profile').serialize();
  var url = 'backend/auth/update';
  post(url, requestUpdateProfile, datos);
}

function requestUpdateProfile(resp) {
  message("se ha actualizado correctamente.");
}
/*========================================================================*/
function updatePassword() {
  var pass2 = $("#pass2").val();
  var pass3 = $("#pass3").val();
  if (validatePassword(pass2, pass3)) {
    var datos = '&password=' + $('#password').val() + '&pass3=' + $('#pass3').val();
    var url = 'backend/auth/password';
    post(url, requestUpdatePassword, datos);
  }
}

function requestUpdatePassword(resp) {
  message(resp.Msg);
}
/*========================================================================*/
function updatePhoto() {
  if (validateImage($('#file-input').val())) {
    var inputFileImage = document.getElementById("file-input");
    var file = inputFileImage.files[0];
    var data = new FormData();
    data.append("file", file);
    var url = 'backend/auth/photo';
    postContent(url, RupdatePhoto, data);
  }
}

function RupdatePhoto(resp) {
  profile()
}
