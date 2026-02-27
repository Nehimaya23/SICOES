$('#formLogin').submit(function(e){
  e.preventDefault();

  var usuario  = $.trim($("#usuario").val());
  var password = $.trim($("#password").val());

  if(usuario === "" || password === ""){
    Swal.fire({ icon:'warning', title:'Debe ingresar un usuario y/o password' });
    return;
  }

  $.ajax({
    url: "bd/login.php",
    type: "POST",
    dataType: "json",
    data: { usuario: usuario, password: password },
    success: function(data){
      if(!data){
        Swal.fire({ icon:'error', title:'Usuario y/o password incorrecta' });
        return;
      }

      Swal.fire({
        icon:'success',
        title:'¡Conexión exitosa!',
        confirmButtonColor:'#3085d6',
        confirmButtonText:'Ingresar'
      }).then((r)=>{
        if(r.isConfirmed){
          window.location.href = "Empresas/dashboard.php";
        }
      });
    },
    error: function(xhr){
      Swal.fire({
        icon:'error',
        title:'Error en login.php',
        text: (xhr.responseText || 'Sin respuesta').substring(0, 200)
      });
    }
  });
});