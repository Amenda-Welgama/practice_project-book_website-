<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['delete'])){
    $delete_id=$_GET['delete'];
    mysqli_query($conn,"DELETE FROM `users` WHERE id='$delete_id'") or die
    ('query failed');
    header('location:admin_users.php');
  }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Users</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='admin_style.css'>
    <script src='main.js'></script>
    <!-- font owesome cdn link -->
    <link rel='stylesheet' href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
    
<?php include 'admin_header.php'?>

<section class="users">
<div class="h1 title">User Accounts</div>
    <div class="box-container">
        <?php
           $select_users=mysqli_query($conn,"SELECT * FROM `users`")
           or die('query failed');
           while($fetch_users=mysqli_fetch_assoc($select_users)){
        ?>
            <div class="box">
                <p>username : <span> <?php echo $fetch_users['name'];?> </span></p>
                <p>email : <span> <?php echo $fetch_users['email'];?> </span></p>
                <p>user type : <span style="color: <?php if($fetch_users['user_type']=='admin'){echo 'var(--orange)';}?>"> <?php echo $fetch_users['user_type'];?> </span></p>
                <a href="admin_users.php?delete=<?php echo $fetch_users['id'];?>" 
                onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
            </div>
        <?php    
           };
        ?>
    </div>
</section>




<script src='admin_script.js'></script>

</body>
</html>