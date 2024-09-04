<?php
session_start();
include 'condb.php';
if (!isset($_SESSION['noic'])){
    echo "<script>alert('Please login first!');</script>";
    echo "<script>window.location.href='login.php';</script>";
    exit();
}

date_default_timezone_set('Asia/Kuala_Lumpur');

$id = $_REQUEST['postid'];
$_SESSION['postid'] = $id;
$sql = "SELECT * from post where postid='".$id."'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View conversation</title>
    <link rel="stylesheet" href="../assets/css/customer/style.css">
    <style>
        .title{
            padding: 20px;
            font-size: 36px;
            text-align: center;
        }
        .btn-container{
            height: 100px;
            width: 100%;
        }
        .right-top-button{
            float: right;
            margin: 10px 10px 0px 0px;
        }
        .right-top-button button{
            width: 200px;
            height: 55px;
            background-color: aquamarine;
            font-size: 20px;
            border-radius: 5px;
            transition: all 0.3s ease-in-out;
        }

        .right-top-button button:hover{
            background-color: antiquewhite;
        }    
        @media only screen and (max-width: 800px) {
            
            
            .right-top-button button{
                
                width: 150px;
                height: 45px;
                font-size: 16px;
            }
        }
        @media only screen and (max-width: 600px) {
            .btn-container{
                height: 150px;
                width: 100%;
            }
            .right-top-button button{
                width: 100px;
                height: 45px;
                font-size: 13px;
            }
        }
        .content{
            padding: 20px;
            font-size: 18px;
            background-color: #b9e1f0;
            border: 1.7px solid black;
            border-radius: 5px;
            margin-bottom: 2px;
            padding-top: 30px;
        }
        .content span{
            font-size: 20px;
            color: black;
        }
        .content p{
            font-size: 13px;
            color: grey;
        }
        .reply-btn {
            position: absolute; /* set the position of the button as absolute */
            right: 0; 
            width: 100px;
            height: 50px;
            margin-right: 10px;
            background-color: #1E90FF;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            border: 1.7px solid black;
            text-align: center;
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: -50px;
        }
        .reply-btn:hover {
            background-color: #009879;
        }
        .header{
            background-color: #f7f7f7;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            margin-bottom: 20px;
        }
        .header h1{
            color: #333;
            font-size: 30px;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .no-comment{
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 20px;
            font-weight: bold;
            width: 100%;
            height: 40vh;
        }
        .input-box {
            width: 100%;
            margin: 0;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f5f5f5;
            box-sizing: border-box;
            margin-top: 30px;
        }
        .input-box label {
            font-size: 18px;
            font-weight: bold;
        }
        
        .input-box input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        
        .input-box button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
        
        .input-box button[type="submit"]:hover {
            background-color: #3e8e41;
        }

        @media (max-width: 600px) {
            .input-box {
                width: 100%;
                margin: 0;
                padding: 10px;
            }
            
            .input-box input[type="text"] {
                width: 70%;
                font-size: 14px;
            }
            
            .input-box button[type="submit"] {
                padding: 8px 16px;
                font-size: 14px;
            }
            
            .reply-btn {
                position: static;
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }

        .reply-form input[type="text"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-size: 16px;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        
        .reply-form button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
        }
    </style>
    <script>
    function showReplyForm(commentId, event) {
        event.preventDefault();
        // Hide any open reply forms
        var replyForms = document.getElementsByClassName('reply-form');
        for (var i = 0; i < replyForms.length; i++) {
            replyForms[i].style.display = 'none';
        }
        
        // Show the reply form for the clicked comment
        var replyForm = document.getElementById('reply-form-' + commentId);
        replyForm.style.display = 'block';
    }
    </script>
</head>
<body>
    <?php include 'homenav.php'; ?>
    <div class="header">
        <h1 class="title"><?php echo $row['content']; ?></h1>
    </div>
    <div class="btn-container">
        <div class="right-top-button">
            <a href="forum.php"><button>Back</button></a>
        </div>
    </div>
    <?php
        $sql = "SELECT comment.*, customer.fullname from comment join customer on customer.customerid = comment.customerid where postid='".$id."' and reply_to = '0'";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0){
            while ($row = mysqli_fetch_assoc($result)){
                $commentid = $row['commentid'];
                $content = $row['content'];
                $datetime = $row['datetime'];
                $fullname = $row['fullname'];
                ?>
                <div class="content">
                    <input type="hidden" value="<?php echo $commentid;?>">
                    <span><?php echo $content; ?></span>
                    <p>Comment by <strong><?php echo $fullname; ?></strong></p>
                    <p>Comment on <strong><?php echo $datetime; ?></strong></p>
                    <a href="#" class="reply-btn" onclick="showReplyForm('<?php echo $commentid; ?>', event)">Reply</a>
                    <div id="reply-form-<?php echo $commentid; ?>" class="reply-form" style="display:none;">
                        <form action="" method="POST">
                            <input type="hidden" name="postid" value="<?php echo $_SESSION['postid']; ?>">
                            <input type="hidden" name="commentid" value="<?php echo $commentid; ?>">
                            <input name="reply_content" type="text" placeholder="Enter your reply here ~">
                            <button type="submit" name="post_reply">Send</button>
                        </form>
                    </div>
                </div>
                <?php
                $sql2 = "SELECT comment.*, customer.fullname from comment join customer on customer.customerid = comment.customerid where reply_to='".$commentid."'";
                $result2 = mysqli_query($con, $sql2);

                if (mysqli_num_rows($result2 )> 0){
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        $content2 = $row2['content'];
                        $datetime2 = $row2['datetime'];
                        $commentid2 = $row2['commentid'];
                        $fullname2 = $row2['fullname'];
                        ?>
                        <div class="content" style="margin-left: 50px;">
                            <span><?php echo $content2; ?></span>
                            <p>Reply by <strong><?php echo $fullname2; ?></strong></p>
                            <p>Reply on <strong><?php echo $datetime2; ?></strong></p>
                        </div>
                        <?php
                    }
                }
            }
        }else{
            echo "<div class='no-comment'>";
            echo "<span>No comments found!</span>";
            echo "</div>";
        }
    ?>
    <div class="input-box">
        <form action="viewconversation.php?postid=<?php echo $id; ?>" method="post">
            <input type="hidden" name="postid" value="<?php echo $_SESSION['postid']; ?>">
            <label for="comment_content">Your comment: </label><br>
            <input type="text" name="comment_content" placeholder="Enter your comment here ~" style="display: inline-block;">
            <button type="submit" name="post_comment" style="display: inline-block;">Send</button>
        </form>
    </div>
    <?php
    $comment = "";
    $postid = "";
    
    if (isset($_POST['post_comment'])){
        post_comment();
    }

    function post_comment(){
        global $con, $comment, $postid;

        $comment = $_POST['comment_content'];
        $postid = $_POST['postid'];

        if (!empty($comment)){
            $customerid = $_SESSION['customerid'];
            $current_datetime =  date('Y-m-d H:i:s');
            $reply_to = 0;
            $sql = "INSERT into comment(content, datetime, reply_to, postid, customerid) value (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'sssss', $comment, $current_datetime, $reply_to, $postid, $customerid);
            $result = mysqli_stmt_execute($stmt);
            if($result){
                echo '<script>alert("Comment uploaded!");</script>';
                echo "<meta http-equiv='refresh' content='0'>";
                exit();
            }else{
                echo '<script>alert("Comment failed to upload!");</script>';
                echo "<meta http-equiv='refresh' content='0'>";
                exit();
            }
        }else{
            echo '<script>alert("Comment failed to upload! Please try again");</script>';
        }
    }
    
    if (isset($_POST['post_reply'])){
        post_reply();
    }

    function post_reply(){
        global $con, $comment, $postid;

        $comment = $_POST['reply_content'];
        $postid = $_POST['postid'];
        $reply_to = $_POST['commentid'];

        if (!empty($comment)){
            $customerid = $_SESSION['customerid'];
            $current_datetime =  date('Y-m-d H:i:s');
            $sql = "INSERT into comment(content, datetime, reply_to, postid, customerid) value (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $sql);
            mysqli_stmt_bind_param($stmt, 'sssss', $comment, $current_datetime, $reply_to, $postid, $customerid);
            $result = mysqli_stmt_execute($stmt);
            if($result){
                echo '<script>alert("Reply uploaded!");</script>';
                echo "<meta http-equiv='refresh' content='0'>";
                exit();
            }else{
                echo '<script>alert("Reply failed to upload!");</script>';
                echo "<meta http-equiv='refresh' content='0'>";
                exit();
            }
        }else{
            echo '<script>alert("Reply failed to upload! Please try again");</script>';
        }
    }

    ?>
</body>
</html>