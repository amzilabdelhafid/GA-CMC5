<?php
$conn = mysqli_connect('localhost', 'root', '', 'db_ga-cmc');
if (!isset($conn)){
    echo 'data base err';
}else{
    echo 'data base conn done!';
}
