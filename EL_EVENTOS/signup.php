<?php
session_start();
if(!isset($_SESSION['name']))
{
    echo"you are logged out";
    header("location:index.html");
}
$name = $_POST['name'];
$phone = $_POST['phone'];
$emailid = $_POST['emailid'];
$password = $_POST['password'];
$confirm = $_POST['confirm'];

if($password==$confirm)
{
   
    $conn = new mysqli("localhost","root","","eventos");

    if($conn->connect_error)
    {   echo "$conn->connect_error";
        die("connection Failed:" .$conn->connect_error);
    }       
    else
    {   
        $stmt = $conn->prepare("insert into signup(name,phone,emailid,password,confirm)values(?,?,?,?,?)");
        $stmt->bind_param("sisss",$name,$phone,$emailid,$password,$confirm);
        $stmt->execute();
        
        echo " registration sucessfull...";
        header("location:index1.html");
        $stmt->close();
        $conn->close();
    }
}
else
{
    die("enter correct password");
}

?>