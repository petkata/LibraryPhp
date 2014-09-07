<?php
mb_internal_encoding('UTF-8');
$connect=mysqli_connect('localhost', 'root', '', 'library');
       if(!$connect){
           echo 'Грешка в базата данни';
           exit();
       }
mysqli_query($connect,'SET NAMES utf8');


?>
