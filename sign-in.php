<?php
    include('sign-in-user.php');
?>

<!doctype html>
<html lang="en">
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous">

    
<link rel="stylesheet" href="../css/sign-in.css">
<title>Login to your account</title>

</head>
<body>
    <div class="sign-in-form col-sm-8 col-md-7 col-lg-4">
        <div class="header text-center">Sign In Chat Application</div>
        <p style="color: red; text-align: center;"><?php echo($message); ?></p>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" autocomplete="off" required>
                <small>We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" autocomplete="off" required>
                <div class="text-right small">Forgot password? <a href="forgot-password.php">Click here</a></div>
            </div>
            <button type="submit" class="btn btn-success btn-block" name="sign-in">Submit</button>
        </form>
        <br>
        <div class="text-center small">Don't have a account ? </div>
        <div class="text-center small"><a href="sign-up.php">Create account</a></div>
    </div>
    
    <script src="js/jquery-3.4.1.slim.min.js" integrity="sha256-8EjQgGzwV+Xy1+llo0dGcGJdJkdfz7m1s1gzEU2XTTk=" crossorigin="anonymous"></script>
    <script src="js/popper.min.js" integrity="sha256-7AWAWrnzBhpZ1+xtVOsJTGrqo0sC7FzOW+mvsdrC+qM=" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha256-CjSoeELFOcH0/uxWu6mC/Vlrc1AARqbm/jiiImDGV3s=" crossorigin="anonymous"></script>
</body>
</html>