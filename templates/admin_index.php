<?php session_start(); ?>
<?php require_once("../db_connection/db_conn.php"); ?>
<?php include_once("../includes/basic_functions.php");?> 

<?php

    if (isloggedin()) {
        //do nothing stay here
    } else {
        header("location:../login.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <a href=""><button>Manage Personal Infromation</button></a>
    <br> <br>
    <a href="admin_student_management.php"><button>Manage Student Infromation</button></a>
    <br> <br>
    <a href=""><button>Manage Teachers Infromation</button></a>
    <br> <br>
    <a href=""><button>Manage Class Room Infromation</button></a>
    <br> <br>
    <a href="admin_course_management.php"><button>Manage Course Information</button></a>
    <br>
    <br>
    <a href=""><button>Manage Schedules</button></a>
    <br>
    <br>
    <a href="../logout.php"><button>Logut</button></a>


   
</body>
</html>