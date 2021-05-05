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

$applicationNum = $_POST['applied'];
$username       = $_POST['user'];
$password       = $_POST['pass'];

if ($applicationNum >= 3) {
    echo "<h1>YOU CANNOT APPLY ANY MORE INTERNSHIPS</h1>";
} else {
    echo "<h1>OPEN POSITIONS</h1>";
    
    $servername = "servername";
    $user       = "username";
    $pass       = "password";
    $dbname     = "dbname";
    
    $conn = mysqli_connect($servername, $user, $pass, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql    = "SELECT cid,cname,quota FROM company WHERE cid NOT IN (SELECT cid FROM apply WHERE sid = '$password');";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["quota"] > 0) {
                echo "cid: " . $row["cid"] . " - cname: " . $row["cname"];
                echo "<form method='POST' action=applyresult.php>
                    <input type=hidden name=id value=" . $row["cid"] . " >
                    <input type=hidden name=quota value=" . $row["quota"] . " >
                    <input type=hidden name=user value=" . $username . " >
                    <input type=hidden name=pass value=" . $password . " >
                    <input type=hidden name=applicationNum value=" . $applicationNum . " >
                    <input type=submit value=Apply name=apply >
                    </form>";
                echo "<br>";
            }
        }
    } else {
        echo "0 results";
    }
}

echo "<form method='POST' action=student.php>
                <input type=hidden name=user value=" . $username . " >
                <input type=hidden name=pass value=" . $password . " >
                <input type=submit value=Return name=return >
                </form>";
echo "<br>";
?>