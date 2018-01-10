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
function activitiesRouter() {

}
/*========================================================================*/
function activitiesSelect(id){
  let url = 'backend/activities/select'
  let data = new FormData()
  data.append('id', id)
  let div = '.activities'
  return selectOptions(url, data, div)
}
/*========================================================================*/
