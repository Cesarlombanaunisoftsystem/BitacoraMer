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

function setTypeData(type){localStorage.setItem("setTypeData", type);}
function getTypeData() {return localStorage.getItem("setTypeData");}

function setItem(item){localStorage.setItem("item", item);}
function getItem(){return localStorage.getItem("item");}


function setid(enterprise){localStorage.setItem("enterprise", enterprise);}
function getid() {return localStorage.getItem("enterprise");}
 /*========================================================================*/
var page;
var url;
var data;
var div;
var methodList;
var methodItem;
var methodCount;
var requestText;

class dataTables {
  constructor(page, url, data, methodList, methodItem, methodCount) {
    this.page = page;
    this.url = url;
    this.data = data;
    this.methodList = methodList;
    this.methodItem = methodItem;
    this.methodCount = methodCount;
  }

  go(){
    if(getUser() != null){
      redireccionar(this.page);
    }
    else{validateUser('Es nesesario ingresar para continuar.');}
  }

  load(){
    if(getNameURLWeb() == this.page){
     this.all();
   }
   else{message('No es posible.');}
 }

 count(){
  var directory = this.url+'count';
  post(directory, methodCount, this.data);
}

all(){
  var directory = this.url+'all';
  post(directory, methodList, this.data);
}

item(id){
  var directory = this.url+'item';
  data = '&idItem='+id+this.data;
  post(directory, methodItem, data);
}

update(data){
  var directory = this.url+'update';
  requestText = "Se ha realizado correctamente";
  postContent(directory, requestMessage, data);
}

delete(id){
  alertify.confirm("¿Confirmas que deseas eliminar?", function () {
    var directory = url+'delete';
    data = '&idItem='+id+this.data;
    requestText = "Se ha eliminado correctamente";
    post(directory, requestMessage, data);
  }, function() {}
  );
}
}
 /*========================================================================*/
function requestMessage(resp){
  if(resp != null){
    setItem(resp);
    message(requestText, 'refresh');
  }
  else{message('Ups, ha ocurrido un error, intentalo nuevamente.');}
}
 /*========================================================================*/
function dataTable(table){
  $(table).DataTable({
      responsive: true,
      "language": {
        "url": "plugins/datatables/Spanish.json"
      },
      "bDestroy": true,
      dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]

    });
}
