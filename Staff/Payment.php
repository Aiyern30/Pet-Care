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
            date_default_timezone_set('Asia/Kuala_Lumpur');
            $today_date = date('Y-m-d');

            if(isset($_POST['Submit'])){
                $PetID = $_POST['PetID']??null;
                $Amount = $_POST['Amount'];
                $Payment = $_POST['Payment']??null;

                if(!empty($PetID)&&!empty($Payment)){
                    if($Amount == 0){
                        echo '<section><div class="alert">
                            <strong>No purchase history exist!</strong>
                        </div></section>';
                    }else{
                        $SQL = "INSERT INTO payment (petid, amount, paymentmethod, date) VALUES ('$PetID','$Amount','$Payment','$today_date')";
                        $run = mysqli_query($con,$SQL);
                        if($run){
                            echo '<section><div class="success">
                                <strong>Insert Successfull!</strong>
                            </div></section>';

                            $scheduleSQL = "SELECT scheduleid from schedule where petid='$PetID'";
                            $scheduleResult = mysqli_query($con, $scheduleSQL);

                            if ($scheduleResult && mysqli_num_rows($scheduleResult) > 0) {
                                while ($scheduleRow = mysqli_fetch_assoc($scheduleResult)) {
                                    $scheduleID = $scheduleRow['scheduleid'];

                                    // Update the payment_status in the schedule table for each schedule ID
                                    $updatePaymentStatus = "UPDATE schedule SET status = TRUE WHERE scheduleid = $scheduleID";
                                    mysqli_query($con, $updatePaymentStatus);
                                }
                            } else {
                                echo '<section><div class="alert">
                                    <strong>No schedule found for Pet ID: '.$PetID.'</strong>
                                </div></section>';
                            }
                        }else{
                            echo '<section><div class="alert">
                                <strong>Something Error!</strong>
                            </div></section>';
                        }
                    }
                }else if(empty($PetID)){
                    echo '<section><div class="alert">
                        <strong>Please select the Pet Name!</strong>
                    </div></section>';
                }
                else if(empty($Payment)){
                    echo '<section><div class="alert">
                        <strong>Please select Payment Method!</strong>
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
    <title>Make Payment</title>
    <link rel="stylesheet" href="../assets/css/staff/staffstyle.css">
    <link rel="stylesheet" href="../assets/css/staff/form.css">
    <link rel="stylesheet" href="../assets/css/staff/popup.css">
    <link rel="stylesheet" href="../assets/css/staff/table.css">
    <style>
        .form-input-details table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            border: 1px solid #b3d7ff;
            border-radius: 6px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.604);
        }

        .form-input-details th,
        .form-input-details td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #b3d7ff;
        }

        .form-input-details th {
            background-color: #b3d7ff;
            color: #fff;
        }
        .form-input-details th:not(:last-child),
        .form-input-details td:not(:last-child) {
            border-right: 1px solid #b3d7ff;
        }
    </style>
</head>

