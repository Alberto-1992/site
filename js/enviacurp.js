var idcurp = $("#idcurp").val();
var fechanacimiento = $("#fecha").val();
$(function () {
  $(".mandaid").click(function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    $(".curp").html(id);
    $("#seguimiento").modal('show');

  })

})
$(function () {
  $(".mandaidbucal").click(function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    $(".curp").html(id);
    $("#seguimientobucal").modal('show');

  })

})

