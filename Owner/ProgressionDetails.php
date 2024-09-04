<?php 
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_owner'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='../Staff/login.php';</script>";
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
                echo 'DONE DONE DONE DONE';
            }else{
                echo 'Something Error';

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
                            $Date = $fetch['date'];
                            $Service = $fetch['service'];
                            $Remarks = $fetch['remarks'];
                            $popup_id = "form-popup-" . $PetID . "-" . $i; // generate unique popup id
                        ?>
                            <tr>
                                <td><?php echo $Date; ?></td>
                                <td><?php echo $Service; ?></td>
                                <td><?php echo $Remarks; ?></td>
                            </tr>

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