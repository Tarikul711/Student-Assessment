<?php
try{
    @mysql_connect("localhost","root","") or die("Connection Error");
    @mysql_select_db("student") or die("Database Not Found");
    //echo "Connection Successfully Complated";
}
catch(Exception $e){
    echo $e->getMessage();
}


?>