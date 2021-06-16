<?php
$search = ' ';
$log= ' ';
$currentPageClient = ' ';
$currentPageAdmin = ' ';

session_start();

session_unset();
session_destroy();

ob_start();?>

<h2 style="text-align: center; margin-bottom: 1.5rem;margin-top: 1.5rem;">Vous avez été déconnecté!</h2>


<?php 
$average = round($client->average());
$NPS = round($client->NPS());
$content = ob_get_clean(); 
require('template.php'); 
?>
