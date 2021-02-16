<?php 
$arg_aux = $args;
include(dirname(__DIR__, 1).'/views/header.php');
$args = $arg_aux['devedor'] ;
include(dirname(__DIR__, 1).'/views/content.php');
$args = $arg_aux['dividas'] ;
include(dirname(__DIR__, 1).'/views/content.php');
include(dirname(__DIR__, 1).'/views/footer.php');
?>

