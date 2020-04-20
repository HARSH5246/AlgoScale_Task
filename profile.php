<?php 
require 'db.php';
?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    
    <style>
        body{
            background-color: burlywood;
            font-family: sans-serif;
        }
        #design{
            width:150px;
            height:37px;
            color:white;
            text-align: center;
            background-color: darkmagenta;
            cursor: pointer;
        }
        .box{
            border: 6px solid brown;
            width: 400px;
            height: 200px;
            margin: auto;
            margin-top: 90px;
        }
    </style>
</head>

<body>
   <div class="container">
       <h2 class="text-center mt-5" style="font-weight:bold;">Welcome Admin <span class="ml-5"><a href="logout.php" type="button" class="btn btn-primary">Logout</a></span></h2>
   </div>
   
    <?php
        if(isset($_POST['submit']))
        {
           $selected = $_POST['id'];
           mysqli_query($con, "DELETE FROM registered where id = '$selected' ");
        }
    $result = $con->query("SELECT id,userid FROM registered");
    ?>
    
    <div class="box">
         <form class="text-center mt-5"  action="<?php echo $_SERVER["PHP_SELF"] ?>" method="POST">
             <select name="id" class="border border-secondary rounded" id="design">
                 <?php
                    while($row = $result->fetch_assoc())
                    {
                        unset($id,$userid);
                        $id = $row['id'];
                        $userid = $row['userid'];
                        echo '<option value=" '.$id.' ">'.$userid.'</option>';
                    }
                 ?>
             </select>
             <input type="submit" name="submit" value="Delete" class="btn btn-danger ml-3">
         </form> 
     
         <div class="text-center mt-4">
             
         </div>
    </div>
    
       
</body>
</html>
