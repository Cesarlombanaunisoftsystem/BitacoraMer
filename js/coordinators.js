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

/* ======================================================================== */
function coordinatorsRouter() {

}
/*========================================================================*/
function coordinators(type, divs){
  let url = 'backend/coordinators/select'
  let data = new FormData()
  data.append('type', type)
  let div = divs
  return selectOptions(url, data, div)
}
function coordinatorsExt(){
  return coordinators(1, '.coordinators-ext')
}
function coordinatorsInt(){
  return coordinators(2, '.coordinators-int')
}
/*========================================================================*/
