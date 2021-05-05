<?php
echo "<style>
            body {
              background-color: linen;
            }
        
            form{
                display: inline-block;
                margin-left:1%;
            }
        
            input{
                border: 2px solid;
                background-color: transparent;
            }
          
    </style>";

if (isset($_POST['apply'])) {
    $username       = $_POST['user'];
    $password       = $_POST['pass'];
    $applicationNum = $_POST['applicationNum'];
    
    $servername = "servername";
    $user       = "username";
    $pass       = "password";
    $dbname     = "dbname";
    
    $conn = mysqli_connect($servername, $user, $pass, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $cid   = $_POST['id'];
    $quota = $_POST['quota'];
    
    $sql = "INSERT INTO apply(cid,sid) VALUES ('$cid','$password')";
    
    if (mysqli_query($conn, $sql)) {
        $quota = $quota - 1;
        $sql   = "UPDATE company SET quota='$quota' WHERE cid='$cid'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Application is succesfully!";
            $applicationNum = $applicationNum + 1;
        }
    } else {
        echo "Error Inserting record: " . mysqli_error($conn);
    }
    
    echo "<form method='POST' action=apply.php>
                <input type=hidden name=user value=" . $username . " >
                <input type=hidden name=pass value=" . $password . " >
                <input type=hidden name=applied value=" . $applicationNum . " >
                <input type=submit value=Return name=return-to-apply >
                </form>";
    echo "<br>";
}
?>