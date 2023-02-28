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

