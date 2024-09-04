<?php 
include 'condb.php';
session_start(); 
// if (!isset($_SESSION['noic'])){
//     echo "<script>alert('Please login first!');</script>";
//     echo "<script>window.location.href='login.php';</script>";
//     exit();
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous"></script>
</head>

<style>
    
</style>
<body>
    <?php 
    if(isset($_SESSION['noic'])){
        include 'homenav.php';
    ?>
        <div class="buttons-container">
            <div class="PetBtn1">
                    <select class="PetDropdown" id="petSelect"  onchange="if (this.value === 'addpet') window.location.href = 'pet_register.php';">
                    <?php 
                        $sql = "SELECT * from pet where noic = '".$_SESSION['noic']."'";
                        $result = mysqli_query($con,$sql);
                        $num = mysqli_num_rows($result);
                        echo '<option selected disabled value="">Select</option>';
                        while($row = mysqli_fetch_assoc($result)){
                            $petname = $row['petname'];
                            $petid = $row['petid'];
                            echo '<option value="'.$petid.'">'.$petname.'</option>';   
                        }
                        echo '<option value="addpet">+ Add Pet +</option>';
                        // if($num == 0){
                        //     echo '<option value="">Select</option>
                        //         <option value="addpet">+ Add Pet +</option>';
                        // }
                    ?>
                </select>
                <a id="updateLink" href=""><button class="PetBtn" onclick="updateProfile()">Update Profile</button></a>
            </div>
        </div>
    <?php
    }else{
        include 'guest_nav.php';
        if(!isset($_SESSION['guest_mode_alert'])){
            echo "<script>alert('You are in guest mode now!')</script>";
            $_SESSION['guest_mode_alert'] = true;
        }
    ?>
        <div class="buttons-container">
            <div class="PetBtn1">
                <a href="login.php"><button class="PetBtn" style="width:100px;">Login</button></a>
                <a href="signup.php"><button class="PetBtn" style="width:100px;">Sign up</button></a>
            </div>
        </div>
    <?php
    }
    ?>

        <script>
            function updateProfile() {
                var petSelect = document.getElementById("petSelect");
                var selectedPet = petSelect.value;
                
                if (!selectedPet) {
                    alert("Please select a pet name.");
                } else {
                    var updateLink = document.getElementById("updateLink");
                    updateLink.href = "updateprofile.php?update=" + selectedPet;
                }
            }
        </script>

    <div class="section">
        
    </div>
<style>
    .cover{
        background-image: url(../assets/image/pexels-helena-lopes-1904103.jpg);
    }
</style>
    <div class="cover">
        <h1>Established & Trusted Pet Care Service</h1>
    </div>

    <div class="service-section">
        <div class="services-title">
            <h1>Our Pet Care Services</h1>
        </div>
        <div class="services">
            <div class="services-card">
                <div class="services-icon">
                    <i class="fa fa-heartbeat"></i>
                </div>
                <h2>Veterinary Clinic</h2>
            <p>Veterinarians who work in veterinary clinics are trained medical professionals who specialize in animal health and welfare. They are responsible for diagnosing illnesses, treating injuries, and providing medical care to ensure the overall health and well-being of animals.</p>                
            <a href="clinic.php" class="button">Read More</a>
            </div>

            <div class="services-card">
                <div class="services-icon">
                    <i class="fas fa-bath"></i>
                </div>
                <h2>Grooming</h2>
                <p> Regular grooming is essential for the overall health and wellbeing of pets as it can help prevent infections, skin issues, and other health problems. In addition, grooming can help to strengthen the bond between pets and their owners, and also ensure that pets look and feel their best.</p>
                <a href="grooming.php" class="button">Read More</a>
            </div>

            <div class="services-card">
                <div class="services-icon">
                <i class="fas fa-hotel"></i>
                </div>
                <h2>Pet Hotel</h2>
                <p> Pet hotels are a popular option for pet owners who need to travel and cannot take their pets with them, or for those who simply want to provide their pets with a fun and safe environment while they are away. Pet hotels also offer daycare services for pets whose owners work during the day.</p>
                <a href="pethotel.php" class="button">Read More</a>
            </div>
        </div>
    </div>


        

    <div class="section2">
        <h1>Your furry friend deserves some extra care and attention!</h1>
        <div class="section2-details">
            <div class="one-third">
                <div class="home-box">
                <p>
                <i class="fas fa-clock"></i>
                    Save time on transportation by bringing your pet to us.
                </p>
                </div>
            </div>
            <div class="one-third">
                <div class="home-box">
                    <p>
                    <i class="fas fa-paint-brush"></i>
                        Enjoy a fur-free, hassle-free grooming experience.
                    </p>
                </div>
            </div>
            <div class="one-third">
                <div class="home-box">
                    <p>
                    <i class="fas fa-virus"></i>
                        Keep your pet safe from potential illnesses or infections.
                    </p>
                </div>
            </div>
        </div>   
        <div class="section2-details">
            <div class="one-half">
                <div class="home-box">
                    <p>
                    <i class="fas fa-dog"></i>
                        Give your pet the freedom to move around and avoid long periods of confinement
                    </p>
                </div>
            </div>
            <div class="one-half">
                <div class="home-box">
                    <p>
                    <i class="fas fa-video-camera"></i>
                        Watch our grooming experts take great care of your beloved pet in real time.
                    </p>
                </div>
            </div>
        
            <div class="section2-btn">
                <a href="grooming.php"><button>Book an Appointment</button></a>
            </div>
        </div>
    </div>

    <div class="section3">
        <h1>Our Glamorous Customers</h1>
        <div class="section3-container">
            <div class="section3-img">
                    <img src="../assets/image/glamorous1.jpg" alt="">
                </div>
                <div class="section3-img">
                    <img src="../assets/image/glamorous2.jpg" alt="">
                </div>
                <div class="section3-img">
                    <img src="../assets/image/glamorous3.jpeg" alt="">
                </div>
                <div class="section3-img">
                    <img src="../assets/image/glamorous4.jpeg" alt="">
                </div>
                <div class="section3-img">
                    <img src="../assets/image/glamorous5.jpg" alt=""> 
                </div>
        </div>    
    </div>  
    <div class="section5">
    <div class="slidershow middle">
        <div class="slides">
            <input type="radio" name="r" id="r1" checked>
            <input type="radio" name="r" id="r2">
            <input type="radio" name="r" id="r3" >
            <input type="radio" name="r" id="r4" >
            <input type="radio" name="r" id="r5" >
            <div class="slide s1">
                <a href="Grooming.php"><img src="../assets/image/clinic1.jpg" alt="Click me"></a> 
            </div>
            <div class="slide">
                <a href="pethotel.php"><img src="../assets/image/pet-hotel.jpg" alt="Click me"></a> 
            </div>
            <div class="slide">
            <a href="clinic.php"><img src="../assets/image/clinic.jpg" alt="Click me"></a> 
            </div>
            <div class="slide">
            <a href="clinic.php"><img src="../assets/image/Vaccinations.jpg" alt="Click me"></a> 
            </div>
            <div class="slide">
            <a href="clinic.php"><img src="../assets/image/Dental care.jpg" alt="Click me"></a> 
            </div>
        </div>
        <div class="navigation">
            <label for="r1" class="bar"></label>
            <label for="r2" class="bar"></label>
            <label for="r3" class="bar"></label>
            <label for="r4" class="bar"></label>
            <label for="r5" class="bar"></label>
        </div>
    </div>
    </div>

    <?php 
    include 'footer.php';
    ?>     
    
</body>
</html>