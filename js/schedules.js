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

function setIdshedule(id) {localStorage.setItem("idshedule", id)}
function getIdshedule() {return localStorage.getItem("idshedule")}

/*========================================================================*/
function sheduleRouter(){

}
/*========================================================================*/
function sheduleCount() {
  let data = new FormData()
  let url = 'backend/schedules/count'
  let div = "#shedule-count"
  count(url, data, div)
}
/*========================================================================*/
function schedules() {
 let data = new FormData()
 let url = 'backend/schedules/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   RschedulesEdit(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function RschedulesEdit(resp) {
  $("#schedules-table").dataTable().fnDestroy()
  $('#schedules-data').empty()
  if(resp == null){
    message('No se encontraron resultados.')
  }
  else{
  		resp.map(row => {
  			let id                    = row.id
  			let date                  = row.date
  			let uniqueCode            = row.uniqueCode
  			let uniqueCodeCentralCost = row.uniqueCodeCentralCost
  			let activity              = row.activity
  			let service               = row.service
  			let technical             = row.technical
  			let observations          = row.observations
  			let appointment           = row.appointment
        let historybackState      = row.historybackState
        let color = ""
        if(historybackState>0){
          color = "text-warning"
        }
        let templateTechnical = '<div class="input-group">'+
                                  '<select class="form-control bg-white technicals" id="technical-'+id+'" style="width: 100%;" name="technical" required></select>'+
                                '</div>'
        let templateAppointment = '<div class="input-group">'+
                                  '<input type="date" class="form-control bg-white" id="date-'+id+'" name="date" required />'+
                                '</div>'

        let template = '<tr class='+color+'>'+
                  				'<td>'+date+'</td>'+
                  				'<td>'+uniqueCode+'</td>'+
                  				'<td>'+activity+'</td>'+
                  				'<td>'+service+'</td>'+
                          '<td>'+templateTechnical+'</td>'+
                  				'<td>'+observations+'</td>'+
                  				'<td>'+templateAppointment+'</td>'+
                  				'<td>'+
                  					'<div class="btn-group">'+
                              '<button type="button" onclick="sheduleGo('+id+')" class="btn-transparent"><i class="fa fa-check" aria-hidden="true"></i></button>'+
                              '<button type="button" onclick="gohistoryBackOrder('+id+')" class="btn-transparent"><i class="fa fa-undo text-warning" aria-hidden="true"></i></button>'+
                  					'</div>'+
                  				'</td>'+
                				'</tr>'
  			$('#schedules-data').append(template);
  		});
      technicalsSelect()
  		dataTable('#schedules-table');
  }
}
/*========================================================================*/
function gohistoryBackOrder(id){
 setIdStateOrder(2)
 historyBackOrder(id)
}

/*========================================================================*/
function sheduleGo(id){
 setIdshedule(id)
 let technical = set("#technical-"+id).value
 let date = set("#date-"+id).value
 if(technical == ""){
   message("Seleccione un tecnico")
 }
 else if(date == ""){
   message("Seleccione una fecha")
 }
 else{
   let data = new FormData()
   data.append('idTechnical',technical)
   data.append('appointment',date)
   data.append('id',id)
   let url = 'backend/schedules/update'
   all(url, data).then(response => {
     console.log("Success!", response);
     message(response.Msg)
     schedules()
   }, error => {
     console.error("Failed!", error);
   })
 }
}
/*========================================================================*/
function scheduleVisits() {
 let data = new FormData()
 let url = 'backend/schedules/visits'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rschedules(response)
 }, error => {
   console.error("Failed!", error);
 })
}
/*========================================================================*/
function sheduleFilter() {
  const form = document.getElementById('form-filter-visits')
  let formData = new FormData(form)
  let url = 'backend/schedules/filter'
  return all(url, data).then(response => {
    Rschedules(response)
  }, error => {})
}
/*========================================================================*/
function Rschedules(resp) {
  let btnview = ['check', 'primary', 'GoSheduleVisitUpdate']
  let btnBack = ['undo', 'warning', 'gohistoryBackOrder2']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "scheduleVisits", btns, "", "", 1)
}
/*========================================================================*/
function GoSheduleVisitUpdate(id){
 sheduleVisitUpdate(id)
}
/*========================================================================*/
function sheduleVisitUpdate(id){
 setIdStateOrder(4)
 let msg = "¿Confirmas que deseas pasar la orden al area de visitas inicial?"
 updateStateOrder(id,msg)
}
/*========================================================================*/
function gohistoryBackOrder2(id){
 setIdStateOrder(3)
 historyBackOrder(id)
}
