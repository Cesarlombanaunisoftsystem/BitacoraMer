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

function setIdcontractor(id) {localStorage.setItem("idcontractor", id)}
function getIdcontractor() {return localStorage.getItem("idcontractor")}

/*========================================================================*/
function contractorRouter(){

}
/*========================================================================*/
function contractorCount() {
  let data = new FormData()
  let url = 'backend/contractors/count'
  let div = "#contractor-count"
  count(url, data, div)
}
/*========================================================================*/
function contractors() {
 let data = new FormData()
 let url = 'backend/contractors/all'
 all(url, data).then(response => {
   console.log("Success!", response);
   Rcontractors(response)
 }, error => {
   console.error("Failed!", error);
 })
}

function Rcontractors(resp) {
  let btnview = ['check', 'primary', 'contractorGo']
  let btnBack = ['undo', 'warning', 'contractorHistoryBack']
  let btns = new Array()
  btns.push(btnview)
  btns.push(btnBack)
  table(resp, "contractors", btns, "folderImages", "folderCategory", 1)
}
/*========================================================================*/
function contractorHistoryBack(id){
 setIdStateOrder(4)
 historyBackOrder(id)
}
 /*========================================================================*/
function contractorGo(id){
  setIdcontractor(id)
  let data = new FormData()
  data.append('id', id)
  let url = 'backend/contractors/typeDocuments'
  all(url, data).then(response => {
    console.log("Success!", response);
    RcontractorGo(response)
  }, error => {
    console.error("Failed!", error);
  })
}
/*========================================================================*/
function RcontractorGo(resp){
  $('#type-documents').empty();
  resp.map(row => {
    let idTypeDocument = row.idTypeDocument
    let name = row.name;
    let template = '<div class="col-xs-12">'+
                  '<input type="hidden" id="idType'+idTypeDocument+'" name="idType'+idTypeDocument+'" value="'+idTypeDocument+'" />'+
                  '<div class="form-group">'+
                    '<label class="col-md-3 control-label color-blue" for="fileType'+idTypeDocument+'" style="text-decoration: underline;">'+name+'</label>'+
                    '<input type="file" id="fileType'+idTypeDocument+'" name="fileType'+idTypeDocument+'" style="display:none;" multiple />'+
                    '<div class="input-group col-md-9">'+
                      '<textarea class="form-control" name="observations'+idTypeDocument+'" rows="2" cols="80" required></textarea>'+
                    '</div>'+
                  '</div>'+
                '</div>'

    $('#type-documents').append(template);
  })
  $("#mdl_contractors").modal('show')
}
/*========================================================================*/
function updatecontractors(){
  const form = $('#form-contractors')
  console.log(form)
  console.log(typeof form)
  console.log(form[0])
  console.log(typeof form[0])
  let formData = new FormData(form)
  formData.append('id', getIdcontractor())
  let keys = Object.keys(form[0])
  items  = new Array();
  let idTypeDocument = 0
  keys.map(row => {
    let id = row
    console.log(form[0][id])
    let item = form[0][id]
    if(item.type == "hidden"){
      if(item.value != idTypeDocument){
        idTypeDocument = item.value
        console.log(idTypeDocument)
        items[idTypeDocument]['idTypeDocument'] = idTypeDocument
        //formData.append('idTypeDocument', idTypeDocument)
      }
   }
   else if(item.type == "file"){
      if(validateImage(item.value, 1)){
        console.log(item.files)
        for (i = 0; i <  item.files.length; i++) {
          //formData.append(item.name, item.files[i])
          items[idTypeDocument]['item.name'] = item.files[i]
        }
      }
    }
    else if(item.type == "textarea"){
      items[idTypeDocument]['item.name'] = item.value
      //formData.append(item.name, item.value)
    }
  })
  console.log(items)
  console.log(formData)
  let url = 'backend/contractors/update'
  all(url, formData).then(response => {
    console.log("Success!", response);

  }, error => {
    console.error("Failed!", error);
  })
}

/*========================================================================*/

// function updatecontractors(){
//   setIdStateOrder(5)
//   let msg = "¿Confirmas que deseas pasar la orden al area de validación de visitas?"
//   updateStateOrder(id,msg)
// }


 /*========================================================================*/
