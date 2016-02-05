$(document).ready(function(){
  $("#register").click(function(){
    $("#register").val('Registrado...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

  $("#login").click(function(){
    $("#login").val('Iniciando Sesión...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

  $("#update").click(function(){
    $("#update").val('Actulizando...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

});


