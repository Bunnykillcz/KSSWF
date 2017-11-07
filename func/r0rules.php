<?php
function clean($string) 
{
   $string = str_replace(' ', '-', $string); 

   return preg_replace('/[^A-Za-z0-9\-]/', '', $string); 
}
function cleanx($string) 
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^A-Za-z0-9\#\ß\_]/', '', $string); 
}
function cleannum($string) 
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^0-9\.]/', '', $string); 
}
function cleandotcom($string)
{
   $string = str_replace(' ', '', $string); 

   return preg_replace('/[^A-Za-z0-9\,\#\ß\_\.\;]/', '', $string); 
}




?>