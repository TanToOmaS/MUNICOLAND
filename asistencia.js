


$(document).ready(function(){
    
    $('.form').submit (function(e){
          e.preventDefault();
          const form = $(this).serialize();
         $.ajax({
             type: "POST",
             url: "asistencia.php",
             data: form,
             success: function(r){
                 if(r==1){
                     alert("¡Te esperamos!");                        
                 }else{
                     alert("Ha habido un error");
                 }
             },
             error: function (){
                 alert("Ha fallado la petición");
             }
         })
 
         return false;
     })
 });