$(document).ready(function(){
  $('.sidebar-nav li:has(ul)').click(function(e){
    e.preventDefault();
    if($(this).hasClass('activado')){
      $(this).removeClass('activado');
      $(this).children('ul').slideUp();}
    else{
      $('.sidebar-nav li ul').slideUp();
      $('.sidebar-nav li').removeClass('activado');
      $(this).addClass('activado');
      $(this).children('ul').slideDown();}});
$('.sidebar-nav li ul li a').click(function(){
  window.location.href=$(this).attr("href");});});

/*ACCIÓN DEL PANEL CATEGORIAS*/
$(document).ready(function(){
  $(document).on('click','.panel-heading span.click',function(e){
    var $this=$(this);
    if(!$this.hasClass('panel-collapsed')){
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.find('i').removeClass('fa fa-sort-asc').addClass('fa fa-sort-desc');}
    else{
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.find('i').removeClass('fa fa-sort-desc').addClass('fa fa-sort-asc');}});
$(document).on('click','.panel div.click',function(e){
    var $this=$(this);
    if(!$this.hasClass('panel-collapsed')){
      $this.parents('.panel').find('.panel-body').slideUp();
      $this.addClass('panel-collapsed');
      $this.find('i').removeClass('fa fa-sort-asc').addClass('fa fa-sort-desc');}
    else{
      $this.parents('.panel').find('.panel-body').slideDown();
      $this.removeClass('panel-collapsed');
      $this.find('i').removeClass('fa fa-sort-desc').addClass('fa fa-sort-asc');}});
$(document).ready(function(){
  $('.panel-heading span.click').click();
  $('.panel div.click').click();});});
