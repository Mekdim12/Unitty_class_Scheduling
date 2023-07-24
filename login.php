<?php session_start(); ?>
<?php require_once("db_connection/db_conn.php"); ?>
<?php include_once("includes/basic_functions.php");?> 
<?php 

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM user_account WHERE user_name = '$username' AND password = '$password' ";
        $result = mysqlexec($sql);

        if (mysqli_num_rows($result) > 0) {
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['user_name'] = $row['user_name'];
        
                header('Location: templates/admin_index.php');
                
            } else {
                echo "<br> <h2> Nottt Working</h2>";
                
                echo mysqli_error($conn);
            }
        }
     }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">User Name</label>
        <input type="text" name="username">
        <br>
        <label for="password">Password</label>
        <input type="password" name="password">
        <br>

        <input type="submit">

    </form>
    
</body>
</html>