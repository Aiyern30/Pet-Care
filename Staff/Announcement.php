<?php 
    include '../Customer/condb.php';

    session_start();

    if (!isset($_SESSION['noic_staff'])){
        echo "<script>alert('Please login first!');</script>";
        echo "<script>window.location.href='login.php';</script>";
        exit();
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement Page</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
</head>
    <style>
        
        .form-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            justify-content: center;
            align-items: center;

            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .form-container.active {
            display: flex;
        }      
                    
    </style>
         
<body>

    <?php 
    include 'sidebar.php';
    ?>
    <section>
        <div class="home-title">
            <h1>Annoucement</h1>
        </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="createAnnouncement.php"><button>+ Create +</button></a>
            </div>
        </div>
        
    
        <div class="table">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Annoucement ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(isset($_POST['update'])){
                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $announcementid = $_POST['announcementid'];
                            $sql = "UPDATE announcement SET title = '$title', description = '$description' WHERE announcementid = '$announcementid';";
                            $run = mysqli_query($con,$sql);

                            if($run){
                                echo '<div class="success">
                                    <strong>Update Successfull!</strong>
                                </div>';
                            }
                        }
                        if(isset($_POST['delete'])){
                            $announcementid = $_POST['announcementid'];
                            $sql = "DELETE FROM `announcement` WHERE announcementid = '$announcementid'; ";
                            $run = mysqli_query($con,$sql);

                            if($run){
                                echo '<div class="success">
                                    <strong>Announcement has deleted successfull!</strong>
                                </div>';
                            }
                        }
                    ?>
                    <?php
                        $sql = "SELECT * FROM announcement";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $Announcementid = $row['announcementid'];
                            $Title = $row['title'];
                            $Description = $row['description'];

                    ?>
                        <tr>
                            <td><?php echo $Announcementid; ?></td>
                            <td><?php echo $Title; ?></td>
                            <td><?php echo $Description; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $Announcementid ?>)">View</button></td>
                        </tr>
                        <script>
                            function validateForm(formId) {
                                var title = document.forms[formId]["title"].value;
                                var description = document.forms[formId]["description"].value;

                                if (title.length < 10) {
                                    alert("Title is too short!");
                                    return false;
                                } else if (title.length > 100) {
                                    alert("Title is too long!");
                                    return false;
                                } else if (description.length < 10) {
                                    alert("Description is too short!");
                                    return false;
                                } else if (description.length > 250) {
                                    alert("Description is too long!");
                                    return false;
                                }
                            }
                        </script>
                         
                        <section class="form-container" id="form-popup-<?php echo $Announcementid ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $Announcementid ?>">&times;</span>
                                    View Announcement Details
                                </header>
                                <form action="Announcement.php" name="Form<?php echo $Announcementid ?>" class="form" method="POST" onsubmit="return validateForm('Form<?php echo $Announcementid ?>')">
                                    <div class="form-input-details">
                                        <label for="">Title</label>
                                        <input type="hidden" name="announcementid" value="<?php echo $Announcementid ?>">
                                        <input type="text" name="title" placeholder="Title" value="<?php echo $Title ?>" required>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Description</label>
                                        <input type="text" name="description" placeholder="Description" value="<?php echo $Description ?>" required>
                                    </div>
                                    <div class="form-btn-details">
                                        <button name="update" style="float:left; width:45%">Update</button>
                                        <button name="delete" style="float:right; width:45%">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </section>
                    <?php } ?>
    
                    
                </tbody>
            </table>
        </div>

        <script>
            function showPopup(id) {
                var popup = document.getElementById("form-popup-" + id);
                popup.classList.add("active");
            }

            const viewBtns = document.querySelectorAll(".View-Btn");
            const formContainer = document.querySelector(".form-container");

            // ViewBtn
            viewBtns.forEach((btn) => {
            btn.addEventListener("click", () => {
            const announcementId = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${announcementId}`);
            popup.classList.add("active");
            });
            });

            formContainer.addEventListener("click", (e) => {
            if (e.target === formContainer) {
            formContainer.classList.remove("active");
            }
            });

            // Close Btn
            const closeBtns = document.querySelectorAll('.close-btn');

            closeBtns.forEach((closeBtn) => {
            closeBtn.addEventListener('click', function() {
            const popupId = this.closest('.form-container').id;
            const popup = document.getElementById(popupId);
            popup.classList.remove('active');
            });
            });

        </script>

    </section>
</body>
</html>