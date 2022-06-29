document.addEventListener("DOMContentLoaded", function () {
  let form_crear_programacion = document.querySelector("#form_crear_programacion");
  let form_show_event = document.querySelector("#form_mostrar_programacion");
  var calendarEl = document.getElementById("calendar"); // ID = calendar
  //crear calendario
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Configuracion
    themeSystem: "bootstrap", // Tema del Calendario
    locale: "es", // Lenguaje
    initialView: "timeGridDay", // Vista Diaria
    timeZone: "America/New_York",
    droppable: true,
    selectable: true,
    editable: true,
    // Botones de
    headerToolbar: {
      language: "es",
      left: "prev,next,today",
      center: "title",
      // right: "dayGridMonth,timeGridWeek,timeGridDay",
      right: "timeGridDay",
    },
    // Cargar Datos, los eventos del Calendario
    events: {
      url: "data_calendar.php",
      method: "POST",
      extraParams: {
        custom_param1: "something",
      },
      failure: function () {
        alert("Error al Cargar las programaciones");
      },
      //color: 'yellow',   // a non-ajax option
      //textColor: 'black' // a non-ajax option
    },
    // datos Programacion
    //clik dia
    //=======================================================================================================================
    // Crear Programacion
    select: function (event) {
      console.log("Crear Programacion");
      form_crear_programacion.reset();
      $("#txtInicio").val(moment(event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      $("#txtFin").val(moment(event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      //Ajax
      var formData = new FormData();
      formData.append("task", 1);
      $.ajax({
        url: "load_data.php", // URL
        type: "POST", // Metodo HTTP
        //data: formData,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $("#cbxCliente").html(data.select_cliente);
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
      //==================================================================
      $("#modal_crear_evento").modal("show");
    },
    //=======================================================================================================================
    // Accion Click Encima de la Programacion
    eventClick: function (info) {
      console.log("Click Evento");
      $.ajax({
        url: "get_data_edit.php",
        type: "POST",
        data: {
          id: info.event.id,
        },
        success: function (data) {
          form_show_event.id_prog_evento.value = info.event.id;
          console.log(info.event);
          form_show_event.txtClienteEditar.value = data.select_cliente;
          form_show_event.txtObraEditar.value = data.select_obra;
          // $("#cbxClienteEditar").html(data.select_cliente);
          // $("#cbxObraEditar").html(data.select_obra);
          $("#cbxProductoEditar").html(data.select_producto);
          $("#cbxPedidoEditar").html(data.select_pedidos);
          $("#cbxTipoDescargueEditar").html(data.select_tipo_descargue);
          $("#cbxLineaDespachoEditar").html(data.select_linea_produccion);
          $("#cbxMixerEditar").html(data.select_mixer);
          $("#cbxConductorEditar").html(data.select_conductor);
          $("#cbxTipoBombaEditar").html(data.select_tipo_bomba);
          form_show_event.txtHoraCargueEditar.value = data.hora_cargue;
          form_show_event.txtHoraMixerEditar.value = data.hora_mixer_obra;
          form_show_event.txtCantEditar.value = data.cantidad;
          form_show_event.txtInicioEditar.value = data.inicio;
          form_show_event.txtFinEditar.value = data.fin;
          form_show_event.txtObservacionesEditar.value = data.observaciones;
          $("#bomba").html(data.check_bomba);
          $("#modal_show_evento").modal("show");
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
    },
    //=======================================================================================================================
    // Accion Mover la Programacion
    eventDrop: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txtInicio",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txtFin",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );
      editar_event(form_editar, calendar);
    },
    //=======================================================================================================================
    // Accion cambiar el tamaño la Programacion
    eventResize: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txtInicio",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txtFin",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );

      console.log(form_editar);
      editar_event(form_editar, calendar);
    },
  });
  calendar.render();
  // Boton Actualizar Programacion
  // Boton Actualizar Programacion
  document.getElementById("btnEliminar").addEventListener("click", function () {
    const datos_form = new FormData(form_show_event);
    var form_editar = new FormData();
    Swal.fire({
      title: "Esta seguro que desea eliminar",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Si eliminar",
      denyButtonText: `No, Salir`,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        form_editar.append("task", 3); // eliminar
        form_editar.append("id", form_show_event.id_prog_evento.value);
        editar_event(form_editar, calendar);
        $("#modal_show_evento").modal("hide");
      } else if (result.isDenied) {
      }
    });
  });
});

function editar_event(form_editar, calendar) {
  $.ajax({
    url: "php_editar_prog_diaria.php",
    type: "POST",
    data: form_editar,
    processData: false,
    contentType: false,
    dataType: "json",
    //processData: false,
    success: function (response) {
      calendar.refetchEvents();
      if (response.task == 1) {
        toastr.success("Programacion Actualizada Satisfactoriamente");
      } else if (response.task == 3) {
        toastr.success("Programacion eliminada Satisfactoriamente");
      } else if (response.task == 2) {
        toastr.success("Programacion Actualizada Satisfactoriamente");
      }
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
}
