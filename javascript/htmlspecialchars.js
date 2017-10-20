$(document).ready(function() {
   var $pre = $('pre code');
   $pre.html($pre.html().replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/'/g, '&#039;').replace(/</g, '&lt;').replace(/>/g, '&gt;'));   
});
