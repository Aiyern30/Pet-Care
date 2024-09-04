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
    <title>Schedule Management</title>
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
            <h1>Schedule</h1>
        </div>
        
        <div class="btn-container">
            <div class="right-top-button">
                <a href="create_schedule.php"><button>Create schedule</button></a>
            </div>
        </div>
        <div class="table" id="table">
    <table class="content-table">
        <thead>
            <tr>
                <th>Schedule ID</th>
                <th>petid</th>
                <th>Date</th>
                <th>Time</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Duration</th>
                <th>serviceid</th>
                <th>subserviceid</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_POST['delete'])) {
                $deleteScheduleId = $_POST['scheduleid'];
                $deleteSql = "DELETE FROM schedule WHERE scheduleid = ?";
                $stmt = mysqli_prepare($con, $deleteSql);
                mysqli_stmt_bind_param($stmt, "i", $deleteScheduleId);
                $deleteResult = mysqli_stmt_execute($stmt);
                
                if ($deleteResult) {
                    echo "<script>alert('Delete Successful');</script>";
                } else {
                    echo "Error deleting row with Schedule ID $deleteScheduleId.";
                }
                mysqli_stmt_close($stmt);
            }

            $sql = "SELECT * FROM schedule ORDER BY scheduleid DESC";
            $run = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($run)) {
                $scheduleid = $row['scheduleid'];
                $date = $row['date'];
                $time = $row['time'];
                $S_Date = $row['S_Date'];
                $E_Date = $row['E_Date'];
                $Duration = $row['Duration'];
                $serviceid = $row['serviceid'];
                $subserviceid = $row['subserviceid'];
                $petid = $row['petid'];
            ?>
                <tr>
                    <td><?php echo $scheduleid; ?></td>
                    <td><?php echo $petid; ?></td>
                    <td><?php echo $date; ?></td>
                    <td><?php echo $time; ?></td>
                    <td><?php echo $S_Date; ?></td>
                    <td><?php echo $E_Date; ?></td>
                    <td><?php echo $Duration; ?></td>
                    <td><?php echo $serviceid; ?></td>
                    <td><?php echo $subserviceid; ?></td>
                    <td>
                        <form action="" method="POST" onsubmit="return confirmDelete(event);">
                            <input type="hidden" name="scheduleid" value="<?php echo $scheduleid; ?>">
                            <button class="View-Btn" type="submit" name="delete">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function confirmDelete(event) {
        if (!confirm('Are you sure you want to delete this row?')) {
            event.preventDefault();
            return false;
        }
        return true;
    }
</script>




    </section>
</body>
</html>