<?php 

/**
 * 
 * create a alert for any validation
 * @param $msg
 * @param $typ
 */
function createAlert($msg, $type = "danger"){
  return "<p class=\"alert alert-{$type} d-flex justify-content-between\"> {$msg} <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" ></button></p>";
}


/**
 * 
 * get old values after submit a form
 */

function old($field_name){
   return $_POST[$field_name] ?? "";
}


/**
 * reset form
 */
function resetForm(){
  return $_POST = []; 
}

/**
 * 
 */
function checkRequired($field_name, $status = "check") {
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($status == "check") {
      if (empty($_POST[$field_name])  ) {
        return "<p class=\"text-danger\">required *</p>";
      } else {
          return "";
      }
    }
      
  }
}


?>