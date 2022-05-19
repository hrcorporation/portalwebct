document.addEventListener("DOMContentLoaded", function () {
  let form_crear_event = document.querySelector("#form_crear_event");
  let form_show_event = document.querySelector("#form_mostrar_event");
  var calendarEl = document.getElementById("calendar"); // ID = calendar
  //crear calendario
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Configuracion
    themeSystem: "bootstrap", // Tema del Calendario
    locale: "es", // Lenguaje
    initialView: "timeGridWeek", // Vista Semanal
    timeZone: 'America/New_York',
    droppable: true,
    selectable: true,
    editable: true,
    // Botones de
    headerToolbar: {
      language: "es",
      left: "prev,next,today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay,",
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
    // datos eventos

    //clik dia

    //=======================================================================================================================
    // Crear Eventos
    select: function (event) {
      console.log("Crear Evento");
      form_crear_event.reset();
      $("#start").val(moment(event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      $("#end").val(moment(event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      $("#modal_crear_evento").modal("show");
    },

    //=======================================================================================================================
    // Accion Click Encima del Evento
    eventClick: function (info) {
      console.log("Click Evento");
      $.ajax({
        url: "get_data_event.php",
        type: "POST",
        data: {
          id: info.event.id,
        },
        success: function (data) {
          form_show_event.id_evento.value = info.event.id;
          form_show_event.titulo_event.value = data.title;
          form_show_event.start.value = data.start;
          form_show_event.end.value = data.end;
          $("#modal_show_evento").modal("show");
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
      form_editar.append("start",moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      form_editar.append("end",moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      editar_event(form_editar, calendar);
      
    },
    //=======================================================================================================================
    // Accion cambiar el tamaño el Evento
    eventResize: function(info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append("start",moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      form_editar.append("end",moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss"));

      console.log(form_editar);
      editar_event(form_editar, calendar);
    }
    
  });

  calendar.render();
  // Boton Actualizar Evento
  document.getElementById("btn_guardar").addEventListener("click", function () {
    const datos_form = new FormData(form_show_event);
    var form_editar = new FormData();
    form_editar.append("task", 2);
    form_editar.append("id", form_show_event.id_evento.value);
    form_editar.append("titulo", form_show_event.titulo_event.value);
    form_editar.append("start", form_show_event.start.value);
    form_editar.append("end", form_show_event.end.value);
    editar_event(form_editar, calendar);
    $("#modal_show_evento").modal("hide");
  });

  // Boton Actualizar Evento
  document.getElementById("btn_eliminar").addEventListener("click", function () {
    const datos_form = new FormData(form_show_event);
    var form_editar = new FormData();
    
    Swal.fire({
      title: 'Esta seguro que desea eliminar',
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: 'Si eliminar',
      denyButtonText: `No, Salir`,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        form_editar.append("task", 3); // eliminar
        form_editar.append("id", form_show_event.id_evento.value);
        editar_event(form_editar, calendar);
        $("#modal_show_evento").modal("hide");
      } else if (result.isDenied) {
        
      }
    })
  });
});

function editar_event(form_editar, calendar) {
  $.ajax({
    url: "php_editar_prog_semanal.php",
    type: "POST",
    data: form_editar,
    processData: false,
    contentType: false,
    dataType: "json",
    //processData: false,
    success: function (response) {
      calendar.refetchEvents();
      toastr.success("Programacion Actualizada Satisfactoriamente");
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
}

function guardar_event(form_crear, calendar) {
  $.ajax({
    url: "php_crear_prog_semanal.php",
    type: "POST",
    data: form_crear,
    processData: false,
    contentType: false,
    dataType: "json",
    //processData: false,
    success: function (response) {
      calendar.refetchEvents();
      toastr.success("Programacion Creada Satisfactoriamente");
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
}
