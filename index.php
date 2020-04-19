<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        body{
            background-image: linear-gradient(to right, #6600CC, #660033, #000033, #330000, #330066, #6600cc);
        }
        #alert,#register-box
            {
                display: none;
            }
    </style>
</head>

<body>
   <div class="container mt-4">
       <div class="row">
           <div class="col-lg-4 offset-lg-4" id="alert">
               <div class="alert alert-success">
                   <strong id="result"></strong>
               </div>
           </div>
       </div>
          <!-- Login Form -->
           <div class="row">
               <div class="col-lg-4 offset-lg-4 bg-light rounded" id="login-box">
                   <h2 class="text-center mt-2">Admin Login</h2>
                   <form action="" method="post" role="form" class="p-2" id="login-form">
                       <div class="form-group">
                           <input type="text" name="userid" class="form-control" placeholder="UserId" required minlength="4" value="<?php if(isset($_COOKIE['userid'])){echo $_COOKIE['userid'];}?>">
                       </div>
                       <div class="form-group">
                           <input type="password" name="password" class="form-control" placeholder="Password" required minlength = "8" value="<?php if(isset($_COOKIE['password'])){echo $_COOKIE['password'];}?>">
                       </div>
                       <div class="form-group">
                           <input type="submit" name="login" id="login" value="Login" class="btn btn-primary btn-block">
                       </div>
                       <div class="form-group">
                           <p class="text-center" >If you are not Admin, Please <a href="#" id="register-btn">Register Here</a></p>
                       </div>
                   </form>
               </div>
           </div>
              <!-- registration form -->
              <div class="row">
               <div class="col-lg-4 offset-lg-4 bg-light rounded" id="register-box">
                   <h2 class="text-center mt-2">User Registeration</h2>
                   <form action="" method="post" role="form" class="p-2" id="register-form">
                       <div class="form-group">
                           <input type="text" name="name" class="form-control" placeholder="Full Name" required minlength="4">
                       </div>
                       <div class="form-group">
                           <input type="text" name="userid" class="form-control" placeholder="UserId" required minlength="4">
                       </div>
                          <div class="form-group">
                           <input type="email" name="email" class="form-control" placeholder="E-Mail" required>
                       </div>
                      
                       <div class="form-group">
                           <div class="custom-control custom-checkbox">
                               <input type="checkbox" name="rem" class="custom-control-input" id="customCheck2">
                               <label for="customCheck2" class="custom-control-label">I agree to the <a href="#">Terms and Conditions</a></label> 
                           </div>
                       </div>
                       <div class="form-group">
                           <input type="submit" name="register" id="register" value="Register" class="btn btn-primary btn-block">
                       </div>
                       <div class="form-group">
                           <p class="text-center" >If you are an Admin, <a href="#" id="login-btn">Login Here</a></p>
                       </div>
                   </form>
               </div>
           </div>
             
       </div>
   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#register-btn').click(function(){
               $('#login-box').hide();
                $('#register-box').show();
            });
            $('#login-btn').click(function(){
               $('#login-box').show();
                $('#register-box').hide();
            });
            $('#login-form').validate();
            $('#register-form').validate({
                rules:{
                    cpass:{
                        equalTo:"#pass",
                    }
                }
            });
            $('#register').click(function(e){
                if(document.getElementById('register-form').checkValidity())
                    {
                        e.preventDefault();
                        $.ajax({
                            url:'action.php',
                            method:'post',
                            data:$('#register-form').serialize()+'&action=register',
                            success:function(response)
                            {
                                $('#alert').show();
                                $('#result').html(response);
                            }
                            
                        });
                    }
                return true;
            });
            $('#login').click(function(e){
                if(document.getElementById('login-form').checkValidity())
                    {
                        e.preventDefault();
                        $.ajax({
                            url:'action.php',
                            method:'post',
                            data:$('#login-form').serialize()+'&action=login',
                            success:function(response)
                            {
                                if(response==='ok')
                                    {
                                        window.location='profile.php';
                                    }
                                $('#alert').show();
                                $('#result').html(response);
                            }
                            
                        });
                    }
                return true;
            });
            
        });
    </script>
</body>

</html>
