<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grooming</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/grooming.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>

<style>
    .cover{
            background-image: url('https://bonzabfs.com.au/wp-content/uploads/2020/09/shutterstock_333726335_6243-5f5072db15786.jpg');      
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
        <h1> Grooming</h1>
    </div>


<div class="grooming-con">
    <h1>Our Comprehensive Grooming Offerings</h1>
    <div class="grooming-row">
        
        <div class="grooming-description">
        <i class="fas fa-bath"></i>
            <h2>Hydrotherapy bath with blueberry-vanilla facial</h2>
            <p>Combines the therapeutic benefits of water with the soothing scents of blueberry and vanilla to leave your pet feeling relaxed and refreshed.</p>        
        </div>

        <div class="grooming-description">
        <i class="fas fa-wind"></i>
            <h2>Fluff drying and brush-out</h2>
            <p>High-velocity dryer and brushes to remove excess hair and create a fluffy, well-groomed appearance for your pet.</p>
        </div>

        <div class="grooming-description">
            <i class="fas fa-paw"></i>
            <h2>Nail trim </h2>
            <p>Grooming service that involves trimming a pet's nails to an appropriate length</p>        
        </div>

        <div class="grooming-description">
        <i class="fa sharp fa-light fa-ear-deaf"></i>
            <h2>Ear cleaning</h2>
            <p>Grooming service that involves the removal of dirt, debris, and excess wax from a pet's ears to promote their overall ear health and prevent infections.</p>        
            </div>

        <div class="grooming-description">
        <i class="fa fa-cut"></i>
            <h2>Breed-specific or customized haircut </h2>
            <p>Is designed to suit the unique needs and characteristics of a particular dog breed or to meet the individual preferences of the pet owner.</p>
        </div>

        <div class="grooming-description">
        <i class="fa thin fa-scissors fa-rotate-180"></i>
            <h2>Sanitary trim </h2>
            <p>Trimming the fur around a dog's genital and rectal areas to maintain cleanliness and hygiene.</p>
        </div>

    </div>
</div>

    <div class="grooming-service-container">
        <div class="grooming-service-cover">
            <div class="grooming-box">
                <img src="../assets/image/Diagnostic testing.jpg" alt="">
                <h2>BATH PACKAGE</h2>
                <p>Our dog spa provides a calming environment for your furry friend. We offer various drying methods to suit your dog's needs and use hypoallergenic products that are gentle on their skin and coat. Our spa attendants are trained to handle dogs of all sizes and breeds, ensuring your pup is comfortable during their treatment. Trust our experts to take care of your dog's nail trimming needs to avoid accidental injury.</p>
                    <ul>
                        <li>Hydrotherapy bath with blueberry-vanilla facial ( RM 80 )</li>
                        <li>Fluff drying and brush-out ( RM 40 )</li>
                        <li>Nail trim ( RM 20 )</li>
                        <li>Ear cleaning ( RM 20 )</li>
                    </ul>
            </div>

            <div class="grooming-box">
                <img src="../assets/image/Comprehensive physical exams.jpg" alt="">
                <h2>HAIRCUT PACKAGE</h2>
                <p>Our Haircut Package includes everything your furry friend needs to look and feel their best. They'll start off with a luxurious hydrotherapy bath complete with a blueberry-vanilla facial. Then, our expert groomers will give them a fluff dry and brush-out, followed by a nail trim to keep their paws healthy and tidy. And to top it off, they'll receive a breed-specific or customized haircut to suit their unique style. Your pup will leave our spa feeling refreshed and looking fabulous!</p>
                <ul>
                            <li>Hydrotherapy bath with blueberry-vanilla facial ( RM 80 )</li>
                            <li>Fluff drying and brush-out ( RM 40 )</li>
                            <li>Nail trim ( RM 20 )</li>
                            <li>Breed-specific or customized haircut ( RM 100 )</li>
                    </ul>
            </div>

            <div class="grooming-box">
                <img src="../assets/image/Dental care.jpg" alt="">
                <h2>PUPPY 101 PACKAGE</h2>
                <p> It includes a relaxing hydrotherapy bath, followed by a blowout and brush out to keep their coat looking healthy and shiny. Our expert groomers will also trim their nails, as well as any eye or sanitary areas as needed. This package is perfect for puppies who may be new to grooming and need a bit of extra care and attention.</p>
                <ul>
                            <li>Hydrotherapy bath ( RM 80 )</li>
                            <li>Blow out ( RM 20 )</li>
                            <li>Brush out ( RM 20 )</li>
                            <li>Nail trim ( RM 20 )</li>
                            <li>Eye trim ( RM 60 )</li>
                            <li>Sanitary trim ( RM 60 )</li>
                    </ul> 
            </div>
        </div>
    </div>

    <div class="grooming-gallery">
        <div class="gallery-content">
            <img src="../assets/image/Comprehensive physical exams.jpg" alt="">
            <h3>BATH PACKAGE</h3>
            <p>Discounted price: </p>
            <h6><del>RM 160</del> <span style="color:red;">RM 140</span></h6>
            <ul>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>

            </ul>
            <a href="bookgrooming.php?grooming=BATH PACKAGE"><button class="booknow">Book Now</button></a>

        </div>

        <div class="gallery-content">
            <img src="../assets/image/Dental care.jpg" alt="">
            <h3>HAIRCUT PACKAGE</h3>
            <p>Discounted price: </p>
            <h6><del>RM 240</del> <span style="color:red;">RM 200</span></h6>
            <ul>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
            </ul>
            <a href="bookgrooming.php?grooming=HAIRCUT PACKAGE"><button class="booknow">Book Now</button></a>
        </div>

        <div class="gallery-content">
            <img src="../assets/image/Diagnostic testing.jpg" alt="">
            <h3>PUPPY 101 PACKAGE</h3>
            <p>Discounted price: </p>
            <h6><del>RM 260</del> <span style="color:red;">RM 220</span></h6>
            <ul>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
                <li><i class="fa regular fa-thumbs-up checked"></i></li>
            </ul>
            <a href="bookgrooming.php?grooming=PUPPY 101 PACKAGE"><button class="booknow">Book Now</button></a>
        </div>

        
    </div>


</body>
</html>