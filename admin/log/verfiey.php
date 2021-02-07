
<!DOCTYPE html5>
<html lang="en">

<head>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../site/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../site/css/bootstrap-rtl.css">
    <link rel="stylesheet" href="../../site/css/all.min.css">
    <link rel="stylesheet" href="../../site/css/index_style.css">
    <link rel="stylesheet" href="../../site/css/fontsArabic.css">
    <link rel="icon" href="../../site/images/4.png">
    <title>Success Register</title>


</head>

<body>

    <header>

        <nav class="nav2 navbar navbar-expand-lg fixed-top  p-2">
            <div class="container-fluid">
                <a class="navbar-brand mb-2" href="../../site/index.html">الدراسات العليا</a>
                <button class="navbar-toggler mr-3" type="button" data-toggle="collapse"
                    data-target="#navbar-togglerDemo02" aria-controls="navbar-togglerDemo02" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line" style="margin-bottom: 0;"></span>
                </button>

              <div class="collapse navbar-collapse" id="navbar-togglerDemo02">
                            <ul class="navbar-nav" style="position:relative;">
                                <li class="nav-item active p-2 ">
                                    <a class="nav-link Arabic" href="../../site/index.html">الرئيسية <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                
                                <li class="nav-item active p-2">
                                    <a class="nav-link " href="../../site/faq.html">اسئلة شائعة <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active p-2">
                                    <a class="nav-link " href="../../site/program.html">برامج الدراسات العليا <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active p-2">
                                    <a class="nav-link " href="../../site/program.html">اللائحة <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active bor p-2">
                                    <a class="nav-link" href="../../site/contact.html">
                                        اتصل بنا                                        <span class="sr-only">(current)</span></a>
                                </li>
                               <li class="nav-item active p-2">
                                    <a class="nav-link" href="register.php">التسجيل <span
                                            class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item active p-2">
                                    <a class="nav-link" href="login.php">تسجيل الدخول <span
                                            class="sr-only">(current)</span></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </nav>


    </header>
    
       <section id="contact" class="py-5">

        <div class="container">
           
           
            <div class="row">
<?php
include("../../connections/post.php");
            
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
    // Verify data
    $email = mysqli_real_escape_string($post,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($post,$_GET['hash']); // Set hash variable
                  
   $search = "SELECT email, hash, active FROM temp WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
$result2=mysqli_query($post, $search);	
    $match  = mysqli_num_rows($result2);
                  
    if($match > 0){
        // We have a match, activate the account
        mysqli_query($post,"UPDATE temp SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'");
        echo '<h3  align="center">تم تفعيل حسابك بنجاح يمكنك الدخول الان <a href="login.php">دخول</a></h3>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div  align="center"><h3>تم تفعيل حسابك من قبل </h3></div>';
    }
                  
}else{
    // Invalid approach
    echo '<h3 align="center">من فضلك استخدم الرابط الذى تم ارساله الى ايميلك. رابط غير صحيح</h3>';
}
?>
</div>
</div>
</div>
<br/>
<br/>

<br/>

<br/>
<br/>

    <footer id="footer ">
      
            <div class="footerBottom pt-4 pb-3 px-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 ">
                        <p class="text-center"> كلية الهندسة جامعة الازهر 2021&copy; وحدة التعليم الالكترونى </p>
                    </div>
                    <div class="col-md-6">
                        <div class="soialIcon float-right px-5 myArb">
                            <a><i class="fas fa-envelope mr-3 "> Email:post.eng.az@gmail.com</a></i>
                            <a><i class="fas fa-phone-alt mr-3"> Tel:02-22629594  </a></i>
                          
                            
                    </div>

                </div>
            </div>
        </div>
     

    </footer>


    <script src="../../site/js/jquery-3.4.1.min.js"></script>
    <script src="../../site/js/popper.min.js"></script>
    <script src="../../site/js/bootstrap.min.js"></script>
    <script src="../../site/js/index.js"></script>

</body>

</html>