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

 function setIdtypeOrder(id) {localStorage.setItem("idtypeOrder", id)}
 function getIdtypeOrder() {return localStorage.getItem("idtypeOrder")}

function beforeorder(criterion){
  return new Promise(function(resolve, reject) {
    let data = new FormData()
    data.append('criterion', criterion)
    let url    = 'backend/orders/lastItem'
    postX(url, data).then(response => {
      //console.log("Success!", response)
      set(".get-"+criterion).value = response
      resolve(response)
    }, error => {
      reject(Error('Request failed', error))
    })
  })
}

function loadPreOrder(idType){
  setIdtypeOrder(idType)
  fechaActual()
  areasSelect()
  coordinatorsExt()
  coordinatorsInt()
  formPaysSelect()
  beforeorder('uniquecode')
  activitiesSelect(getIdtypeOrder())
  servicesSelect(getIdtypeOrder())
  return beforeorder('uniqueCodeCentralCost')
}

function validateLoadOrder(response){
  Ritem(response.item, 'form-order2-update', 'documents', 'orders')
  response.typeDocuments.map(row => {
    set("#idTypeDocument"+row.idTypeDocument).checked = true;
  })
  response.details.map(row => {
    //set("#idTypeDocument"+row.idTypeDocument).checked = true;
  })
}

/*========================================================================*/
function updateOrder2(){
  if(!ordersItems2.length>0){
    message("Ingrese almenos un servicio.")
  }
  else{
    const form = document.getElementById("form-order")
    set("#items").value = JSON.stringify(ordersItems2)
    const form2 = document.getElementById("form-order2")
    form.subtotal.value = form2.subtotal.value
    form.discount.value = form2.discount.value
    form.iva.value = form2.iva.value
    form.total.value = form2.total.value
    form.idArea.value = form2.idArea.value
    form.idTypeDocument1.value = form2.idTypeDocument1.value
    form.idTypeDocument2.value = form2.idTypeDocument2.value
    form.idTypeDocument3.value = form2.idTypeDocument3.value
    form.idTypeDocument4.value = form2.idTypeDocument4.value
    form.observations.value = form2.observations.value
    form.idOrderType.value = getIdtypeOrder()
    form.submit()
  }
}
/*========================================================================*/
function updateOrderB() {
  console.log("Success!");
  let url    = 'backend/orders/update'
  let form   = 'form-order'
  let div    = 'file-order'
  let id = getIdorder()
  let folder = 'orders'
  update(url, form, id, div, folder).then(response => {
    console.log("Success!", response);
    //setIdorder(response.id)
    message(response.Msg)
    alertify.alert(response.Msg, function(){
      reload()
    });

  }, error => {
    console.error("Failed!", error);
  })
}
/*========================================================================*/
function getServicePrice(idService){
   let data = new FormData()
   data.append('id', idService)
   let url = 'backend/services/price'
   postX(url, data).then(response => {
     console.log("Success!", response);
     set(".set-service-price").value = formatNumber.new(response)
   }, error => {
     console.error("Failed!", error);
   })
}
/*========================================================================*/
function priceForCount(count){
  let price = set(".set-service-price").value
  let subto = 0;
  price = removeNumber(price);
  let total = price * count

  set(".set-total").value = formatNumber.new(total)
}
/*========================================================================*/
var ordersItems = []
var ordersItems2 = []
var index = 0
var totalOrder = 0

