<?php 

/**
 * 
 * create a alert for any validation
 * @param $msg
 * @param $type
 */
function createAlert($msg, $type = "danger"){
  return "<p class=\"alert alert-{$type} d-flex justify-content-between\"> {$msg} <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" ></button></p>";
}




?>