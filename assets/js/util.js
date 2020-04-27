function get(url, success, error){  
  $.ajax({
      type: "GET",
      url: url,
      success: success,
      error: error
  })
}

function post(url, data, success, error){
    $.ajax({
        type: "POST",
        url: url,
        data: data,
        success: success,
        error: error
    })
}

function deleteRequest(url, data, success, error){
  $.ajax({
      type: "DELETE",
      url: url,
      data: data,
      success: success,
      error: error
  })
}

function toast(tipo, mensaje){
    const Toast = Swal.mixin({
        toast: true,       
        position: 'center',
        timer: 2000,
        showConfirmButton: false,
        timerProgressBar: true
      });
      
      Toast.fire({
        icon: tipo,
        title: mensaje        
      })
}
