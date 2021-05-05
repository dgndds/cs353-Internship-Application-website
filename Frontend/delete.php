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
      
if (isset($_POST['delete'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];
    
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
    
    $sql = "DELETE FROM apply WHERE cid='$cid' and sid='$password'";
    
    if (mysqli_query($conn, $sql)) {
        $quota = $quota + 1;
        $sql   = "UPDATE company SET quota='$quota' WHERE cid='$cid'";
        
        if (mysqli_query($conn, $sql)) {
            echo "Application canceled succesfully!";
        }
        
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
    
    echo "<form method='POST' action=student.php>
                <input type=hidden name=user value=" . $username . " >
                <input type=hidden name=pass value=" . $password . " >
                <input type=submit value=Return name=return >
                </form>";
    echo "<br>";
}
?>