<html>
 <head>
  <title>Internship Application System</title>

  <script type="text/javascript">
  function checkEmptyInput() {
    var username = document.forms["login-form"]["user"].value;
    var password = document.forms["login-form"]["pass"].value;

    if (username == null || username == "" || password == null || password == "") {
      alert("Please Fill All Of The Required Fields");
      return false;
    }
  }
</script>

<style>
  body {
    background-color: linen;
  }

  h1 {
    color: maroon;
    text-align:center;
  }

  .login-input-area{
    width:15%;
    margin-bottom: 1%;
  }

  input{
    width:65%
  }
  
  label{
    width:25%;
    display:inline-block;
    font-weight:bold;
  }

  #btn{
    width: 5%;
    width: 5%;
    border: 2px solid;
    background-color: transparent;
  }

  form{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

</style>
 </head>
 <body>
 <h1>Student Internship Application System</h1>
 <br>
  <form action="student.php" name="login-form" method="POST" onSubmit="return checkEmptyInput()">
    <div class="login-input-area">
      <Label>Username</Label>
      <input type="text" id="user" name="user">
    </div>
    <div class="login-input-area">
      <Label>Password</Label>
      <input type="password" id="pass" name="pass">
    </div>
    <input type="submit" id="btn" name="Login">
  </form>
 </body>
</html>