<?php
include '../Customer/condb.php';

session_start();

if (!isset($_SESSION['noic_owner'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='../Staff/login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance</title>
    <link rel="stylesheet" href="../assets/css/owner/Owner.css">
    <link rel="stylesheet" href="../assets/css/owner/table.css">
    <link rel="stylesheet" href="../assets/css/owner/Finance.css">
    
</head>

<body>
    <section>
        <?php 
        include 'Sidebar.php';
        ?>
    <div class="home-title">
        <h1>Finance Report</h1>
    </div> 
    <div class="table" id="table">
    <table class="content-table">
        <thead>
            <tr>
                <th>Month</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Initialize an array to store the monthly totals
            $monthly_totals = array(
                '01' => 6000,
                '02' => 7000,
                '03' => 6500,
                '04' => 4250,
                '05' => 0,
                '06' => 0,
                '07' => 0,
                '08' => 0,
                '09' => 0,
                '10' => 0,
                '11' => 0,
                '12' => 0
            );

            // Fetch payment data from the database
            $sql = "SELECT * FROM payment";
            $run = mysqli_query($con, $sql);

            while ($row = mysqli_fetch_assoc($run)) {
                $amount = $row['amount'];
                $payment_date = $row['date'];
                $month = date('m', strtotime($payment_date));

                // Increment the total price for the corresponding month
                $monthly_totals[$month] += $amount;
            }

            // Loop through the monthly_totals array to display the data in the table
            foreach ($monthly_totals as $month => $total_price) {
                $month_name = date("F", mktime(0, 0, 0, $month, 1));
                echo "<tr>";
                echo "<td>" . $month_name . "</td>";
                echo "<td>" . $total_price . "</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
    </table>
</div>

<div class="chart-container">
    <div class="chart">
        <h1>Bar Chart</h1>
        <canvas id="barchart" width="400" height="400"></canvas>
    </div>
    <div class="chart">
        <h1>Pie Chart</h1>
        <canvas id="doughnut" width="400" height="400"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('barchart').getContext('2d');
    const barchart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Monthly Earning',
                data: [
                    <?php echo $monthly_totals['01']; ?>,
                    <?php echo $monthly_totals['02']; ?>,
                    <?php echo $monthly_totals['03']; ?>,
                    <?php echo $monthly_totals['04']; ?>,
                    <?php echo $monthly_totals['05']; ?>,
                    <?php echo $monthly_totals['06']; ?>,
                    <?php echo $monthly_totals['07']; ?>,
                    <?php echo $monthly_totals['08']; ?>,
                    <?php echo $monthly_totals['09']; ?>,
                    <?php echo $monthly_totals['10']; ?>,
                    <?php echo $monthly_totals['11']; ?>,
                    <?php echo $monthly_totals['12']; ?>
                ],
                borderWidth: 2,
                backgroundColor: [
                    'rgba(255, 120, 150)',
                    'rgba(120, 200, 255)',
                    'rgba(255, 225, 120)',
                    'rgba(180, 255, 120)',
                    'rgba(200, 150, 255)',
                    'rgba(255, 180, 120)',
                    'rgba(102,51,153)',
                    'Teal',
                    'rgba(128, 128, 0)',
                    'rgba(204, 85, 0)',
                    'rgba(153, 0, 0)',
                    'rgba(70, 130, 180)'
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    labels: {
                        color: 'black'
                    }
                },
                title: {
                    color: 'black'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: 'black'
                    }
                },
                x: {
                    ticks: {
                        color: 'black'
                    }
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    left: 10,
                    right: 10,
                    top: 10,
                    bottom: 10
                }
            }
        }
    });
</script>
<script>
  const ctx2 = document.getElementById('doughnut').getContext('2d');
  const doughnut = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'April', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
      datasets: [{
        label: 'Monthly Earning',
        data: [
          <?php echo $monthly_totals['01']; ?>,
          <?php echo $monthly_totals['02']; ?>,
          <?php echo $monthly_totals['03']; ?>,
          <?php echo $monthly_totals['04']; ?>,
          <?php echo $monthly_totals['05']; ?>,
          <?php echo $monthly_totals['06']; ?>,
          <?php echo $monthly_totals['07']; ?>,
          <?php echo $monthly_totals['08']; ?>,
          <?php echo $monthly_totals['09']; ?>,
          <?php echo $monthly_totals['10']; ?>,
          <?php echo $monthly_totals['11']; ?>,
          <?php echo $monthly_totals['12']; ?>
        ],
        borderWidth: 2,
        backgroundColor: [
          'rgba(255, 120, 150)',
          'rgba(120, 200, 255)',
          'rgba(255, 225, 120)',
          'rgba(180, 255, 120)',
          'rgba(200, 150, 255)',
          'rgba(255, 180, 120)',
          'rgba(102,51,153)',
          'Teal',
          'rgba(128, 128, 0)',
          'rgba(204, 85, 0)',
          'rgba(153, 0, 0)',
          'rgba(70, 130, 180)'
        ]
      }]
    },
    options: {
      plugins: {
        legend: {
          labels: {
            color: 'black'
          }
        },
        title: {
          color: 'black'
        }
      },
      responsive: true,
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 10,
          top: 10,
          bottom: 10
        }
      }
    }
  });
</script>

    </section>
</body>
</html>