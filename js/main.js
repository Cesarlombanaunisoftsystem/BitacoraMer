/**
 * bitacora 1.0.0
 * software
 * Copyright 2017, Unisoft
 * https://www.unisoftsystem.com.co/
 * Auhor: Julio cesar cortes
 * Email: Juliocesar.cortes@unisoftsystem.com.co
 * Licensed Apache License
 * Released on: Octuber 25, 2017
 * Updated on: Octuber 25, 2017
 */

 $(window).on("load", function (e) {
   routerUtilities()
   routerAuth()
   activitiesRouter()
   areasRouter()
   coordinatorsRouter()
   formPaysRouter()
   servicesRouter()
   orderRouter()
   routerPages()
 })

 function routerPages(){
   if(getNameURLWeb() == 'principal.php'){
     principal()
   }
   else if (getNameURLWeb() == 'order-registration.php') {
     orderregistrationR()
   }
   else if (getNameURLWeb() == 'schedule-visits.php') {
     schedulevisitsR()
   }
   else if (getNameURLWeb() == 'contractors.php') {
     contractorsR()
   }
   else if (getNameURLWeb() == 'recordsvisits.php') {
     recordsvisitsR()
   }
   else if (getNameURLWeb() == 'design.php') {
     designR()
   }
   else if (getNameURLWeb() == 'audit.php') {
     auditR()
   }
   else if (getNameURLWeb() == 'budget1.php') {
     budget1R()
   }
   else if (getNameURLWeb() == 'budget2.php') {
     budget2R()
   }
 }
//principal.php
function principal(){
 orderCount()
}
//order-registration.php
function orderregistrationR(){
    loadPreOrder(1)
}
//schedule-visits.php
function schedulevisitsR(){
  servicesSelect()
  technicalsSelect()
  schedules()
}
//contractors.php
function contractorsR(){
  contractors()
}
//recordsvisits.php
function recordsvisitsR(){
  recordsvisits()
}
//recordsvisits.php
function designR(){
  designs()
}
//audit.php
function auditR(){
  audits()
}
//budget1.php
function budget1R(){
  budget1()
}
//budget2.php
function budget2R(){
  budget2()
}
