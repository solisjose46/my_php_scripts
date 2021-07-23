<?php

$failed="missing username and/or password arguments\n";

//minimum number of parameters to pass this script
$min=3; 

if(count($argv) < $min){
	die($fail);
}

//creds for mysql
//this is used in hello world lamp app not accessible to the internet, chill
//dont do this bad practice
$user="root";
$pass="";

// Create connection
$conn = new mysqli("localhost", $user, $pass);

// Check connection
if ($conn->connect_error) {
	die("Connection failed: ".$conn->connect_error."\n");
}
echo "Connected successfully...\n\n";

$new_user=$argv[1];
$new_pass=$argv[2];

$queries=array(
	"create user '$new_user'@'localhost' identified by '$new_pass'",
	"grant all privileges on *.* to '$new_user'@'localhost'",
	"flush privileges"
);

foreach($queries as $query) {
    echo "Executing query: ".htmlentities($query)." ... \n";
    $rs = $conn->query($query);
    if(!$rs){
	    die("\nFAILED and quitting...\n\n");
    }
    else{
	    echo "great succ\n\n";
    }
}

$conn->close();

?>
