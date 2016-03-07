$(document).ready(function(){
  $("#register").click(function(){
     $("#text").text('Registrando...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});
  $("#cobrar").click(function(){
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

  $("#login").click(function(){
    $("#text").text('Iniciando Sesion...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

  $("#update").click(function(){
     $("#text").text('Actualizando...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

  $("#save").click(function(){
     $("#text").text('Guardando...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});

    $("#acceso").click(function(){
     $("#text").text('Buscando Miembro...');
    $("#button").attr('class','fa fa-spinner fa-spin');
    return true;});
});



