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
    <title>Payment Management</title>
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
            <h1>Payment</h1>
        </div>
        

    <div class="btn-container">
        <div class="right-top-button">
            <a href="Payment.php"><button>Back</button></a>
        </div>
    </div>
        
        <div class="table" id="table">
            <table class="content-table" >
                <thead>
                    <tr>
                        <th>Payment ID</th>
                        <th>Pet ID</th>
                        <th>Pet Name</th>
                        <th>Price</th>
                        <th>Payment Method</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM payment ORDER BY paymentid DESC";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $paymentid = $row['paymentid'];
                            $PetID = $row['petid'];
                            $amount = $row['amount'];
                            $paymentmethod = $row['paymentmethod'];
                            $Date = $row['date'];


                            $SQL = "SELECT petname from pet where petid = '$PetID';";
                            $runn = mysqli_query($con,$SQL);
                            $get = mysqli_fetch_assoc($runn);
                            $petname = $get['petname'];

                    ?>
                        <tr>
                            <td><?php echo $paymentid; ?></td>
                            <td><?php echo $PetID; ?></td>
                            <td><?php echo $petname; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $paymentmethod; ?></td>
                            <td><a href="Receipt.php?paymentid=<?php echo $paymentid ?>"><button class="View-Btn">View</button></a></td>
                        </tr>
                        
                    <?php } ?>
    
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>