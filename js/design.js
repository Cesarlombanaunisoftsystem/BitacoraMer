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

function setIddesign(id) {localStorage.setItem("iddesign", id)}
function getIddesign() {return localStorage.getItem("iddesign")}

/*========================================================================*/
function designRouter(){

}
/*========================================================================*/
function designCount() {
  let data = new FormData()
  let url = 'backend/designs/count'
  let div = "#design-count"
  count(url, data, div)
}
/*========================================================================*/
function designs() {
 let data = new FormData()
 let url = 'backend/designs/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rdesigns(response)
 }, error => {
   console.error("Failed!", error);
 })
}
function Rdesigns(resp) {
  let btnview = ['check', 'primary', 'designGo']
  let btnBack = ['undo', 'warning', 'designHistoryBack']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "designs", btns, "folderImages", "folderCategory", 1)
}
 /*========================================================================*/
function designGo(id){
 setIdStateOrder(8)
 let msg = "¿Confirmas que deseas pasar la orden al area de auditoria de diseño?"
 updateStateOrder(id,msg)
}
 /*========================================================================*/
 function designHistoryBack(id){
  setIdStateOrder(7)
  historyBackOrder(id)
 }
 /*========================================================================*/
