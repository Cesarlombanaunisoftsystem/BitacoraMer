/**
 * bitacoras 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Julio cesar cortes
 * Email: Juliocesar.cortes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */

function setIdorder(id) {localStorage.setItem("idorder", id)}
function getIdorder() {return localStorage.getItem("idorder")}
/*========================================================================*/
function orderRouter(){

}
/*========================================================================*/
function orderCount() {
  let data = new FormData()
  let url = 'backend/orders/count'
  let div = "#order-count"
  count(url, data, div)
}


/*========================================================================*/
function orders() {
  let data = new FormData()
  let url = 'backend/orders/all'
  all(url, data).then(response => {
    console.log("Success!", response);
    Rorders(response)
  }, error => {
    console.error("Failed!", error);
  })
 }
/*========================================================================*/
function orderFilter() {
  const form = document.getElementById('form-order-filter')
  let formData = new FormData(form)
  let url = 'backend/orders/filter'
  return all(url, data).then(response => {
    Rorders(response)
  }, error => {})
}

function Rorders(resp) {
  let btnview = ['eye', 'primary', 'orderGo']
  let btndelete = ['times', 'danger', 'orderDelete']
  let btns = new Array()
  btns.push(btnview)
  //btns.push(btndelete)
  table(resp, "orders", btns, "orders", "documents", 1)
}
 /*========================================================================*/
function orderDelete(id){
  let data = new FormData()
  data.append('id', id)
  let url = 'backend/orders/delete'
  let msg = "¿Confirmas que deseas eliminar la orden?"
  deleteItem(url, data, msg).then(response => {
    console.log("Success!", response);
    orders()
  }, error => {
    console.error("Failed!", error);
  })
}
 /*========================================================================*/
function orderGo(id){
  setIdorder(id)
  $("#mdl_order").modal('show')
  loadPreOrder(getIdtypeOrder()).then(response => {
     console.log("Success!", response);
     order()
   }, error => {
     console.error("Failed!", error);
   })
}

function order() {
  if(getIdorder()>0){
    let data = new FormData()
    data.append('id', getIdorder())
    let url = 'backend/orders/item'
    let form = 'form-order-update'
    let folder = 'orders'
    let folderCategory = 'documents'
    item(url, data, form, folder, folderCategory).then(response => {
     console.log("Success!", response.details)
     var data = response.details;
     for(var item in data){
     console.log(data[item].site)
     $('#orders-items-table > tbody:last-child').append('<tr><td>'+data[item].idActivities+'</td><td>'+data[item].idServices+'</td><td>sss'+data[item].site+'</td><td>'+data[item].count+'</td><td>'+data[item].price+'</td><td>'+data[item].total+'</td><td>qqq'+$("#apellido").val()+'</td></tr>');
     //validateLoadOrder(response)
    }
    }, error => {
      reject(Error('Request failed', error))
    })
  }
}
 /*========================================================================*/
function orderUpdate() {
  var url    = 'backend/orders/update'
  let form   = 'form-order'
  let div    = 'picture-order'
  let id = getIdorder()
  let folder = 'orders'
  update(url, form, id, div, folder).then(response => {
    console.log("Success!", response);
    message(response.Msg)
    setIdorder(response.id)
  }, error => {
    console.error("Failed!", error);
  })
}

 /*========================================================================*/
 function orderSelect(){
   let url = 'backend/orders/genero'
   let data = new FormData()
   let div = '.orders'
   return selectOptions(url, data, div)
 }
