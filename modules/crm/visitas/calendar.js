document.addEventListener("DOMContentLoaded", function () {
  $(".select2").select2();
  let form_crear_visita = document.querySelector("#form_crear_vitita");

  var calendarEl = document.getElementById("calendar"); // ID = calendar
  //crear calendario
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Configuracion
    themeSystem: "bootstrap", // Tema del Calendario
    locale: "es", // Lenguaje
    initialView: "timeGridWeek", // Vista Semanal
    timeZone: "America/Bogota",
    droppable: true,
    selectable: true,
    editable: true,
    // Botones de
    headerToolbar: {
      language: "es",
      left: "prev,next,today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    /**
     * Cargar Datos, los eventos del Calendario
     **/
    events: {
      url: "data_calendar.php",
      method: "POST",
      extraParams: {
        custom_param1: "something",
      },
      failure: function () {
        alert("Error al Cargar las Visitas Comerciales");
      },
      //color: 'yellow',   // a non-ajax option
      //textColor: 'black' // a non-ajax option
    },

    /**
     * CREAR EVENTO
     */
    select: function (event) {
      // form_crear_programacion.reset();
      $("#txt_inicio").val(
        moment(event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      $("#txt_fin").val(moment(event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      //Ajax
      var formData = new FormData();
      formData.append("task", 1);
      // por si se desea cargar previamente datos en el modal de crear visita comercial
      $.ajax({
        url: "process_data.php", // URL
        type: "POST", // Metodo HTTP
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $("#txt_asesora_comercial").html(data.select_comercial);

          //toastr.success("Visita Creada correctamente");
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
      //====================================================================================================================
      $("#modal_crear_evento").modal("show");
    },
    //=======================================================================================================================
    // Accion Click Encima del Evento
    eventClick: function (info) {
      $.ajax({
        url: "get_data_edit.php",
        type: "POST",
        data: {
          id: info.event.id,
        },
        success: function (data) {
          //form_show_event.id_prog_evento.value = info.event.id;
          
          $("#modal_editar_evento").modal("show");
          $("#txt_id").val(data.id);
          $("#txt_id2").val(data.id);
          //$('#txt_titulo_edit').val(data.titulo);
          $("#objetivo_visita_edit").html(data.objetivo);
          $("#txt_cliente_edit").html(data.select_cliente);
          $("#txt_obra_edit").html(data.select_obra);
          $("#obs_visit_edit").val(data.observaciones);
          $("#asesora_comercial_edit").html(data.select_comercial);

          
          $("#txt_inicio_edit").val(data.inicio);
          $("#txt_fin_edit").val(data.fin);

          if ($.fn.dataTable.isDataTable("#tabla_anexos")) {
            table = $("#tabla_anexos").DataTable();
            table.destroy();
          }
          table = datatable_anexo(data.id);
          
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
    },

    //=======================================================================================================================
    // Accion Mover el Evento
    eventDrop: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txt_inicio_edit",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txt_fin_edit",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );
      editar_event(form_editar, calendar);
    },

    //=======================================================================================================================
    // Accion cambiar el tamaño el Evento
    eventResize: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txt_inicio_edit",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txt_fin_edit",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );
      console.log(form_editar);
      editar_event(form_editar, calendar);
    },
  });

  /** FIN CALENDARIO */

  calendar.render();
  $("#form_crear_vitita").on("submit", function (e) {
    console.log("guardado");
    e.preventDefault();
    $.ajax({
      url: "crear_visita_comercial.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        //console.log(data);
        if (data.estado) {
          calendar.render();
          toastr.success("Visita Creada correctamente");
        } else {
          console.log("mal");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  /** CREAR  */

  /** EDITAR  MODAL */
  $("#form_editar_vitita").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "php_editar_visita_comercial.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        //console.log(data);
        if (data.estado) {
          toastr.success("Visita Editada correctamente");
        } else {
          console.log("visita cliente guardo mal");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  /** EDITAR  MODAL */
  $("#form_subir_anexo").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "subir_anexo.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        //console.log(data);
        if (data.estado) {
          toastr.success("Anexo Cargado  correctamente");
          table.ajax.reload();
        } else {
          console.log("hubo un error");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  //////////////////////////////////////////////////////////////////////////////////////////////////////

  function editar_event(form_editar, calendar) {
    $.ajax({
      url: "php_editar_event.php",
      type: "POST",
      data: form_editar,
      processData: false,
      contentType: false,
      dataType: "json",
      //processData: false,
      success: function (response) {
        calendar.refetchEvents();
        if (response.estado) {
          toastr.success("Visita Actualizada Satisfactoriamente");
        }
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  }
});

$("#txt_cliente").on("change", function () {
  $.ajax({
    url: "get_data.php",
    type: "POST",
    data: {
      txt_cliente: $("#txt_cliente").val(),
      task: "1",
    },
    success: function (response) {
      $("#txt_obra").html(response.obras);
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
});

$("#txt_cliente_edit").on("change", function () {
  $.ajax({
    url: "get_data.php",
    type: "POST",
    data: {
      txt_cliente: $("#txt_cliente_edit").val(),
      task: "1",
    },
    success: function (response) {
      $("#txt_obra_edit").html(response.obras);
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
});

$(".tipoarchivo").change(function () {
  $("#imgfiles").attr("accept", $("input[name=subirtipo]:checked").val());
});

function datatable_anexo(id_visita) {
  var table = $("#tabla_anexos").DataTable({
    paging: false,
    searching: false,
    //"processing": true,
    //"scrollX": true,
    ajax: {
      url: "datatable_anexos.php",
      data: {
        id_visita: id_visita,
      },
      type: "post",
      dataSrc: "",
    },
    order: [[0, "desc"]],
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre_anexo",
      },
      {
        data: "archivo",
      },
      {
        "data": null,
        "defaultContent": "<button class='btn btn-danger btn-sm'> Eliminar </button>"
    }
    ],
    paging: false,
    searching: false,
    //"scrollX": true,
  });
  table
    .on("order.dt search.dt", function () {
      table
        .column(0, {
          search: "applied",
          order: "applied",
        })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw();
  table.ajax.reload();
  return table;
}


$('#tabla_anexos tbody').on('click', 'button', function() {
  var data = table.row($(this).parents('tr')).data();
  var id = data['id'];
  Swal.fire({
      title: '',
      text: "",
      icon: 'success',
      html: "Esta seguro de eliminar <br>",
      showCancelButton: true,
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar'
  }).then((result) => {
      if (result.value) {
          $.ajax({
              url: "eliminar_anexo.php",
              type: "POST",
              data: {
                  id: id,
              },
              success: function(response) {
                table.ajax.reload();
                  toastr.success('exitoso');
              },
              error: function(respuesta) {
                  alert(JSON.stringify(respuesta));
              },
          });

      } else {


      }
  })

});