var subtotalOrder = 0
var ivaOrder = 0
function orderAddItem(x) {
  let gtotal = 0
  let iva = 0
  console.log(x)
  const form = document.getElementById("form-addItem")
  let idActivities = form.idActivities.value
  let idServices = form.idServices.value
  let site = form.site.value
  let count = form.count.value
  let price = form.price.value
  let total = form.total.value

  var validserv = []
  let activity = form.idActivities.options[form.idActivities.options.selectedIndex].text
  let service = form.idServices.options[form.idServices.options.selectedIndex].text
  var resultObject = search(idServices, ordersItems2);


  for(var i = 0; i < ordersItems2.length; i++)
  {
    if(ordersItems2[i].service == idServices)
    {
      //return ordersItems2[i].service;
      validserv.push(ordersItems2[i].service);
      console.log(ordersItems2[i].service )
    }
  }

  a = validserv.indexOf(idServices);

  if(a < 0) {
    // element doesn't exist in array
    let inputCount = generateInput('text', 'count-'+index, count, "orderChangeCountItem", "orderChangeCountItem", "")
    let inputTotal = generateInput('text', 'total-'+index, total, "", "", "readonly")
    let inputPrice = generateInput('text', 'price-'+index, price, "", "", "readonly")
    let item = {activity:activity, service:service, site:site, count:inputCount, price:inputPrice, total:inputTotal, id:index};
    ordersItems[x] = item
    price = removeNumber(price)
    total = removeNumber(total)
    let item2 = {activity:idActivities, service:idServices, site:site, count:count, price:price, total:total};
    ordersItems2[x] = item2
    console.log(ordersItems)
    index++
    document.getElementById("form-addItem").reset();
    //form.setAttribute("action", "javascript:orderAddItem("+index+")")
    orderViewItems()
    //updateTotal(total, 0, total)
    for(i=0;i<=index;i++){
     gtotal = gtotal +  parseInt(removeNumber(document.getElementById("total-"+i).value))
     console.log(gtotal)
     $('input[name="subtotal"]').val(formatNumber.new(gtotal))

     //iva
     iva = iva + ( parseInt(removeNumber(document.getElementById("total-"+i).value)) * ( 19 / 100 ) )
     set(".iva").value = formatNumber.new(iva)
     $('input[name="total"]').val(formatNumber.new( gtotal + iva))

    }

  }
  else{
    message("El producto ya se encuentra ingresado.")
  }
}

function updateFormItem(){
  let gtotal = 0
  let iva = 0
  for(i=0;i<=index;i++){
    gtotal = gtotal +  parseInt(removeNumber(document.getElementById("total-"+i).value))
    console.log(gtotal)
    $('input[name="subtotal"]').val(formatNumber.new(gtotal))

    //iva
    iva = iva + ( parseInt(removeNumber(document.getElementById("total-"+i).value)) * ( 19 / 100 ) )
    set(".iva").value = formatNumber.new(iva)
    $('input[name="total"]').val(formatNumber.new( gtotal + iva))

   }
}

function updateTotal(subtotal, iva, total){

  totalOrder    = total+totalOrder
  subtotalOrder = total+subtotalOrder
  ivaOrder      = iva
  updateFormItem(subtotal, iva, total)
}

function discountOrder(val){
  if(val > 0){
  let subt = removeNumber($('input[name="subtotal"]').val())
  let iva = removeNumber(set(".iva").value);
  console.log(subt + " " + iva)
  let desc = subt - ( subt * ( val / 100) )
  $('input[name="subtotal"]').val(formatNumber.new(desc))

  iva =  desc * ( 19 / 100 )
     set(".iva").value = formatNumber.new(iva)
     $('input[name="total"]').val(formatNumber.new( desc + iva))

  }else{
    updateFormItem()
  }
  //updateFormItem(subtotalOrder, ivaOrder, totalOrders)
}

/* ======================================================================== */
function orderChangeCountItem(input){
  let str = input.id
  var id = str.substring(str.length,6)
  let count = input.value
  let price = document.querySelector("#price-"+id).value
  price = removeNumber(price);
  let total = count*price
  document.querySelector("#total-"+id).value = formatNumber.new(total)
  let inputCount = generateInput('text', 'count-'+index, count, "orderChangeCountItem", "orderChangeCountItem", "")
  let inputTotal = generateInput('text', 'total-'+index, total, "", "", "readonly")
  ordersItems[id].count = inputCount
  ordersItems[id].total = inputTotal
  ordersItems2[id].count = count
  ordersItems2[id].total = total
  //orderViewItems()
  //orderUpdate(true).then(response => {order()}, error => {})
}
/* ======================================================================== */
function orderDeleteItem(index){
  alertify.confirm("¿Confirmas que deseas remover el servicio?"+index, function () {
    console.log(ordersItems)
    posi = ordersItems.indexOf(index);
    posi2 = ordersItems2.indexOf(index);
    ordersItems.splice(posi, 1);
    ordersItems2.splice(posi2, 1);
    orderViewItems()
  }, function() {}
  )
}
/* ======================================================================== */
function orderUpdateItemCount(coun){
  const form = document.getElementById("form-addItem")
  let price = form.price.value
  let count = form.count.value
  price = removeNumber(price);
  let total = parseInt(price*count)
  form.total.value = total
}

function orderViewItems(){
  //orderUpdate(true).then(response => {order()}, error => {})
  let btnDelete = ['times', 'danger', 'orderDeleteItem']
  let btns = new Array()
  btns.push(btnDelete)
  console.log(ordersItems)
  table(ordersItems, "orders-items", btns, 1)

}
