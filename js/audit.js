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

function setIdaudit(id) {localStorage.setItem("idaudit", id)}
function getIdaudit() {return localStorage.getItem("idaudit")}

/*========================================================================*/
function auditRouter(){

}
/*========================================================================*/
function auditCount() {
  let data = new FormData()
  let url = 'backend/audits/count'
  let div = "#audit-count"
  count(url, data, div)
}
/*========================================================================*/
function audits() {
 let data = new FormData()
 let url = 'backend/audits/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Raudits(response)
 }, error => {
   console.error("Failed!", error);
 })
}
function Raudits(resp) {
  let btnview = ['check', 'primary', 'auditGo']
  let btnBack = ['undo', 'warning', 'auditHistoryBack']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "audits", btns, "folderImages", "folderCategory", 1)
}
 /*========================================================================*/
function auditGo(id){
 setIdStateOrder(9)
 let msg = "¿Confirmas que deseas pasar la orden al area de presupuesto PL?"
 updateStateOrder(id,msg)
}
 /*========================================================================*/
 function auditHistoryBack(id){
  setIdStateOrder(8)
  historyBackOrder(id)
 }
 /*========================================================================*/
