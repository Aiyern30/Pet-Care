<?php 
include 'condb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/Announcement.css">
</head>


<body>
    <?php 
        if(isset($_SESSION['noic'])){
            include 'homenav.php';
        }else{
            include 'guest_nav.php';
        }
    ?>

    <div class="announcement-title">
        <h1>Announcement <i class="fa-solid fa-bell"></i></h1>
    </div>

    <div class="announcement-timeline ">
    <?php 
    $SQL = "SELECT * FROM announcement ORDER BY announcementid DESC";
    $show = mysqli_query($con, $SQL);
    $num = mysqli_num_rows($show);

    if ($num > 0) {
        $i = 0; 
        while ($showData = mysqli_fetch_assoc($show)) {
            $Title = $showData['title'];
            $Description = $showData['description'];
            $Date = $showData['date'];
            $image = "../assets/image/Cat.jpg";

            $Dates = new DateTime($Date);
            $current_time = new DateTime();
            $time_ago = $current_time->diff($Dates);

            $time_ago_str = $time_ago->format('%d days, %h hours, %i minutes ago');

            $class = ($i % 2 == 0) ? "left-container" : "right-container";
            $arrow_class = ($i % 2 == 0) ? "left-container-arrow" : "right-container-arrow";
            $i++; 

            echo '<div class="container ' . $class . '">';
            echo '<img src="' . $image . '" alt="">';
            echo '<div class="text-box">';
            echo '<h2>' . $Title . '</h2>';
            echo '<small>' . $Date . ' ' . $time_ago_str . '</small>';
            echo '<p>' . $Description . '</p>';
            echo '<span class="' . $arrow_class . '"></span>';
            echo '</div></div>';
        }
    }
?>

    </div>
    
</body>
</html>