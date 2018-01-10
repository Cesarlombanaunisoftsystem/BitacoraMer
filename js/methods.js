/**
 * bitacora 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Julio cesar cortes
 * Email Juliocesar.cortes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */

 function count(url, data, div) {
   return new Promise(function(resolve, reject) {
     postX(url, data).then(response => {
      document.querySelector(div).innerHTML= response
      //console.log("Success!", response)
      resolve(response)
     }, error => {
       //console.error("Failed!", error)
       reject(Error('Request failed', error))
     })
   })
 }

 /*========================================================================*/
 function all(url, data) {
   return new Promise(function(resolve, reject) {
     postX(url, data).then(response => {
      //console.log("Success!", response)
      resolve(response)
     }, error => {
       //console.error("Failed!", error)
       reject(Error('Request failed', error))
     })
   })
 }

 function newBtn(icon, color, method){
   a = document.createElement("a")
   a.setAttribute("class", "btn btn-"+color)
   a.setAttribute("href", "javascript:"+method)
   i = document.createElement("i")
   i.setAttribute("class", "fa fa-"+icon)
   a.appendChild(i)
   return a
 }

 function generateAction(btns){
   td = document.createElement("td")
   div = document.createElement("div")
   div.setAttribute("class", "btn-group")
   btns.map(row => {
     let a = newBtn(row[0], row[1], row[2])
     div.appendChild(a)
   })
   td.appendChild(div)
   return td
 }

 function generateInput(type, id, value, onchange, onkeyup, readonly){
   let input = document.createElement("input")
   input.setAttribute("type", "number")
   input.setAttribute("class", "form-control")
   input.setAttribute("id", id)
   input.setAttribute("value", value)
   if(onchange != ""){
     input.setAttribute("onchange", onchange+"(this)")
   }
   if(onkeyup != ""){
    input.setAttribute("onkeyup", onkeyup+"(this)")
   }
   if(readonly != ""){
    input.setAttribute("readonly", true)
   }

   return input
 }

function methodsd(resetBtns2, id){

  return resetBtns2;
}
 function table(data, div, btns, folderImg, folderCategory, datableValidate) {

   return new Promise(function(resolve, reject) {
     if(datableValidate==1){
       $("#"+div+"-table").dataTable().fnDestroy()
       document.querySelector("#"+div+"-data").innerHTML= ""
     }

     if(data == null){
       message('No se encontraron resultados.')
     }
     else{

       data.map(row => {
         let template = document.createElement("tr")
        //  let span = document.createElement("span")
        //  template.appendChild(span)

         Object.keys(row).map(function(key, index) {
            if(key == "id"){
              let id = row[key]
              let i = 0
              btns.map(row => {
                var str = row[2]
                var indice = str.indexOf("(")
                if(indice === -1){
                  btns[i][2] = row[2]+"("+id+")"
                }
                else{
                  var res = str.substring(0, indice)
                  btns[i][2] = res+"("+id+")"
                }
                i++
              })
              let td = generateAction(btns)
              template.appendChild(td)
              //console.log(template);
            }
            else if(key == "picture"){
              let path  = getMainPath() + 'backend/files/'+folderCategory+'/'+folderImg+'/' + row[key]
              let td = document.createElement("td")
              let img = document.createElement("img")
              img.setAttribute("class", "datatable-img")
              img.setAttribute("src", path)
              td.appendChild(img)
              template.appendChild(td)
            }
            else{
                let td = document.createElement("td")
                let textnode;

                if(typeof row[key] == "object"){
                  textnode = row[key]
                }
                else{
                  textnode = document.createTextNode(row[key]);
                }
                td.appendChild(textnode)
                template.appendChild(td)
            }
         })
          $("#"+div+"-data").append(template)
        })
        if(datableValidate==1){
          dataTable("#"+div+"-table")
        }

     }
      resolve(data)
     }, error => {
       //console.error("Failed!", error)
       reject(Error('Request failed', error))
     })
 }
 /*========================================================================*/
 function deleteItem(url, data, msg) {
   return new Promise(function(resolve, reject) {
    alertify.confirm(msg, function () {
      postX(url, data).then(response => {
        //console.log("Success!", response)
        message(response.Msg)
        resolve(response)
       }, error => {
         //console.error("Failed!", error)
         reject(Error('Request failed', error))
       })
    }, function() {}
    )
   })
 }
 /*========================================================================*/
 // var formid
 // var folderImages
 // var folderCategory
 function item(url, data, form, folder, category) {
   return new Promise(function(resolve, reject) {
     postX(url, data).then(response => {
      //console.log("Success!", response)
      formid = form
      folderImages = folder
      folderCategory = category
      Ritem(response.item, formid, folderCategory, folderImages)
      resolve(response)
     }, error => {
       //console.error("Failed!", error)
       reject(Error('Request failed', error))
     })
   })
 }

 function Ritem(resp, formid, folderCategory, folderImages) {
   if(resp != null){
     var form = document.getElementById(formid)
     resp.map(row => {
       Object.keys(row).map(function(key, index) {
          if(key == "id"){

          }
          else if(key == "picture"){
            if(row[key] != null){
              let path  = getMainPath() + 'backend/files/'+folderCategory+'/'+folderImages+'/' + row[key]
              set('.get-picture').src = path
            }
          }
          else{
            if(row[key] && form[key]){
              form[key].value = row[key]
            }
          }
       })
     })
   }
 }
 /*========================================================================*/
 function update(url, formid, id, div, folder) {
   const form = document.getElementById(formid)
   let formData = new FormData(form)
   formData.append('id', id)
   if(div != ''){
     if(validateImage(set('#'+div).value, 0)){
       var inputFileImage = document.getElementById(div)
       var file = inputFileImage.files[0]
       formData.append("file", file)
     }
   }

   return new Promise(function(resolve, reject) {
     postX(url, formData).then(response => {
       //console.log("Success!", response)
       folderImages = folder
       Rupdate(response)
       resolve(response)
     }, error => {
       //console.error("Failed!", error)
       reject(Error('Request failed', error))
     })
   })
 }

 function Rupdate(resp){
  console.log(resp)
   if(resp.picture != 1 && folderImages != ''){
     let path = getMainPath() + 'backend/files/images/'+folderImages+'/' + resp.picture
     if(set('.get-picture') != null){
       set('.get-picture').src = path
     }
   }
 }
/*========================================================================*/
 var selectOptionsDiv
 function selectOptions(url, data, div) {
   return new Promise(function(resolve, reject) {
     postX(url, data).then(response => {
       //console.log("Success!", response)
       selectOptionsDiv = div
       RselectOptions(response)
       resolve(response)
     }, error => {
       reject(Error('Request failed', error))
     })
    })
  }

 function RselectOptions(resp) {
   $(selectOptionsDiv).empty()
   if(resp == null){
     //message('No se encontraron resultados.')
   }
   else{
     $(selectOptionsDiv).append('<option value="">Seleccione una opción</option>')
     resp.map(row => {
       let id          = row.id
       let name        = row.name
       let template    = '<option value="'+id+'">'+name+'</option>'
       $(selectOptionsDiv).append(template)
     })
     //console.log(selectOptionsDiv)
   }
 }

 /*========================================================================*/
function getAutoData(){
  let date = moment().format('YYYY-MM-DD')
  $('.today').attr('min', date)
  $('.today').val(date)
  let time = moment().format('h:mm a')
  $('.time').attr('min', time)
  $('.time').val(time)
  $('.brokers').val(getidUser())
}
