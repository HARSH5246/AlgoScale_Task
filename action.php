<?php

require 'db.php';

if(isset($_POST['action']) && $_POST['action'] == 'register')
{
    $name = check_input($_POST['name']);
    $uname = check_input($_POST['userid']);
    $email = check_input($_POST['email']);
    
    $sql = $con->prepare('SELECT userid,email FROM registered WHERE userid = ? OR email= ?');
        $sql->bind_param("ss",$uname,$email);
        $sql->execute();
        $result = $sql->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row['userid']==$uname)
        {
            echo 'userid not available';
        }
        elseif($row['email']==$email)
        {
            echo 'email is already registered';
        }
        else
        {
            $stmt = $con->prepare("INSERT INTO registered (name,email,userid) VALUES (?,?,?)");
            $stmt->bind_param("sss",$name,$email,$uname);
            if($stmt->execute())
            {
                echo "Registered Successsfully. Login now";
            }
            else
            {
                echo "Something went wrong. Try Again!";
            }

        }
}

if(isset($_POST['action']) && $_POST['action'] == 'login')
{
    session_start();
    $username = $_POST['userid'];
    $password = $_POST['password'];
    
    $stmt_l= $con->prepare('SELECT * FROM adminlogin WHERE userid = ? AND password = ?');
    $stmt_l->bind_param("ss",$username,$password);
    $stmt_l->execute();
    $user = $stmt_l->fetch();
    
    if($user!=null)
    {
        $_SESSION['userid']=$username;
        echo 'ok';
        
        if(!empty($_POST['rem']))
        {
            setcookie('userid',$_POST['userid'],time()+(10*365*24*60*60));
            setcookie('password',$_POST['password'],time()+(10*365*24*60*60));
        }
        else
        {
            if(isset($_COOKIE['userid']))
            {
                setcookie('userid','');
                
            }
            if(isset($_COOKIE['password']))
            {
                setcookie('password','');
                
            }
        }
    }
    else
    {
        echo 'Login failed! Check your userid and password';
    }
}

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>