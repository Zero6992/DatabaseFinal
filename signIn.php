<?php

// ******** update your personal settings ******** 
$servername = "localhost";
$username = "root";
$password = "wendy1102";
$dbname = "project";

// Connecting to and selecting a MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

if (!$conn->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $conn->error);
    exit();
}

/// Processing form data when form is submitted


$account =$_POST["account"];
$password=$_POST["password"];


if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: return.php");
    exit; 
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $sql = "SELECT * FROM user WHERE account ='".$account."'";

    $result=mysqli_query($conn,$sql);
    $check = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)==1 && $password== $check["password"]){
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        //這些是之後可以用到的變數
        $_SESSION["user_id"] = $check["user_id"];
        $_SESSION["user_type"] = $check["user_type"];

    
        header("location:return.html");
    }else{
            function_alert("帳號或密碼錯誤"); 
        }
}
    else{
        function_alert("Something wrong"); 
    }

    // Close connection
    mysqli_close($link);

function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');
     window.location.href='signIn.html';
    </script>"; 
    return false;
}
			
?>

