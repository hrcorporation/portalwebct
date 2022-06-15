$(document).ready(function (e) {
  $("#btn-eliminar").click(function () {
    // var id = $("#id").val();
    Swal.fire({
      title: "Esta Seguro(a) de Eliminar este Usuario?",
      text: "",
      icon: "danger",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "No",
      confirmButtonText: "Si Eliminar",
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: "ajax_eliminar.php",
          type: "POST",
          data: {
            id: id,
          },
          success: function (response) {
            if (response.estado) {
              Swal.fire("El usuario fue eliminado correctamente", "success");
              window.location = "../index.php";
            } else {
              console.log("error");
            }
          },
          error: function (respuesta) {
            alert(JSON.stringify(respuesta));
          },
        });
      }
    });
  });
});
