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

function setIdexample(id) {localStorage.setItem("idexample", id)}
function getIdexample() {return localStorage.getItem("idexample")}

/*========================================================================*/
function exampleRouter(){
  // if(getNameURLWeb() == 'principal.php'){
  //   exampleCount()
  // }
  // if(getNameURLWeb() == 'examples.php'){
  //   examples()
  // }
  // if(getNameURLWeb() == 'example.php'){
  //   exampleSelect().then(response => {
  //     console.log("Success!", response);
  //     example()
  //   }, error => {
  //     console.error("Failed!", error);
  //   })
  // }
}
/*========================================================================*/
function exampleCount() {
  let data = new FormData()
  let url = 'backend/examples/count'
  let div = "#example-count"
  count(url, data, div)
}
/*========================================================================*/
function examples() {
 let data = new FormData()
 let url = 'backend/examples/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rexamples(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function exampleFilter() {
  const form = document.getElementById('form-example-filter')
  let formData = new FormData(form)
  let url = 'backend/examples/filter'
  return all(url, data).then(response => {
    Rexamples(response)
  }, error => {})
}

function Rexamples(resp) {
  if(resp == null){
    message('No se encontraron resultados.')
  }
  else{
    let btnview = ['eye', 'primary', 'exampleGo']
    let btndelete = ['times', 'danger', 'exampleDelete']
    let btns = new Array()
    btns.push(btnview)
    btns.push(btndelete)
    table(resp, "examples", btns, "folderImages", "folderCategory")
  }
}
 /*========================================================================*/
function exampleDelete(id){
  let data = new FormData()
  data.append('id', id)
  let url = 'backend/examples/delete'
  let msg = "¿Confirmas que deseas eliminar el nameItem ?"
  deleteItem(url, data, msg).then(response => {
    console.log("Success!", response);
    examples()
  }, error => {
    console.error("Failed!", error);
  })
}
 /*========================================================================*/
function exampleGo(id){
  setIdexample(id)
  redirect('example.php')
}

function example() {
  if(getIdorder()>0){
    let data = new FormData()
    data.append('id', getIdexample())
    let url = 'backend/examples/item'
    let form = 'form-example'
    let folder = 'examples'
    let folderCategory = 'documents'
    item(url, data, form, folder)
  }
}
 /*========================================================================*/
function exampleUpdate() {
  var url    = 'backend/examples/update'
  let form   = 'form-example'
  let div    = 'picture-example'
  let id = getIdwinery()
  let folder = 'examples'
  update(url, form, id, div, folder).then(response => {
    console.log("Success!", response);
    message(response.Msg)
    setIdexample(response.id)
  }, error => {
    console.error("Failed!", error);
  })
}

 /*========================================================================*/
 function exampleSelect(){
   let url = 'backend/examples/genero'
   let data = new FormData()
   let div = '.examples'
   return selectOptions(url, data, div)
 }
