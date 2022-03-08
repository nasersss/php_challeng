<?php

$doblicated_array=array("Ahmed","Ahmed","ALi","Ali","ali","Nasser","Hamed");
echo '<h1> Doublicaed Array</h1>';
print_r($doblicated_array) ;

$update=array_unique($doblicated_array);
echo '<h1> New Array</h1>'
print_r ($update);

?>