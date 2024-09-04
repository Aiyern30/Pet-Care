<?php
include '../Customer/condb.php';
?>
<link rel="stylesheet" href="../assets/css/customer/footer.css">
<?php
if(isset($_SESSION['noic'])){
?>
<footer class="footer"> 
    <div class="footer-body">
        <div class="footer-container">
            <div class="footer-line">
                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="clinic.php">Veterinary Clinic</a></li>
                        <li><a href="grooming.php">Grooming</a></li>
                        <li><a href="pethotel.php">Pet Hotel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Features</h4>
                    <ul>
                        <li><a href="Schedule.php">Schedule</a></li>                
                        <li><a href="forum.php">Community</a></li>
                        <li><a href="Announcement.php">Announcement</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>More</h4>
                    <ul>
                        <li><a href="Feedback.php">Feedback</a></li>
                        <li><a href="ContactUs.php">Contact Us</a></li>
                        <li><a href="MyProfile.php">My Profile</a></li>

                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Logout</h4>
                    <ul>
                        <li><a href="#.php">Logout</a></li>
                    </ul>
                </div>
                
                <!-- <div class="footer-col">
                    <h4>Payment</h4>
                    <div class="social-links">
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                        <a href=""></a>
                    </div>
                </div> -->
                
            </div>
        </div>
    </div> 
</footer>
<?php 
}else{
?>
<footer class="footer"> 
    <div class="footer-body">
        <div class="footer-container">
            <div class="footer-line">
                <div class="footer-col">
                    <h4>Services</h4>
                    <ul>
                        <li><a href="clinic.php">Veterinary Clinic</a></li>
                        <li><a href="grooming.php">Grooming</a></li>
                        <li><a href="pethotel.php">Pet Hotel</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Features</h4>
                    <ul>           
                        <li><a href="knowledgebase.php">Knowledgebase</a></li>
                        <li><a href="Announcement.php">Announcement</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
</footer>
<?php
}
?>