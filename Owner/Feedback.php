<?php 
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_owner'])){
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
    <title>Feedback Management</title>
    <link rel="stylesheet" href="../assets/css/owner/Owner.css">
    <link rel="stylesheet" href="../assets/css/owner/form.css">
    <link rel="stylesheet" href="../assets/css/owner/table.css">
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
        include 'Sidebar.php';
    ?>
    <section>
        <div class="home-title">
            <h1>Feedback</h1>
        </div>
        

    <div class="btn-container">
        <div class="right-top-button">
            <button onclick="printTable()">Print</button>
        </div>
    </div>
        <script>
            function printTable() {
                var printContents = document.getElementById("table").innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
        <div class="table" id="table">
            <table class="content-table" >
                <thead>
                    <tr>
                        <th>Feedback ID</th>
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Feedback</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM feedback ORDER BY feedbackid DESC";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $Feedbackid = $row['feedbackid'];
                            $Fullname = $row['fullname'];
                            $Email = $row['email'];
                            $NoPH = $row['noph'];
                            $Feedback = $row['feedback'];

                    ?>
                        <tr>
                            <td><?php echo $Feedbackid; ?></td>
                            <td><?php echo $Fullname; ?></td>
                            <td><?php echo '<a href="mailto:"'.$Email.'">'.$Email.'</a>' ?></td>
                            <td><?php echo $NoPH; ?></td>
                            <td><?php echo $Feedback; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $Feedbackid ?>)">View</button></td>
                        </tr>
                        
                        <section class="form-container" id="form-popup-<?php echo $Feedbackid ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $Feedbackid ?>">&times;</span>
                                    View Feedback Details
                                </header>
                                <form action="Feedback.php" class="form" method="POST">
                                    <div class="form-input-details">
                                        <label for="">Fullname</label>
                                        <input type="hidden" name="Feedbackid" value="<?php echo $Feedbackid ?>">
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
                                        <label for="">Feedback</label>
                                        <input type="text" name="Enquiry"  value="<?php echo $Feedback ?>" required readonly>
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
            const Feedbackid = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${Feedbackid}`);
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