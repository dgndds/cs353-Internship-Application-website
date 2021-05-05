<?php
echo "<style>
    body {
      background-color: linen;
    }
  
    h1 {
      color: maroon;
      /*margin-left: 40px;*/
      text-align:center;
    }

    form{
        display: inline-block;
        margin-left:1%;
    }

    input{
        border: 2px solid;
        background-color: transparent;
    }
    
    #go-to-apply{
        padding: 5% 75% 5% 75%;
    }
  
  </style>";

echo "<h1>YOUR APPLICATIONS</h1>";
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

$sql = "SELECT * FROM student WHERE sname ='$username' and sid = '$password'";
$result = mysqli_query($conn, $sql) or die("Failed query " . mysql_error());

$row = mysqli_fetch_array($result);

if ($row['sname'] == $username && $row['sid'] == $password) {
    
    echo "<div>";
    echo "<h2>Welcome " . $row['sname'] . "</h2>";
    
    echo "<form method='POST' action=index.php>
                <input type=submit value=Logout name=logout >
            </form>";
    echo "</div>";
    
    $sql    = "SELECT apply.cid,cname,quota FROM company,apply WHERE apply.sid = '$password' and apply.cid = company.cid;";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "cid: " . $row["cid"] . " - cname: " . $row["cname"] . " - quota: " . $row["quota"];
            echo "<form method='POST' action=delete.php>
                <input type=hidden name=id value=" . $row["cid"] . " >
                <input type=hidden name=quota value=" . $row["quota"] . " >
                <input type=hidden name=user value=" . $username . " >
                <input type=hidden name=pass value=" . $password . " >
                <input type=submit value=Delete name=delete >
                </form>";
            echo "<br>";
        }
    } else {
        echo "0 results";
    }
    
    echo "<br>";
    echo "<form method='POST' action=apply.php>
                <input type=hidden name=user value=" . $username . " >
                <input type=hidden name=pass value=" . $password . " >
                <input type=hidden name=applied value=" . mysqli_num_rows($result) . " >
                <input id=go-to-apply type=submit value=\"Apply More Internships\" name=go-to-apply >
                </form>";  
} else {
    echo "Failed To Login!";

    echo "<form method='POST' action=index.php>
                <input type=submit value=Return name=go-back >
            </form>";
    echo "</div>";
}

mysqli_close($conn);
?>