<body>
    <div class="btn-container">
        <div class="right-top-button">
            <a href="ViewPayment.php"><button>View Payment Table</button></a>
        </div>
    </div>
    <?php 
        include 'sidebar.php';
    ?>
        <script>
            function selectPetID(){
                var petSelect = document.getElementById("myDropdown");
                var petid = petSelect.value;
                var petName = petSelect.options[petSelect.selectedIndex].text;

                var urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has("petid")){
                    urlParams.delete("petid");
                }
                window.location.href = "Payment.php?petid=" + petid;
            }
        </script>

    <section class="form-container">
        <div class="form-wrapper">
            <header>Payment</header>
            <form action="Payment.php" name="PaymentForm" class="form" method="post">
                <div class="form-input-details">
                <label for="">Pet Name</label>
                    <div class="form-split">
                        <div class="select-box">
                            <select name="PetID" id="myDropdown" onchange="selectPetID()">
                                <option selected disabled>Select Pet</option>
                                <?php
                                    $selected_petid = isset($_GET['petid']) ? $_GET['petid'] : null;
                                    $pet_sql = "SELECT * from pet";
                                    $pet_result = mysqli_query($con, $pet_sql);
                                    while($row = mysqli_fetch_assoc($pet_result)){
                                        $petid = $row['petid'];
                                        $petname = $row['petname'];
                                        $selected = ($selected_petid == $petid) ? 'selected' : '';
                                        echo '<option value="'.$petid.'" '.$selected.'>'.$petname.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-input-details">
                    <label for="">Payment Details</label>
                    <table>
                        <tr>
                            <th>Service Name</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                        <?php
                        $get_petid = $_GET['petid']??null;
                        $table_sql = "SELECT subservice.subname, schedule.date, schedule.time, schedule.S_Date, schedule.E_Date from schedule join subservice on schedule.subserviceid = subservice.subserviceid where petid='".$get_petid."' AND schedule.status= FALSE";
                        $table_result = mysqli_query($con, $table_sql);
                        while ($row = mysqli_fetch_assoc($table_result)){
                            echo "<tr>";
                            echo "<td>" . $row['subname'] . "</td>";
                            echo "<td>" . ($row['date']??'-') . "</td>";
                            echo "<td>" . ($row['time']??'-') . "</td>";
                            echo "<td>" . ($row['S_Date']??'-') . "</td>";
                            echo "<td>" . ($row['E_Date']??'-') . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </table>
                </div>

                <?php
                $amount_sql = "SELECT SUM(subservice.price * schedule.duration) AS total_price FROM schedule JOIN subservice ON subservice.subserviceid = schedule.subserviceid WHERE schedule.petid = '".$get_petid."' AND schedule.duration IS NOT NULL AND schedule.status = FALSE";
                $amount_result = mysqli_query($con, $amount_sql);
                
                $total_Amount = 0;
                if ($amount_result && mysqli_num_rows($amount_result) > 0) {
                    $row = mysqli_fetch_assoc($amount_result);
                    $total_Amount += $row['total_price'];
                }
                
                $amount_sql = "SELECT SUM(subservice.price) AS total_price FROM schedule JOIN subservice ON subservice.subserviceid = schedule.subserviceid WHERE schedule.petid = '".$get_petid."' AND schedule.duration IS NULL AND schedule.status = FALSE";
                $amount_result = mysqli_query($con, $amount_sql);
                
                if ($amount_result && mysqli_num_rows($amount_result) > 0) {
                    $row = mysqli_fetch_assoc($amount_result);
                    $total_Amount += $row['total_price'];
                }
                
                echo '<div class="form-input-details">';
                echo '<label for="Amount">Amount</label>';
                echo '<input type="number" name="Amount" placeholder="Amount" value="'.number_format($total_Amount, 2, '.', '').'" readonly>';
                echo '</div>';
                ?>
                <!-- <div class="form-input-details">
                    <label for="">Amount</label>
                    <input type="number" name="Amount" placeholder="Amount" value="<?php echo $total_Amount ?>" readonly>

                </div> -->

                <div class="form-input-details">
                    <label for="">Payment Method</label>
                        <div class="form-split">
                            <div class="select-box">
                                <select name="Payment" >
                                    <option selected disabled>Select payment method</option>
                                    <option value="Cash">Cash</option>
                                    <option value="Online Transfer">Online Transfer</option>
                                    <option value="Credit Card/Debit Card">Credit Card/Debit Card</option>
                                    <option value="E-wallet">E-wallet</option>
                                </select>
                            </div>
                        </div>
                </div>
                
                    <div class="form-btn-details">
                        <button style="float:left; width:45%" type="button" onclick="window.location.href='Staffhomepage.php';">Back</button>
                        <button type="submit" style="float:right;width:45%" name="Submit">Submit</button>
                    </div>
            </form>
        </div>

        
    </section>
    <section>
    <div class="table" id="table">
            <table class="content-table" >
                <thead>
                    <tr>
                        <th>SubserviceID</th>
                        <th>Subname</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                        $sql = "SELECT * FROM subservice ORDER BY subserviceid ASC";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) {
                            $subserviceid = $row['subserviceid'];
                            $subname = $row['subname'];
                            $price = $row['price'];
                    ?>
                        <tr>
                            <td><?php echo $subserviceid; ?></td>
                            <td><?php echo $subname; ?></td>
                            <td><?php echo $price; ?></td>
                        </tr>
                        
                    <?php } ?>
    
                    
                </tbody>
            </table>
        </div>
    
    </section>
    
        
</body>
</html>