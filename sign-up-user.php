<?php
    $message = " ";
    include('connection.php');

    if(isset($_POST['sign-up']))
    {
        $username = htmlentities(mysqli_real_escape_string($con, $_POST['username']));
        $password = htmlentities(mysqli_real_escape_string($con, $_POST['password']));
        $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
        $country = htmlentities(mysqli_real_escape_string($con, $_POST['country']));
        $department = htmlentities(mysqli_real_escape_string($con, $_POST['department']));
        $gender = htmlentities(mysqli_real_escape_string($con, $_POST['gender']));
        
        $query = "select * from users where email = '$email'";
        $res = mysqli_query($con, $query);
        $num = mysqli_num_rows($res);
        $pic="abc.png";
        
        if($num > 0)
        {
            $message = "Email is already registered! Try again";
        }
        elseif (strlen($password) < 8)
        {
            $message = "Password is too short!";
        }
        else
        {
            $query = "insert into users(username, password, email, gender, country,department, profile_pic) values('$username', '$password', '$email', '$gender', '$country','$department', '$pic')";
            $res = mysqli_query($con, $query);
            
            if($res)
            {
                echo "<script>window.alert('Congratulations! $username, your account is successfully created')</script>";
                
                echo "<script>window.open('sign-in.php', '_self')</script>";
            }
            else
            {
                $message = "Account is not created! Try again.";
            }
        }
    }
?>