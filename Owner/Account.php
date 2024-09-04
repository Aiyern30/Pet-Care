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
    $updateStatus = "UPDATE employee set status = false where userid = '$id'";
    mysqli_query($con, $updateStatus);
    header('Refresh:0');
    exit();
}elseif (isset($_POST['unlock'])){
    $id = $_POST['id'];
    $updateStatus = "UPDATE employee set status = true where userid = '$id'";
    mysqli_query($con, $updateStatus);
    header('Refresh:0');
    exit();
}


if(isset($_POST['Update'])){
    $UserID = $_POST['UserID'];
    $NoIC = $_POST['NoIC'];
    $Email = $_POST['Email'];
    $NoPH = $_POST['NoPH'];
    $Fullname = $_POST['Fullname'];
    $Password = $_POST['Password'];


    // Phone number validation
    if(!preg_match('/^01\d{8,9}$/', $NoPH)){
        echo '<script>alert("Invalid phone number format. Phone number must start with 01 and have 8-9 digits.");</script>';
    }
    // Email validation
    elseif(!preg_match('/^[A-Za-z0-9._%+-]+@gmail.com$/', $Email)){
        echo '<script>alert("Invalid email format. Email must be in gmail.com format.");</script>';
    }
    // NoIC validation
    elseif(!preg_match('/^\d{12}$/', $NoIC)){
        echo '<script>alert("Invalid NoIC format. NoIC must have 12 digits.");</script>';
    }
    else{
        $update = "UPDATE employee SET noic = '$NoIC', fullname = '$Fullname', email = '$Email', noph = '$NoPH', password = '$Password' WHERE userid = '$UserID'";
        $run = mysqli_query($con, $update);
        if($run){
            echo '<script>alert("Update Successful");</script>';
        }
    }
}
if(isset($_POST['Delete'])){
    $UserID = $_POST['UserID'];

    $delete = "DELETE FROM employee WHERE userid = '$UserID'";
    $run = mysqli_query($con, $delete);
    if($run){
        echo '<script>alert("Staff member deleted successfully.");</script>';
    } else {
        echo '<script>alert("Failed to delete staff member.");</script>';
    }
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
        <h1>Staff Account Details</h1>
    </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="CustomerAccount.php"><button>Customer Account</button></a>
            </div>
        </div>

        
        <div class="table">
            <table class="content-table" >
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>IC Number</th>
                        <th>Fullname</th>
                        <th>Phone Number</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>View Details</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM employee where usertype = 'staff'";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $StaffID = $row['userid'];
                            $Fullname = $row['fullname'];
                            $Email = $row['email'];
                            $NoPH = $row['noph'];
                            $NoIC = $row['noic'];
                            $Password = $row['password'];
                            $status = $row['status'];

                    ?>
                        <tr>
                            <td><?php echo $StaffID; ?></td>
                            <td><?php echo $NoIC; ?></td>
                            <td><?php echo $Fullname; ?></td>
                            <td><?php echo $NoPH; ?></td>
                            <td><?php echo '<a href="mailto:"'.$Email.'">'.$Email.'</a>' ?></td>
                            <td><?php echo $Password; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $StaffID ?>)">View</button></td>
                            <td>
                                <?php if($status == true): ?>
                                    <form action="Account.php" method="post">
                                        <input type="hidden" value="<?php echo $StaffID;?>" name="id">
                                        <button class="disable-btn" name="disable" onclick="return confirm('Are you sure to disable this account (Staff ID: <?php echo $StaffID; ?>)?')">Actived</button>
                                    </form>
                                <?php else: ?>
                                    <form action="Account.php" method="post">
                                        <input type="hidden" value="<?php echo $StaffID;?>" name="id">
                                        <button class="unlock-btn" name="unlock" onclick="return confirm('Are you sure to unclock this account (Staff ID: <?php echo $StaffID; ?>)?')">Locked</button>
                                    </form>
                                <?php endif; ?>
                            </td>
                        </tr>
                        
                        
                        <section class="form-container" id="form-popup-<?php echo $StaffID ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $StaffID ?>">&times;</span>
                                    View Account Details
                                </header>
                                <form action="Account.php" class="form" method="POST">
                                    <div class="form-input-details">
                                        <label for="">UserID</label>
                                        <input type="text" name="UserID" value="<?php echo $StaffID ?>" required readonly>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">IC Number</label>
                                        <input type="text" name="NoIC"  value="<?php echo $NoIC ?>" required >
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Fullname</label>
                                        <input type="text" name="Fullname" value="<?php echo $Fullname ?>" required >
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Phone Number</label>
                                        <input type="text" name="NoPH" value="<?php echo $NoPH ?>" required >
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Email</label>
                                        <input type="text" name="Email" value="<?php echo $Email ?>" required >
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Password</label>
                                        <input type="password" name="Password" value="<?php echo $Password ?>" required >
                                    </div>
                                    <div class="form-btn-details">
                                        <button type="submit" style="float:left;width:45%" name="Update">Update</button>
                                        <button type="submit" style="float:right;width:45%" name="Delete">Delete</button>
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
            const StaffID = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${StaffID}`);
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