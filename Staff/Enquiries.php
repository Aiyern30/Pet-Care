<?php 
    include '../Customer/condb.php';
    session_start();

    if (!isset($_SESSION['noic_staff'])){
        echo "<script>alert('Please login first!');</script>";
        echo "<script>window.location.href='../Staff/login.php';</script>";
        exit();
    }
?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiries Page</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
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
            <h1>Enquiries</h1>
        </div>

        <div class="table">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Enquiries ID</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Enquiries</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM enquiry";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $Enquiryid = $row['enquiryid'];
                            $Fullname = $row['fullname'];
                            $Email = $row['email'];
                            $NoPH = $row['noph'];
                            $Enquiry = $row['enquiry'];

                    ?>
                        <tr>
                            <td><?php echo $Enquiryid; ?></td>
                            <td><?php echo $Fullname; ?></td>
                            <td><?php echo '<a href="mailto:"'.$Email.'">'.$Email.'</a>' ?></td>
                            <td><?php echo $NoPH; ?></td>
                            <td><?php echo $Enquiry; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $Enquiryid ?>)">View</button></td>
                        </tr>
                        
                        <section class="form-container" id="form-popup-<?php echo $Enquiryid ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $Enquiryid ?>">&times;</span>
                                    View Enquiries Details
                                </header>
                                <form action="Announcement.php" class="form" method="POST">
                                    <div class="form-input-details">
                                        <label for="">Fullname</label>
                                        <input type="text" name="Fullname" value="<?php echo $Fullname ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Email</label>
                                        <input type="text" name="Email" value="<?php echo $Email ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="NoPH" value="<?php echo $NoPH ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Enquiry</label>
                                        <input type="text" name="Enquiry"  value="<?php echo $Enquiry ?>" required readonly>
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
            const Enquiryid = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${Enquiryid}`);
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