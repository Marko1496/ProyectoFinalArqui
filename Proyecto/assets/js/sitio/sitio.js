function menu(pagina, indice, total) {

  /*Eliminar la clase active*/
  for (var i = 0; i < total; i++) {
    $("#menu" + i).removeClass("active");
  }

  /*Marcar el li activo*/
  $("#menu" + indice).addClass("active");

  /*traer la pagina*/
  $.ajax({
    url: pagina,
    method: "GET",
    success: function(respuesta) {
      $("#content").html(respuesta);
    },
    error: function(respuesta) {

    }
  });

}
