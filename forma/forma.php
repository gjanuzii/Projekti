<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="forma.css">
</head>
<body>
  <div class="main">
    
  <div class="register-forma">
    <div class="user-container">
        <h2>Krijo Llogari</h2>
        <form id="userForm" action="register.php" method="post">
          <label for="name">Emri:</label>
          <input type="text" id="name" name="name">
          <span id="nameError" class="error"></span>

          <label for="surname">Mbiemri:</label>
          <input type="text" id="surname" name="surname">
          <span id="surnameError" class="error"></span>


          <label for="email">Email:</label>
          <input type="text" id="email" name="email">
          <span id="emailError" class="error"></span>
    
          <label for="password">Password:</label>
          <input type="password" id="password" name="password">
          <span id="passwordError" class="error"></span>

          <label for="cpassword">Konfirmo Password:</label>
          <input type="password" id="cpassword" name="cpassword">
          <span id="cpasswordError" class="error"></span>

          <select name="user_type" style="height:35px" >
         <option value="user">user</option>
         <option value="admin">admin</option>
        </select>
    
          <input type="submit" name="submit" class="button" value="Register" style="margin-top: 10px">
        </form>
      </div>
  </div>    



  <!--LogInForma-->
  <div class="login-forma" media="(max-width:780px)" style="margin-top: 280px;" >
    <div class="userlog-container">
        <h2>Log In</h2>
        <form id="userlogForm" action="login.php" method="post">

          <label for="l_email">Email:</label>
          <input type="text" id="l_email" name="l_email">
          <span id="l_emailError" class="error"></span>
    
          <label for="l_password">Password:</label>
          <input type="password" id="l_password" name="l_password">
          <span id="l_passwordError" class="error"></span>
    
          <input type="submit" class="l_button" value="Login">
        </form>
      </div>
  </div>
  
  
  </div>
    
 

</body>
</html>