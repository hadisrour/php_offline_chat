<?php
    include('connection.php');
    session_start();

    $user_id = $_POST['user_id'];

    $query = "select * from users where user_id = $user_id";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);

    $profile = "<div class='remove' style='float: right; cursor: pointer;'><button  type='button' class='remove' style='background-color: #FF00FF; color: white;  margin-top: 100px auto; width: 80px;height:30px;'> Cancel</button></div><div class='col-8' style='margin: 0px auto; padding-top: 5rem'>
                    <div style='margin: 0px auto;text-align: center;'>
                        <img src='profile-pic/".$row['profile_pic']."' height='200px' width='200px' style='border-radius: 100px;'>
                    </div><br>
                    <ul class='table'>
                        <li style='text-align: center;'>
                            <span>Name:</span><span>".$row['username']."</span>
                        </li>
                        <li style='text-align: center;'>
                            <span>Country: </span><span>".$row['country']."</span>
                        </li>
                        <li style='text-align: center;'>
                            <span>Gender: </span><span>".$row['gender']."</span>
                        </li>
                        <li style='text-align: center;'>
                            <span>Department: </span><span>".$row['department']."</span>
                        </li>
                    </ul>
                </div>";
    echo $profile;
?>