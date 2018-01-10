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

function setIdbudget2(id) {localStorage.setItem("idbudget2", id)}
function getIdbudget2() {return localStorage.getItem("idbudget2")}

/*========================================================================*/
function budget2Router(){
  // if(getNameURLWeb() == 'principal.php'){
  //   budget2Count()
  // }
  // if(getNameURLWeb() == 'budget2.php'){
  //   budget2()
  // }
  // if(getNameURLWeb() == 'budget2.php'){
  //   budget2elect().then(response => {
  //     console.log("Success!", response);
  //     budget2()
  //   }, error => {
  //     console.error("Failed!", error);
  //   })
  // }
}
/*========================================================================*/
function budget2Count() {
  let data = new FormData()
  let url = 'backend/budget2/count'
  let div = "#budget2-count"
  count(url, data, div)
}
/*========================================================================*/
function budget2() {
 let data = new FormData()
 let url = 'backend/budget2/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rbudget2(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function budget2Filter() {
  const form = document.getElementById('form-budget2-filter')
  let formData = new FormData(form)
  let url = 'backend/budget2/filter'
  return all(url, data).then(response => {
    Rbudget2(response)
  }, error => {})
}

function Rbudget2(resp) {
  if(resp == null){
    message('No se encontraron resultados.')
  }
  else{
    let btnview = ['eye', 'primary', 'budget2Go']
    let btndelete = ['times', 'danger', 'budget2Delete']
    let btns = new Array()
    btns.push(btnview)
    btns.push(btndelete)
    table(resp, "budget2", btns, "folderImages", "folderCategory")
  }
}
 /*========================================================================*/
function budget2Delete(id){
  let data = new FormData()
  data.append('id', id)
  let url = 'backend/budget2/delete'
  let msg = "¿Confirmas que deseas eliminar el nameItem ?"
  deleteItem(url, data, msg).then(response => {
    console.log("Success!", response);
    budget2()
  }, error => {
    console.error("Failed!", error);
  })
}
 /*========================================================================*/
function budget2Go(id){
  setIdbudget2(id)
  redirect('budget2.php')
}

function budget2() {
  if(getIdorder()>0){
    let data = new FormData()
    data.append('id', getIdbudget2())
    let url = 'backend/budget2/item'
    let form = 'form-budget2'
    let folder = 'budget2'
    let folderCategory = 'documents'
    item(url, data, form, folder)
  }
}
 /*========================================================================*/
function budget2Update() {
  var url    = 'backend/budget2/update'
  let form   = 'form-budget2'
  let div    = 'picture-budget2'
  let id = getIdwinery()
  let folder = 'budget2'
  update(url, form, id, div, folder).then(response => {
    console.log("Success!", response);
    message(response.Msg)
    setIdbudget2(response.id)
  }, error => {
    console.error("Failed!", error);
  })
}

 /*========================================================================*/
 function budget2elect(){
   let url = 'backend/budget2/genero'
   let data = new FormData()
   let div = '.budget2'
   return selectOptions(url, data, div)
 }
