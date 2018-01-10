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

function setIdrecordsvisit(id) {localStorage.setItem("idrecordsvisit", id)}
function getIdrecordsvisit() {return localStorage.getItem("idrecordsvisit")}

/*========================================================================*/
function recordsvisitRouter(){

}
/*========================================================================*/
function recordsvisitCount() {
  let data = new FormData()
  let url = 'backend/recordsvisits/count'
  let div = "#recordsvisit-count"
  count(url, data, div)
}
/*========================================================================*/
function recordsvisits() {
 let data = new FormData()
 let url = 'backend/recordsvisits/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rrecordsvisits(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function Rrecordsvisits(resp) {
  let btnview = ['check', 'primary', 'recordsvisitGo']
  let btnBack = ['undo', 'warning', 'recordsvisitHistoryBack']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "recordsvisits", btns, "folderImages", "folderCategory", 1)
}
/*========================================================================*/
function recordsvisitGo(id){
setIdStateOrder(6)
let msg = "¿Confirmas que deseas pasar la orden al area de registros procesados?"
updateStateOrder(id,msg)
}
/*========================================================================*/
function recordsvisitHistoryBack(id){
 setIdStateOrder(5)
 historyBackOrder(id)
}
/*========================================================================*/
function recordsprocess() {
 let data = new FormData()
 let url = 'backend/recordsvisits/process'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rrecordsprocess(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function Rrecordsprocess(resp) {
  let btnview = ['check', 'primary', 'recordsprocessGo']
  let btnBack = ['undo', 'warning', 'recordprocessHistoryBack']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "recordsprocess", btns, "folderImages", "folderCategory", 1)
}
/*========================================================================*/
function recordsprocessGo(id){
setIdStateOrder(7)
let msg = "¿Confirmas que deseas pasar la orden al area de registro de diseño?"
updateStateOrder(id,msg)
}
/*========================================================================*/
function recordprocessHistoryBack(id){
 setIdStateOrder(6)
 historyBackOrder(id)
}
