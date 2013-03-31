<?php
require_once('class.freebase.php');
$freebase = new freebase('YOUR FREEBASE API KEY');
$results = $freebase->search('dragon');
print_r($results);
?>
