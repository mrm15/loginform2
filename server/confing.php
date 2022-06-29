<?php

    $link= mysqli_connect('localhost','root','');
    if (! $link) {
    echo 'could not connect :' . mysqli_connect_error();
    exit;
    }
    echo 'connect sucsessfuly';
    mysqli_select_db($link,'login1');
    

?>