<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinary Clinic</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <link rel="stylesheet" href="../assets/css/customer/clinic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<style>
    .cover{
        background-image: url(https://www.banfield.com/-/media/Project/Banfield/Main/en/Dental_Care/Dental_care_dog/0130_02_4x3L.jpg?h=1153&w=1536&rev=6e65e34d9eb34722aea77c51f5695418&hash=B15B8B2BB19699B203256539F7C0B36F);
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
        <h1>Quality Veterinary Clinic</h1>
    </div>
    <style>
        
    </style>

    <div class="clinic-con">
        <h1>Treatments for Your Beloved Pet</h1>
            <div class="clinic-row">
        <a href="#purchase-1">
            <div class="clinic-des">
                <i class="fa fa-clipboard-list"></i>
                <h2>Comprehensive physical exams</h2>
                <p>Comprehensive physical exams for pets are thorough and detailed assessments of the animal's overall health, including a full-body examination and various diagnostic tests.</p>        
            </div>
        </a>
        <a href="#purchase-2">
            <div class="clinic-des">
            <i class="fa regular fa-syringe"></i>
                <h2>Vaccinations</h2>
                <p>Vaccination for pets is the process of administering a small, harmless amount of a disease-causing agent to stimulate the immune system, helping to protect them against that disease.</p>
            </div>
        </a>
        <a href="#purchase-3">
            <div class="clinic-des">
            <i class="fa thin fa-tooth"></i>
                <h2>Dental care</h2>
                <p>Dental care for pets involves maintaining good oral hygiene preventing dental diseases.</p>        
            </div>
        </a>
        <a href="#purchase-4">
            <div class="clinic-des">
            <i class="fas fa-user-nurse"></i>
                <h2>Surgical procedures</h2>
                <p>Surgical procedures for pets involve the use of medical interventions to treat injuries or conditions that cannot be treated with medication or other non-invasive methods.</p>        
                </div>
        </a>
        <a href="#purchase-5">
            <div class="clinic-des">
            <i class="fa fa-stethoscope"></i>
                <h2>Diagnostic testing</h2>
                <p>Diagnostic testing for pets involves a variety of procedures and tests used to diagnose illnesses and diseases, including blood tests, X-rays, ultrasounds, and more.</p>
            </div>
        </a>
        <a href="#purchase-6">
            <div class="clinic-des">
            <i class="fa regular fa-worm"></i>
                <h2>Parasite prevention and treatment</h2>
                <p>Parasite prevention and treatment refers to the measures taken to prevent and treat the infestation of internal and external parasites such as fleas, ticks, and worms in pets.</p>
            </div>
        </a>
        </div>
    </div>

<div class="pricewrap">
    <div class="price-container" id="purchase-1">
        <h3>Comprehensive physical exams<span class="icon"><i class="fa fa-clipboard-list"></i></span></h3>
        <h1>RM 200 <span> /time</span></h1>
        <p>Comprehensive physical exams for pets are thorough and detailed assessments of the animal's overall health, including a full-body examination and various diagnostic tests.</p>
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Head-to-tail evaluation</li>
            <li><i class="fa-solid fa-square-check"></i>Blood work</li>
            <li><i class="fa-solid fa-square-check"></i>Fecal analysis</li>
            <li><i class="fa-solid fa-square-check"></i>Urinalysis</li>
        </ul>

        <a href="bookclinic.php?clinic=Comprehensive physical exams">Book Appointment</a>
    </div>

    <div class="price-container" id="purchase-2">
        <h3>Vaccinations<span class="icon"><i class="fa regular fa-syringe"></i></span></h3>
        <h1>RM 80 <span> /time</span></h1>
        <p>Vaccination for pets is the process of administering a small, harmless amount of a disease-causing agent to stimulate the immune system, helping to protect them against that disease.</p>
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Provide documentation</li>
            <li><i class="fa-solid fa-square-check"></i>Administering appropriate vaccines </li>
        </ul>

        <a href="bookclinic.php?clinic=Vaccinations">Book Appointment</a>
    </div>

    <div class="price-container" id="purchase-3">
        <h3>Dental care<span class="icon"><i class="fa thin fa-tooth"></i></span></h3>
        <h1>RM 400 <span> /time</span></h1>
        <p>Dental care for pets involves maintaining good oral hygiene preventing dental diseases.</p>
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Dental Exams</li>
            <li><i class="fa-solid fa-square-check"></i>Cleanings</li>
            <li><i class="fa-solid fa-square-check"></i>Extractions</li>
            <li><i class="fa-solid fa-square-check"></i>Treatment</li>
        </ul>

        <a href="bookclinic.php?clinic=Dental care">Book Appointment</a>
    </div>

</div>


<div class="pricewrap">
    <div class="price-container" id="purchase-4">
    <h3>Surgical procedures<span class="icon"><i class="fas fa-user-nurse"></i></span></h3>
            <h1>RM 2000 <span> /time</span></h1>
            <p>Surgical procedures for pets involve the use of medical interventions to treat injuries or conditions that cannot be treated with medication or other non-invasive methods.</p>        
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Spay/neuter surgeries</li>
            <li><i class="fa-solid fa-square-check"></i>Soft tissue surgeries </li>
            <li><i class="fa-solid fa-square-check"></i>Orthopedic surgeries </li>
            <li><i class="fa-solid fa-square-check"></i>Emergency surgeries </li>
        </ul>

        <a href="bookclinic.php?clinic=Surgical procedures">Book Appointment</a>
    </div>

    <div class="price-container" id="purchase-5">
        <h3>Diagnostic testing<span class="icon"><i class="fa fa-stethoscope"></i></span></h3>
        <h1>RM 200 <span> /time</span></h1>
            <p>Diagnostic testing for pets involves a variety of procedures and tests used to diagnose illnesses and diseases, including blood tests, X-rays, ultrasounds, and more.</p>
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Blood test</li>
            <li><i class="fa-solid fa-square-check"></i>Urinalysis</li>
            <li><i class="fa-solid fa-square-check"></i>Fecal exams</li>
            <li><i class="fa-solid fa-square-check"></i>X-rays</li>
            <li><i class="fa-solid fa-square-check"></i>Ultrasounds</li>
        </ul>

        <a href="bookclinic.php?clinic=Diagnostic testing">Book Appointment</a>
    </div>

    <div class="price-container" id="purchase-6">
        <h3>Parasite prevention and treatment <span class="icon"><i class="fa regular fa-worm"></i></span></h3>
        <h1>RM 100 <span> /time</span></h1>
        <p>Parasite prevention and treatment refers to the measures taken to prevent and treat the infestation of internal and external parasites such as fleas, ticks, and worms in pets.</p>
        <ul>
            <li><i class="fa-solid fa-square-check"></i>Deworming</li>
            <li><i class="fa-solid fa-square-check"></i>Flea </li>
            <li><i class="fa-solid fa-square-check"></i>Tick prevention</li>
            <li><i class="fa-solid fa-square-check"></i>Heartworm prevention</li>
        </ul>

        <a href="bookclinic.php?clinic=Parasite prevention and treatment">Book Appointment</a>
    </div>

</div>

       
    <div class="container-gallery">
        <h1>We have a team of staff members with over 10 years of experience.</h1>
            <div class="gallery">
                <div class="img-box">
                <img src="https://i.pinimg.com/736x/6a/59/f1/6a59f1f4123dfc332302193e39f824f0--about-us.jpg" alt="">
                <h3>Doctor Gan</h3>
                </div>
                <div class="img-box">
                <img src="https://bocaveterinaryclinic.com/wp-content/uploads/2020/04/Doctors-of-Boca-Vet-Clinic.jpg" alt="">
                <h3>Doctor Hoi</h3>
                </div>
                <div class="img-box">
                <img src="https://th.bing.com/th/id/R.7877e926e21f52b991fe0ab9e796a780?rik=eFadfPgyvzxXug&riu=http%3a%2f%2fcdn.media.yp.ca%2f8536648%2fpcc_0_06628300_1436457452_r.jpg&ehk=QHbW6Pf9Tqubru2Jt1RSV5DOioJoOHz%2bXvGidByTUDM%3d&risl=&pid=ImgRaw&r=0" alt="Madison">
                <h3>Doctor Han</h3>
                </div>
                <div class="img-box">
                <img src="https://www.wacoan.com/wp-content/uploads/dogtopia-1.jpg" alt="">
                <h3>Doctor Ee</h3>
                </div>
            </div>
    </div>

</body>
</html>