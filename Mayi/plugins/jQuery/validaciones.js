function validar_texto(e){
  tecla=(document.all)?e.keyCode:e.which;
  if (tecla==8) return true;
  patron=/[A-Za-z\sáéíóúñ]/;
  tecla_final=String.fromCharCode(tecla);
  return patron.test(tecla_final);}
function validar_numero(e){
  tecla=(document.all)?e.keyCode:e.which;
  if (tecla==8) return true;
  patron=/\d/;
  tecla_final=String.fromCharCode(tecla);
  return patron.test(tecla_final);}
function validar_textonumero(e){
  tecla=(document.all)?e.keyCode:e.which;
  if (tecla==8) return true;
  patron=/[A-Za-z0-9\sáéíóú]/;
  tecla_final=String.fromCharCode(tecla);
  return patron.test(tecla_final);}
