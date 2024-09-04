<?php 
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_owner'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='../Staff/login.php';</script>";
    exit();
}

if(isset($_POST['disable'])){
    $id = $_POST['id'];
    $updateStatus = "UPDATE customer set status = false where customerid = '$id'";
    mysqli_query($con, $updateStatus);
    header('Refresh:0');
    exit();
}elseif (isset($_POST['unlock'])){
    $id = $_POST['id'];
    $updateStatus = "UPDATE customer set status = true where customerid = '$id'";
    mysqli_query($con, $updateStatus);
    header('Refresh:0');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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

        .unlock-btn{
            width: 100px;
            height: 50px;
            margin: 0 auto;
            background-color: red;
            color: white;
            font-size: 16px;
        }
        .unlock-btn:hover{
            background-color: brown;
        }

        .disable-btn{
            width: 100px;
            height: 50px;
            margin: 0 auto;
            background-color: #009879;
            color: white;
            font-size: 16px;
        }
        .disable-btn:hover{
            background-color: #1e90ff;
        }
    </style>
<body>
    <?php 
        include 'Sidebar.php';
    ?>
    <section>
    <div class="home-title">
        <h1>Customer Account Details</h1>
    </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="Account.php"><button>Staff Account</button></a>
            </div>
        </div>

        
        <div class="table">
            <table class="content-table" >
                <thead>
                    <tr>
                        <th>Customer ID</th>
                        <th>IC Number</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>View Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM customer ";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $CustomerID = $row['customerid'];
                            $Fullname = $row['fullname'];
                            $Email = $row['email'];
                            $NoPH = $row['noph'];
                            $NoIC = $row['noic'];
                            $status = $row['status'];

                    ?>
                        <tr>
                            <td><?php echo $CustomerID; ?></td>
                            <td><?php echo $NoIC; ?></td>
                            <td><?php echo $Fullname; ?></td>
                            <td><?php echo $NoPH; ?></td>
                            <td><?php echo '<a href="mailto:"'.$Email.'">'.$Email.'</a>' ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $CustomerID ?>)">View</button></td>
                            <td>
                                <?php if($status == true): ?>
                                    <form action="CustomerAccount.php" method="post">
                                        <input type="hidden" value="<?php echo $CustomerID;?>" name="id">
                                        <button class="disable-btn" name="disable" onclick="return confirm('Are you sure to disable this account (Customer ID: <?php echo $CustomerID; ?>)?')">Actived</button>
                                    </form>
                                <?php else: ?>
                                    <form action="CustomerAccount.php" method="post">
                                        <input type="hidden" value="<?php echo $CustomerID;?>" name="id">
                                        <button class="unlock-btn" name="unlock" onclick="return confirm('Are you sure to unclock this account (Customer ID: <?php echo $CustomerID; ?>)?')">Locked</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        
                        <section class="form-container" id="form-popup-<?php echo $CustomerID ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $CustomerID ?>">&times;</span>
                                    View Customer Details
                                </header>
                                <form action="Account.php" class="form" method="POST">
                                    <div class="form-input-details">
                                        <label for="">UserID</label>
                                        <input type="hidden" name="Feedbackid" value="<?php echo $CustomerID ?>">
                                        <input type="text" name="UserID" value="<?php echo $CustomerID ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">IC Number</label>
                                        <input type="text" name="NoIC"  value="<?php echo $NoIC ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Fullname</label>
                                        <input type="text" name="Fullname" value="<?php echo $Fullname ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="NoPH" value="<?php echo $NoPH ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Email</label>
                                        <input type="text" name="Email" value="<?php echo $Email ?>" required readonly>
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
            const CustomerID = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${CustomerID}`);
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