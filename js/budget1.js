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

function setIdbudget1(id) {localStorage.setItem("idbudget1", id)}
function getIdbudget1() {return localStorage.getItem("idbudget1")}

/*========================================================================*/
function budget1Router(){
  // if(getNameURLWeb() == 'principal.php'){
  //   budget1Count()
  // }
  // if(getNameURLWeb() == 'budget1.php'){
  //   budget1()
  // }
  // if(getNameURLWeb() == 'budget1.php'){
  //   budget1elect().then(response => {
  //     console.log("Success!", response);
  //     budget1()
  //   }, error => {
  //     console.error("Failed!", error);
  //   })
  // }
}
/*========================================================================*/
function budget1Count() {
  let data = new FormData()
  let url = 'backend/budget1/count'
  let div = "#budget1-count"
  count(url, data, div)
}
/*========================================================================*/
function budget1() {
 let data = new FormData()
 let url = 'backend/budget1/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rbudget1(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function budget1Filter() {
  const form = document.getElementById('form-budget1-filter')
  let formData = new FormData(form)
  let url = 'backend/budget1/filter'
  return all(url, data).then(response => {
    Rbudget1(response)
  }, error => {})
}

function Rbudget1(resp) {
  if(resp == null){
    message('No se encontraron resultados.')
  }
  else{
    let btnview = ['eye', 'primary', 'budget1Go']
    let btndelete = ['times', 'danger', 'budget1Delete']
    let btns = new Array()
    btns.push(btnview)
    btns.push(btndelete)
    table(resp, "budget1", btns, "folderImages", "folderCategory")
  }
}
 /*========================================================================*/
function budget1Delete(id){
  let data = new FormData()
  data.append('id', id)
  let url = 'backend/budget1/delete'
  let msg = "¿Confirmas que deseas eliminar el nameItem ?"
  deleteItem(url, data, msg).then(response => {
    console.log("Success!", response);
    budget1()
  }, error => {
    console.error("Failed!", error);
  })
}
 /*========================================================================*/
function budget1Go(id){
  setIdbudget1(id)
  redirect('budget1.php')
}

function budget1() {
  if(getIdorder()>0){
    let data = new FormData()
    data.append('id', getIdbudget1())
    let url = 'backend/budget1/item'
    let form = 'form-budget1'
    let folder = 'budget1'
    let folderCategory = 'documents'
    item(url, data, form, folder)
  }
}
 /*========================================================================*/
function budget1Update() {
  var url    = 'backend/budget1/update'
  let form   = 'form-budget1'
  let div    = 'picture-budget1'
  let id = getIdwinery()
  let folder = 'budget1'
  update(url, form, id, div, folder).then(response => {
    console.log("Success!", response);
    message(response.Msg)
    setIdbudget1(response.id)
  }, error => {
    console.error("Failed!", error);
  })
}

 /*========================================================================*/
 function budget1elect(){
   let url = 'backend/budget1/genero'
   let data = new FormData()
   let div = '.budget1'
   return selectOptions(url, data, div)
 }
