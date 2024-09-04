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

                        $sql = "SELECT * from pet where petid = '$PetID';";
                        $run = mysqli_query($con,$sql);
                        while($show = mysqli_fetch_assoc($run)){
                        $PetID = $show['petid'];
                        $Petname = $show['petname'];
                        }
                    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Schedule</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
</head>

<body>
    <?php 
        include 'Sidebar.php';
    ?>
    
    <section>
    <div class="home-title">
        <h1>Pet Schedule</h1>
    </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="ProgressionDetails.php?petid=<?php echo $PetID ?>&petname=<?php echo $Petname ?>"><button> Back</button></a>
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
                        <th>Service Name</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Duration</th>
                        <!-- <th>Update</th> -->
                    </tr>
                </thead>
                <tbody>
                <?php
                    $SQL = "SELECT * from schedule where petid = '$PetID';";
                    $run = mysqli_query($con,$SQL);
                    $num = mysqli_num_rows($run);
                    if($num > 0){
                        while($fetch = mysqli_fetch_assoc($run)){
                            $Date = $fetch['date'];
                            $Time = $fetch['time'];
                            $S_Date = $fetch['S_Date'];
                            $E_Date = $fetch['E_Date'];
                            $Duration = $fetch['Duration'];
                            $subserviceid = $fetch['subserviceid'];

                            $SQL = "SELECT subname FROM subservice where subserviceid = '$subserviceid';";
                            $getdata = mysqli_query($con,$SQL);
                            $GET = mysqli_fetch_assoc($getdata);
                            $subname = $GET['subname'];

                        ?>
                            <tr>
                                <td><?php echo $subname; ?></td>
                                <td><?php echo $Date; ?></td>
                                <td><?php echo $Time; ?></td>
                                <td><?php echo $S_Date; ?></td>
                                <td><?php echo $E_Date; ?></td>
                                <td><?php echo $Duration; ?></td>
                            </tr>

                        <?php 
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