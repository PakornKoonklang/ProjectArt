

<?php 
    // Create connection
    $connect = new mysqli('localhost', 'root', '', 'projectart');

    // Check Connection

    if ($connect->connect_error) {
        die("Something wrong.: " . $connect->connect_error);
      }


?>