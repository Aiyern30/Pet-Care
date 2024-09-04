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
    <title>Progression</title>
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

        .search-input {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
            width: 200px;
        }

      
    </style>
<body>
    <?php 
        include 'Sidebar.php';
    ?>
    <section>
    <div class="home-title">
        <h1>Progression Details</h1>
    </div>
        <div class="btn-container">
        <div class="right-top-button">
            <input type="text" id="searchInput" class="search-input" placeholder="Search by Pet Name">
        </div>
    </div>
    <div class="table">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Pet ID</th>
                    <th>Pet Name</th>
                    <th>Pet Type</th>
                    <th>DOB</th>
                    <th>Gender</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM pet ORDER BY petid ASC";
                $run = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_assoc($run)) {
                    $PetID = $row['petid'];
                    $Petname = $row['petname'];
                    $Type = $row['type'];
                    $DOB = $row['dob'];
                    $Gender = $row['gender'];
                ?>
                    <tr class="pet-row">
                        <td><?php echo $PetID; ?></td>
                        <td><?php echo $Petname; ?></td>
                        <td><?php echo $Type; ?></td>
                        <td><?php echo $DOB; ?></td>
                        <td><?php echo $Gender; ?></td>
                        <td><a href="ProgressionDetails.php?petid=<?php echo $PetID ?>&petname=<?php echo $Petname ?>"><button class="View-Btn">View</button></a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const petRows = document.querySelectorAll('.pet-row');

        searchInput.addEventListener('input', function () {
            const searchValue = this.value.toLowerCase();
            petRows.forEach(function (row) {
                const petName = row.children[1].textContent.toLowerCase();
                if (petName.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>



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