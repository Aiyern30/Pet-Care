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
    <title>Pet Details Page</title>
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
    include 'sidebar.php';
    ?>
    <section>
        <div class="home-title">
            <h1>Pet Details</h1>
        </div>

        <div class="btn-container">
            <div class="right-top-button">
                <a href="petregister.php"><button>+ Create +</button></a>
            </div>
        </div>
        
    
        <div class="table">
            <table class="content-table">
                <thead>
                    <tr>
                        <th>Pet ID</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Dob</th>
                        <th>Gender</th>
                        <th>Description</th>
                        <th>IC Number</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_POST['update'])){
                        $PetID = $_POST['Petid'];
                        $Petname = $_POST['Petname'];
                        $DOB = $_POST['DOB'];
                        $Description = $_POST['Description'];
                     
                            $sql = "UPDATE pet SET petname = '$Petname',  dob = '$DOB', description = '$Description' where petid = '$PetID';";
                            $update = mysqli_query($con, $sql);
                            If($update){
                        echo '<div class="success">
                            <strong>Alert!</strong> Successfully update!!
                        </div>';
                            } else {
                                echo '<div class="alert">
                            <strong>Alert!</strong> Something error!
                        </div>';
                            }
                    
                    }
                         
                    if(isset($_POST['delete'])){
                        $PetID = $_POST['Petid'];
                     
                            $SQL = "DELETE FROM pet where petid = '$PetID'";
                            $delete = mysqli_query($con, $SQL);
                            If($delete){
                        echo '<div class="success">
                            <strong>Alert!</strong> Successfully delete!!
                        </div>';
                            } else {
                                echo '<div class="alert">
                            <strong>Alert!</strong> Something error!
                        </div>';
                            }
                    }
                     
                    ?>
                <?php
                    $sql = "SELECT * FROM pet";
                    $run = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_assoc($run)) {
                        $PetID = $row['petid'];
                        $Name = $row['petname'];
                        $Type = $row['type'];
                        $DOB = $row['dob'];
                        $Gender = $row['gender'];
                        $Description = $row['description'];
                        $NoIC = $row['noic'];

                        ?>
                        <tr>
                            <td><?php echo $PetID; ?></td>
                            <td><?php echo $Name; ?></td>
                            <td><?php echo $Type; ?></td>
                            <td><?php echo $DOB; ?></td>
                            <td><?php echo $Gender; ?></td>
                            <td><?php echo $Description; ?></td>
                            <td><?php echo $NoIC; ?></td>
                            <td><button class="View-Btn" onclick="showPopup(<?php echo $PetID ?>)">View</button></td>
                        </tr>
                        <script>
                            function validateForm(PetID){
                                var Petname = document.PetForm[PetID]["Petname"].value;
                                var Description = document.PetForm[PetID]["Description"].value;

                                if (Petname.length > 50) {
                                    alert("Pet name is too long!");
                                    return false;
                                } else if (description.length > 250) {
                                    alert("Description is too long!");
                                    return false;
                                }
                            }
                        </script>
                        <section class="form-container" id="form-popup-<?php echo $PetID ?>">
                            <div class="form-wrapper">
                                <header>
                                    <span class="close-btn" data-popup="#form-popup-<?php echo $PetID ?>">&times;</span>
                                    View Pet Details
                                </header>
                                <form action="PetDetails.php"  class="form" method="post" enctype="multipart/form-data" name="PetForm" onsubmit="return validateForm('Form<?php echo $PetID ?>')">
                                    <div class="form-split">
                                        <div class="form-input-details">
                                            <label for="">Pet ID</label>
                                            <input type="text" name="Petid" placeholder="Pet ID" value="<?php echo $PetID ?>" required readonly>
                                        </div>
                                        <div class="form-input-details">
                                            <label for="">Pet Name</label>
                                            <input type="text" name="Petname" placeholder="Pet Name" value="<?php echo $Name ?>" required>
                                        </div>
                                    </div>

                                    <div class="form-input-details">
                                        <label for="">Date Of Birth</label>
                                        <input type="date" name="DOB" placeholder="Date of birth" value="<?php  echo $DOB ?>" required>
                                    </div>
                                    <div class="form-input-details">
                                        <label for="">Description</label>
                                        <input type="text" name="Description" placeholder="Description" value="<?php  echo $Description ?>" >
                                    </div>

                                    <!-- <div class="form-split">
                                        <div class="gender-box">
                                            <h3>Type</h3>
                                            <div class="gender-option">
                                                <div class="gender">
                                                    <input type="radio" id="Dog"  name="Type" value="Dog" checked>
                                                    <label for="Dog">Dog</label>
                                                </div>
                                                <div class="gender">
                                                    <input type="radio" id="Cat" name="Type" value="Cat" checked>
                                                    <label for="Cat">Cat</label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    
                                        <div class="gender-box">
                                            <h3>Gender</h3>
                                                <div class="gender-option">
                                                    <div class="gender">
                                                        <input type="radio" id="Male" name="Gender" value="Male" checked>
                                                        <label for="Male">Male</label>
                                                    </div>
                                                    <div class="gender">
                                                        <input type="radio" id="Female" name="Gender" value="Female" checked>
                                                        <label for="Female">Female</label>
                                                    </div>
                                                    
                                                </div>
                                        </div>
                                    </div> -->
                                    <div class="form-split">
                                        <div class="form-input-details">
                                            <label for="">Owner's IC Number</label>
                                            <input type="text" placeholder="IC Number" value="<?php echo $NoIC ?>" required readonly >
                                        </div>
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
            const PetID = btn.dataset.id;
            const popup = document.getElementById(`form-popup-${PetID}`);
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