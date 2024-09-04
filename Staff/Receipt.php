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
    <title>Receipt</title>
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
            <h1>Receipt</h1>
        </div>
        

    <div class="btn-container">
        <div class="right-top-button">
            <a href="ViewPayment.php"><button>Back</button></a>
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
                    <tr>
                        <th>Payment ID</th>
                        <th>Pet ID</th>
                        <th>Pet Name</th>
                        <th>Price</th>
                        <th>Payment Method</th>

                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $paymentid = $_GET['paymentid'];

                        $sql = "SELECT * FROM payment Where paymentid = '$paymentid'";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $paymentid = $row['paymentid'];
                            $PetID = $row['petid'];
                            $amount = $row['amount'];
                            $paymentmethod = $row['paymentmethod'];

                            $SQL = "SELECT petname from pet where petid = '$PetID';";
                            $run = mysqli_query($con,$SQL);
                            $get = mysqli_fetch_assoc($run);
                            $petname = $get['petname'];

                    ?>
                        <tr>
                            <td><?php echo $paymentid; ?></td>
                            <td><?php echo $PetID; ?></td>
                            <td><?php echo $petname; ?></td>
                            <td><?php echo $amount; ?></td>
                            <td><?php echo $paymentmethod; ?></td>
                        </tr>
                    <?php } ?>
    
                </tbody>
            </table>
        </div>
    </section>
</body>
</html>