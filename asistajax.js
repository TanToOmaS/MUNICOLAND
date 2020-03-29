function sumarAsis($ID) {
    const xhttp = new XMLHttpRequest();
    

    xhttp.onreadystatechange = function()
    
    {
        if (this.readyState == 4 && this.status == 200)  {
            
                alert("Te esperamos");
        }else{
            alert("Ha habido un error");

            }
   }
        
   
    
    xhttp.open('POST', 'asistencia.php', true);		
    xhttp.send();
 }