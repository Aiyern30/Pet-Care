<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Hotel</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/pethotel.css">
</head>
<style>
    .cover{
        background-image: url(../assets/image/pet-hotel.jpg);
    }
</style>
<body>
    <?php 
    session_start();
    if(isset($_SESSION['noic'])){
        include 'homenav.php';
    }else{
        include 'guest_nav.php';
    }
    ?>
    <div class="cover">
        <h1> Pet Hotel</h1>
    </div>

<div class="hotel-con">
    <h1>Our Pet Hotel Offers</h1>
    <div class="hotel-row">
        <div class="hotel-description">
            <i class="fa solid fa-moon"></i>
            <h2>Overnight boarding</h2>
            <p>Pets are provided with comfortable and secure accommodations to stay in while their owners are away.</p>        
        </div>

        <div class="hotel-description">
        <i class="fa fa-bone"></i>
            <h2>Feeding and watering</h2>
            <p>Pet hotels typically provide food and water for pets, either using the owner's preferred brand or their own.</p>
        </div>

        <div class="hotel-description">
            <i class="fa regular fa-futbol"></i>
            <h2>Exercise and playtime</h2>
            <p>Pet hotels may have designated areas where pets can run around and play, either on their own or with other pets.</p>        
        </div>

        <div class="hotel-description">
        <i class="fa fa-cut"></i>
            <h2>Grooming services</h2>
            <p>Pet hotels offer grooming services such as bathing and brushing.</p>        
            </div>

        <div class="hotel-description">
        <i class="fa solid fa-briefcase-medical"></i>
            <h2>Medical care</h2>
            <p>Pet hotels have trained staff who can administer medication or provide other basic medical care for pets.</p>
        </div>

        <div class="hotel-description">
        <i class="fa fa-graduation-cap"></i>
            <h2>Training and obedience classes</h2>
            <p>Pet hotels offer training and obedience classes to help pets learn basic commands and socialize with other pets.</p>
        </div>

    </div>
</div>

    <div class="sec-pet">
        <table class="table-hotel">
        <thead>
            <tr>
            <th><h3>Room Type</h3></th>
            <th><h3>Room Size</h3></th>
            <th>
                <h3>Boarding Fee</h3>
                <p>(Per Dog / Per Room / Per Day)</p>
            </th>
            <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
            <td>Cozy Cottage </td>
            <td>
                <p>L 2.6ft x W 2.4ft x H 2ft</p>
                <p>L 0.79m x W 0.73m x H 0.61m</p>
            </td>
            <td>
                <p>RM 35</p>
                <p>Small breed below 10kg</p>     
            </td>
            <td>
                <div class="pet-btn-container">
                        <a href="bookpet.php?pet=Cozy Cottage"><button class="pet-btn" name="pet-BTN">Book Appointment</button></a>
                </div>
            </td>
            </tr>

            <tr>
            <td>Purrfect Pad </td>
            <td>
                <p>L 4ft x W 2.6ft x H 2.3ft</p>
                <p>L 1.22m x W 0.80m x H 0.70m</p>
            </td>
            <td>
                <p>RM 40</p>
                <p>Small breed below 10kg</p>     
            </td>
            <td>
                <div class="pet-btn-container">
                        <a href="bookpet.php?pet=Purrfect Pad"><button class="pet-btn" name="pet-BTN">Book Appointment</button></a>
                </div>
            </td>
            </tr>

            <tr>
            <td>Grand Suite</td>
            <td>
                <p>L 4ft x W 3ft x H 3ft</p>
                <p>L 1.22m x W 0.91m x H 0.97m</p>
            </td>
            <td>
                <p>RM 55</p>
                <p>Medium breed above 10kg</p>
            </td>
            <td>
                <div class="pet-btn-container">
                        <a href="bookpet.php?pet=Grand Suite"><button class="pet-btn" name="pet-BTN">Book Appointment</button></a>
                </div>
            </td>
            </tr>

            <tr>
            <td>Royal Retreat</td>
            <td>
                <p>L 5.3ft x W 3ft x H 3.2ft</p>
                <p>L 1.62m x W 0.91m x H 0.98m</p>
            </td>
            <td>
                <p>RM 75</p>
                <p>Medium breed above 10kg</p>
            </td>
            <td>
                <div class="pet-btn-container">
                        <a href="bookpet.php?pet=Royal Retreat"><button class="pet-btn" name="pet-BTN">Book Appointment</button></a>
                </div>
            </td>
            </tr>
            
        </tbody>
        
    </table>
        
    </div>
</body>
</html>