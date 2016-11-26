<?php
session_start();
if(isset($_SESSION['usuario'])){
  require 'vistas/menu.vista.php';}
else{
  header('Location:iniciosesion.php');}?>
