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

 function setIdStateOrder(id) {localStorage.setItem("setIdStateOrder", id)}
 function getIdStateOrder() {return localStorage.getItem("setIdStateOrder")}

/*========================================================================*/
function historyBackOrder(id){
  historyBackState(id, getIdStateOrder())
}
/*========================================================================*/
function historyBackState(id, idState){
 let data = new FormData()
 data.append('id', id)
 data.append('idState', idState)
 let url = 'backend/orderstate/historybackState'
 let msg = "¿Confirmas que deseas devolver la orden?"
 deleteItem(url, data, msg).then(response => {
   console.log("Success!", response);
   updateTables()
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function updateStateOrder(id, msg){
  updateStateOrder2(id, getIdStateOrder(), msg)
}
/*========================================================================*/
function updateStateOrder2(id, idState, msg){
 let data = new FormData()
 data.append('id', id)
 data.append('idState', idState)
 let url = 'backend/orderstate/updateStateOrder'
 //let msg = "¿Confirmas que deseas devolver la orden?"
 deleteItem(url, data, msg).then(response => {
   console.log("Success!", response);
   updateTables()
 }, error => {
   console.error("Failed!", error);
 })
}
function updateTables(){
  if(getIdStateOrder() == 2){
    schedules()
  }
  else if(getIdStateOrder() == 3){
    scheduleVisits()
  }
  else if(getIdStateOrder() == 4){
    scheduleVisits()
  }
  else if (getNameURLWeb() == 'contractors.php') {
    contractors()
  }
  else if(getIdStateOrder() == 5){
    recordsvisits()
  }
  else if(getIdStateOrder() == 6){
    recordsvisits()
  }
  else if(getIdStateOrder() == 7){
    designs()
  }
  else if(getIdStateOrder() == 8){
    audits()
  }

}
