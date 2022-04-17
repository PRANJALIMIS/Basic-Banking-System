<?php
   $servername = "localhost";
   $username = "root";
   $password = '';
   $dbname = "sparksbank"; 

   $conn = mysqli_connect($servername, $username, $password, $dbname) or dir("unable to connect");
?>