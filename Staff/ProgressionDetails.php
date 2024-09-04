<?php 
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_staff'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}
?>
    <?php 
        $PetID = $_GET['petid'];
        $Petname = $_GET['petname'];

        

        if(isset($_POST['Update'])){
            $Remarks = $_POST['Remarks'];
            $Date = $_POST['Date'];
            $Service = $_POST['Service'];

            
            $Update = "UPDATE `progression` SET `remarks`='$Remarks' WHERE date = '$Date' AND service = '$Service' AND petid = '$PetID';";
            $run = mysqli_query($con,$Update);

            if($run){
                echo '<section><div class="success">
                <strong>Update Successfull!</strong>
            </div></section>';
            }else{
                echo '<section><div class="alert">
                <strong>Something Error!</strong>
            </div></section>';

            }
        }
        if(isset($_POST['Delete'])){
            $progressionid = $_POST['progressionid'];
            $Update = "DELETE FROM progression where petid = '$PetID' and progressionid = '$progressionid';";
            $run = mysqli_query($con,$Update);

            if($run){
                echo '<section><div class="success">
                <strong>Update Successfull!</strong>
            </div></section>';
            }else{
                echo '<section><div class="alert">
                <strong>Something Error!</strong>
            </div></section>';

            }
        }
        
    
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progression Report</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
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
        include 'Sidebar.php';
    ?>
    <script>
        function Validate() {
            var Remarks = document.ProgressionForm.Remarks.value;  
        
            if(Remarks.length > 50){
                alert("Remarks is too long!");
                return false;
            }
        }

    </script>  
    <section>
    <div class="home-title">
        <h1>Progression Details</h1>
    </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="Progression.php"><button> Back</button></a>
            </div>
            <div class="right-top-button">
                <a href="AddProgressionDetails.php?petid=<?php echo $PetID ?>"><button> Add Progression Details</button></a>
            </div>
            <div class="right-top-button">
                <a href="ViewSchedule.php?petid=<?php echo $PetID ?>"><button> View Pet Schedule</button></a>
            </div>
        </div>

        <div class="table">
            <table class="content-table" >
                <thead>
                    <div class="petdata">
                        <div class="data-pet">
                            <h3>Pet ID: <?php echo $PetID; ?></h3>
                        </div>
                        <div class="data-pet">
                            <h3>Pet Name: <?php echo $Petname; ?></h3>
                        </div>
                    </div>
                    
                    <tr>
                        <th>Date and Time</th>
                        <th>Service</th>
                        <th>Remarks</th>
                        <th>Update</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $SQL = "SELECT * from progression where petid = '$PetID';";
                    $run = mysqli_query($con,$SQL);
                    $num = mysqli_num_rows($run);
                    if($num > 0){
                        $i = 0;
                        while($fetch = mysqli_fetch_assoc($run)){
                            $progressionid = $fetch['progressionid'];
                            $Date = $fetch['date'];
                            $Service = $fetch['service'];
                            $Remarks = $fetch['remarks'];
                            $popup_id = "form-popup-" . $PetID . "-" . $i; // generate unique popup id
                        ?>
                            <tr>
                                <td><?php echo $Date; ?></td>
                                <td><?php echo $Service; ?></td>
                                <td><?php echo $Remarks; ?></td>
                                <td><button class="View-Btn" data-popup="<?php echo $popup_id ?>">Update Remarks</button></td>
                            </tr>

                            <section class="form-container" id="<?php echo $popup_id ?>">
                                <div class="form-wrapper">
                                    <header>
                                        <span class="close-btn" data-popup="<?php echo $popup_id ?>">&times;</span>
                                        Update Progression Details
                                    </header>
                                    <form action="" class="form" method="POST" name="ProgressionForm" onsubmit="return Validate();">
                                        <div class="form-input-details">
                                            <label for="">Date and Time</label>
                                            <input type="text" name="progressionid" hidden value="<?php echo $progressionid ?>">
                                            <input type="text" name="PetID" hidden value="<?php echo $PetID ?>">
                                            <input type="text" name="Date" value="<?php echo $Date ?>" required readonly>
                                        </div>
                                        <div class="form-input-details">
                                            <label for="">Service</label>
                                            <input type="text" name="Service" value="<?php echo $Service ?>" required readonly>
                                        </div>
                                        <div class="form-input-details">
                                            <label for="">Remarks</label>
                                            <input type="text" name="Remarks" value="<?php echo $Remarks ?>" required >
                                        </div>
                                        <div class="form-btn-details">
                                            <button type="submit" style="float:left; width: 45%" name="Update">Update</button>
                                            <button type="submit" style="float:right; width: 45%" name="Delete">Delete</button>

                                        </div>
                                    </form>
                                </div>
                            </section>
                        <?php 
                            $i++; //increase 1 using while loop
                        }                         
                    }
                ?>
                </tbody>
            </table>
        </div>

        <script>
            function showPopup(id) {
                var popup = document.getElementById("form-popup-" + id);
                popup.classList.add("active");
            }
            // ViewBtn
            const formContainer = document.querySelector(".form-container");
            const viewBtns = document.querySelectorAll(".View-Btn");
            viewBtns.forEach((btn) => {
                btn.addEventListener("click", (e) => {
                    e.preventDefault();
                    const popupId = btn.getAttribute("data-popup");
                    const popup = document.getElementById(popupId);
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