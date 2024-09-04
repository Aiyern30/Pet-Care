<?php 
include 'condb.php';
session_start();

if (!isset($_SESSION['noic'])){
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
    <title>Payment</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/customer/style.css">
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
        include 'homenav.php';
    ?>

    <div class="home-title">
        <h1>Payment Details</h1>
    </div>

    <div class="table">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Pet ID</th>
                        <th>Pet Name</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Date</th>
                        <th>Action</th>


                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM payment";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $paymentid = $row['paymentid'];
                            $petid = $row['petid'];
                            $amount = $row['amount'];
                            $paymentmethod = $row['paymentmethod'];
                            $date = $row['date'];
                            $sql = "SELECT * FROM pet where petid = '$petid';";
                            $run = mysqli_query($con, $sql);
                            $row = mysqli_fetch_assoc($run);
                            $petname = $row['petname'];

                    ?>
                        <tr>
                            <td><?php echo $paymentid; ?></td>
                            <td><?php echo $petid; ?></td>
                            <td><?php echo $petname; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $paymentmethod; ?></td>
                            <td><?php echo $date; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $paymentid ?>)">View</button></td>
                        </tr>
                         
                        <section class="form-container" id="form-popup-<?php echo $paymentid ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $paymentid ?>">&times;</span>
                                    View Receipt
                                </header>
                                <form action="Payment.php" name="Form<?php echo $paymentid ?>" class="form" method="POST" onsubmit="return validateForm('Form<?php echo $Announcementid ?>')">
                                    <div class="form-input-details">
                                        <label for="">Payment ID</label>
                                        <input type="text" value="<?php echo $paymentid ?>" readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Pet ID</label>
                                        <input type="text" value="<?php echo $petid ?>" readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Pet Name</label>
                                        <input type="text" value="<?php echo $petname ?>" readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Amount</label>
                                        <input type="text" value="<?php echo $amount ?>" readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Payment Method</label>
                                        <input type="text" value="<?php echo $paymentmethod ?>" readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Date</label>
                                        <input type="text" value="<?php echo $date ?>" readonly>
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
    
</body>
</html>