$(document).on('click','tbody img.foto',function(){
  $('.foto').click(function(e){
    var img=e.target.src;
    var modal='<div class="modal modalimg" id="modal"><img src="'+img+'" class="modal_img"/><div class="modal_boton" id="modal_boton">X</div></div>';
    $('tbody').append(modal);
    $('#modal_boton').click(function(){
      $('#modal').remove();});});
  $(document).keyup(function(e){
    if(e.which==27){
      $('#modal').remove();}});});
