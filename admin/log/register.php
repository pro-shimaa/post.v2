<?php
ob_start();
include'l/header.php';
require('constant.php');
require("PHPMailer/PHPMailerAutoload.php");

?>
<?php
include("../../connections/post.php");

?>

<?php
$errMSG="";
// start insert code
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	
	$textFile = $_FILES['file']['name'];

  $tmp_dir = $_FILES['file']['tmp_name'];
  $txtSize = $_FILES['file']['size'];
  
  $upload_dir = 'upload/'; // upload directory
 
   $txtExt = strtolower(pathinfo($textFile,PATHINFO_EXTENSION)); // get image extension
  
   // valid image extensions
   $valid_extensions = array('zip', 'rar'); // valid extensions
  
   // rename uploading image
   $usertext = rand(1000,1000000).".".$txtExt;
      // allow valid image file formats
	  $path=$upload_dir.$usertext;
   if(in_array($txtExt, $valid_extensions)){   
    // Check file size '5MB'
    if($txtSize < 500000000)    {
     move_uploaded_file($tmp_dir,$upload_dir.$usertext);
    }
    else{
     $errMSG = "ناسف لعدم اكمال التسجيل حيث ان الملف الذى قمت برفعه اكبر من 12 ميجا ";
    }
   }
   else{
    $errMSG = "لم يتم ادخال بياناتك بطريقه صحيحة حيث انك قمت برفع الملفات بامتداد غير مقبول . برجاء ضغط الملفات قبل رفعها حيث انا الامتداد المسموح به RAR او ZIP";  
   }
   
if($errMSG ==""){

	$sql2="SELECT arabic_name from temp where email='".mysqli_real_escape_string($post,$_POST["email"])."'";

$result2=mysqli_query($post,$sql2);
  // Return the number of rows in result set
  $rowcount=mysqli_num_rows($result2);
  if($rowcount>=1)
  $errMSG="تم تسجيل هذا الايميل من قبل برجاء اعادة التسجيل بايميل جديد وفى حالة نسيت الرقم السرى يمكنك استعادته بالضغط هنا <a href='forget_password.php'>نسيت الرقم السرى</a>";
  else
  {
 mysqli_set_charset($post,"utf8");
$hash = md5( rand(0,1000) );
$sql = "INSERT INTO temp(email,degree_id,arabic_name,english_name,gender,birthdate,birthplace,country,state,region,address,phone_home,phone_mobile,id_number,id_place,id_date,jop,jop_phone,dept_id,special,grad_place,grade_id,grade_year,upload_path,password,acc_lvl,status,jop_st,hash,active) VALUES ('".mysqli_real_escape_string($post,$_POST["email"])."','".mysqli_real_escape_string($post,$_POST["degree"])."','".mysqli_real_escape_string($post,$_POST["arname"])."','".mysqli_real_escape_string($post,$_POST["ennmae"])."','".mysqli_real_escape_string($post,$_POST["inlineRadioOptions"])."','".mysqli_real_escape_string($post,$_POST["birthdate"])."','".mysqli_real_escape_string($post,$_POST["birthplace"])."','".mysqli_real_escape_string($post,$_POST["country"])."','".mysqli_real_escape_string($post,$_POST["state"])."','".mysqli_real_escape_string($post,$_POST["region"])."','".mysqli_real_escape_string($post,$_POST["address"])."','".mysqli_real_escape_string($post,$_POST["phone"])."','".mysqli_real_escape_string($post,$_POST["mobile"])."','".mysqli_real_escape_string($post,$_POST["id_no"])."','".mysqli_real_escape_string($post,$_POST["id_place"])."','".mysqli_real_escape_string($post,$_POST["id_date"])."','".mysqli_real_escape_string($post,$_POST["work"])."','".mysqli_real_escape_string($post,$_POST["work_phone"])."','".mysqli_real_escape_string($post,$_POST["department"])."','".mysqli_real_escape_string($post,$_POST["special"])."','".mysqli_real_escape_string($post,$_POST["grad_place"])."','".mysqli_real_escape_string($post,$_POST["grade"])."','".mysqli_real_escape_string($post,$_POST["grade_year"])."','".mysqli_real_escape_string($post,$path)."','".mysqli_real_escape_string($post,password_hash($_POST["password"],PASSWORD_DEFAULT))."','1','0','".mysqli_real_escape_string($post,$_POST["test"])."','". mysqli_real_escape_string($post,$hash) ."',0)";
   mysqli_query($post, $sql);
$email=$_POST["email"];
$password=$_POST["password"];
$output='<p align="right">عزيزى الطالب,</p>';
$output='<p align="right">السلام عليكم ورحمة الله وبركاته</p>';

$output.='<p align="right">شكرا لكم على التسجيل فى استمارة الدراسات العليا بجامعة الازهر</p>';
$output.='<p align="right">تم انشاء حسابكم على الموقع بنجاح .. تستطيع الدخول بالبيانات الاتيه </p>';
$output.='<p align="right">-------------------------------------------------------------</p>';
$output.="Username: $email";
$output.="<p>Password: $password";
$output.='<p align="right">-------------------------------------------------------------</p>';

$output.='<p align="right"><a href="localhost/post/admin/log/verfiey.php?email='.$email.'&hash='.$hash.'">من فضلك اضغط على هذا الرابط لتفعيل حسابكم على الموقع</a></p>';
  $output.='<p align="right">وحدة التعليم الإليكترونى - بكلية الهندسة - جامعة الأزهر</p>';
$body = $output; 
$subject = " تفعيل حساب التسجيل على بموقع الدراسات العليا بكلية الهندسة";
$email_to = $email;
$fromserver = "post.eng.az@gmail.com"; 
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = "smtp.gmail.com";
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Username   = "post.eng.az@gmail.com";
$mail->Password   = "Azhar@1234";
 $mail->IsHTML(true);
$mail->From = "post.eng.az@gmail.com";
$mail->FromName = "الدراسات العليا بكلية الهندسة - جامعة الازهر ";
$mail->Sender = $fromserver; // indicates ReturnPath header
$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
$mail->Send();
header('Location: success_reg.php');
exit;
		
  }
}}
?>
<script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>	
<style type="text/css">
#loader {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.75) url(img/loader.gif) no-repeat center center;
  z-index: 10000;
}
</style>
<body>
<!-- Paste this code after body tag -->
	<div id="loader"></div>

	<!-- Ends -->
    <div class="container" >
        <div class="row" >
            <div class="col-md-29 col-md-offset-29" >
                <div class="register-panel panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title" align="center" style="color:#006"><strong>تسجيل الطالب للدراسات العليا</strong></h1>

                        <h3 align="center"><?php echo $errMSG;?></h3>
                    </div>
                    <div class="panel-body">
                     <form method="post"  class="mt-5 px-4" name="form1" action="register.php" enctype="multipart/form-data"> 
                                <div class="form-group row">
        <div class="col-sm-4">
                                         <label for="inputPassword" class=" col-form-label">الاسم باللغة العربية<span style="color:#F00">*</span></label>


                 <input type="text"  id="ar" class="form-control" name="arname" oninvalid="this.setCustomValidity('من فضلك ادخل الاسم رباعى باللغة العربية')" placeholder="الاسم رباعى باللغة العربية" autofocus pattern="[ء-ي\s]+"  required oninput="setCustomValidity('')">
                                </div>
                              
        <div class="col-sm-4">
                                                 <label for="inputPassword" class=" col-form-label">الاسم باللغة الانجليزية<span style="color:#F00">*</span></label>

                                <input type="text" class="form-control" id="inputName" name="ennmae" placeholder="الاسم رباعى اللغة الانجليزية" required="" pattern="[a-zA-Z0-9\s]+" oninvalid="this.setCustomValidity('من فضلك ادخل الاسم رباعى باللغة الانجليزية')"   oninput="setCustomValidity('')">
                                
                            </div>
                                </div>
                                
                                            <div class="form-group row">
                                                    <div class="col-sm-8">
                                                                                                     <label for="inputPassword" class=" col-form-label">البريد الإليكترونى<span style="color:#F00">*</span></label>


                                <input type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" class=" form-control" id="inputAddress" name="email" placeholder="البريد الالكترونى " required="" oninvalid="this.setCustomValidity('من فضلك ادخل بريد اليكترونى صحيح')"   oninput="setCustomValidity('')" >
                            </div>
                            </div>
                            
                       <div class="form-row">
                         <div class="form-group col-md-4">
                          <label for="inputPassword" class=" col-form-label">كلمة المرور<span style="color:#F00">*</span></label>
                                    <input type="password" class="form-control" name="password" id="txtNewPassword" placeholder="كلمة المرور" required="" minlength="6" pattern=".{6,}" oninvalid="this.setCustomValidity('من فضلك ادخل الرقم السرى فيما لايقل عن 6 ارقام وحروف')"   oninput="setCustomValidity('')">
                               
                                </div>
                                <div class="form-group col-md-4">
                                 <label for="inputPassword" class=" col-form-label">إعادة ادخال كلمة المرور<span style="color:#F00">*</span></label>
                                    <input type="password" class="form-control" name="repassword" id="txtConfirmPassword" placeholder="اعادة كلمة المرور" required>
                                   
                         </div>
                            </div>
                            <div class="form-group row" >
                                                    <div class="col-sm-8">
                                                                                                     <label for="inputPassword" class=" col-form-label">الدرجة المتقدم لها<span style="color:#F00">*</span></label>
      
  <select name="degree" class="form-control" id="degree" required>
   <option value="1">ماجستير</option>
  <option value="2">دكتوراة</option>
  <option value="3">دبلومة</option>
  </select>

  </div>
 </div>
  
    
                            <div class="form-group row" >
                              <div class="form-group col-md-2">

                                <label class="form-check-label check"  >الجنس:</label>
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio1" value="1" > ذكر
                                
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                            id="inlineRadio2" value="2" > انثى
                            </div>
                            </div>
    
    
                                                    <div class="form-group row">
    
    
    
                                <div class="form-group col-md-4">
            <label for="inputPassword" class=" col-form-label">رقم التليفون</label>

                                    <input type="text" class="alaa form-control phoneNum" name="phone" id="inputPhone"
                                        placeholder="رقم التليفون">
                                </div>
                                <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">رقم المحمول<span style="color:#F00">*</span></label>

                                    <input type="text" class="form-control phoneNum" name="mobile" id="inputPhone2"
                                        placeholder="رقم المحمول " pattern=".{11,}"  minlength="11" maxlength="11" required="" oninvalid="this.setCustomValidity('من فضلك ادخل رقم الهاتف المحمول الخاص بك')"   oninput="setCustomValidity('')">
                                </div>
                            </div>
                            
                          
                              
                            
                            <div class="form-group row">
 <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">تاريخ الميلاد<span style="color:#F00">*</span></label>


                                <input type="date" class=" form-control" name="birthdate" id="inputAddress" placeholder="تاريخ الميلاد		 " required="" oninvalid="this.setCustomValidity('من فضلك ادخل تاريخ الميلاد')"   oninput="setCustomValidity('')">
                            </div>
                                                       <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">جهة الميلاد<span style="color:#F00">*</span></label>
                                <input type="text" class=" form-control" id="inputAddress" name="birthplace" placeholder="جهة الميلاد " required="" oninvalid="this.setCustomValidity('من فضلك ادخل  جهة الميلاد')"   oninput="setCustomValidity('')">
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                                                            <label for="inputPassword" class=" col-form-label">البلد</label>

                                    <input type="text" name="state" class="alaa form-control phoneNum" id="inputPhone"
                                        placeholder="البلد">
                                </div>
                                <div class="form-group col-md-4">
                                                                            <label for="inputPassword" class=" col-form-label">المركز</label>

                                    <input type="text" class="form-control phoneNum" name="region" id="inputPhone2"
                                        placeholder="المركز ">
                                </div>
                                </div>
                            <div class="form-group row">
                                                            <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">المحافظة<span style="color:#F00">*</span></label>

                                    <input type="text" class="form-control phoneNum" name="country" id="inputPhone2"
                                        placeholder="المحافظة " required="" oninvalid="this.setCustomValidity(' من فضلك ادخل  المحافظة   ')"   oninput="setCustomValidity('')">
                              </div>    
                            
                            <div class="form-group col-md-4">
                                                                        <label for="inputPassword" class=" col-form-label">العنوان<span style="color:#F00">*</span></label>

  <input type="text" class=" form-control" name="address" id="inputAddress" placeholder="عنوان محل الاقامة الذى يتم ارسال الخطابات عليه " required="" oninvalid="this.setCustomValidity('من فضلك ادخل عنوان محل الاقامة الذى سيتم ارسال الخطابات عليه')"   oninput="setCustomValidity('')">
                            </div>
                            </div>
                            <div class="form-group row">
                                                                                 <div class="form-group col-md-8">
                                                   <label for="inputPassword" class=" col-form-label">رقم بطاقة الرقم القومى<span style="color:#F00">*</span></label>

                                <input type="text" class=" form-control" name="id_no" id="inputAddress" placeholder="بطاقة الرقم القومى " required="" oninvalid="this.setCustomValidity('من فضلك ادخل رقم البطاقة المكون من 14 رقم')"   oninput="setCustomValidity('')" minlength="14" maxlength="14">
                            </div>
                            </div>
                                <div class="form-group row">
                                <div class="form-group col-md-4">
                                                                                   <label for="inputPassword" class=" col-form-label">جهة صدور بطاقة الرقم القومى<span style="color:#F00">*</span></label>

   <input type="text" class="alaa form-control phoneNum" name="id_place" id="inputPhone"
    placeholder="جهة صدورها" required="" oninvalid="this.setCustomValidity('من فضلك ادخل جهة صدور البطاقة')"   oninput="setCustomValidity('')">
                                </div>

                                <div class="form-group col-md-4">
                                                                                   <label for="inputPassword" class=" col-form-label">تاريخ صدور بطاقة الرقم القومى<span style="color:#F00">*</span></label>

                                    <input type="text" class="form-control phoneNum" id="inputPhone2" name="id_date"
        placeholder="تاريخ الصدور " required="" oninvalid="this.setCustomValidity('من فضلك ادخل تاريخ الصدور')"   oninput="setCustomValidity('')">
                                </div>
                            </div>
                             <div class="form-group row" >
                              <div class="form-group col-md-10">

                                <label class="form-check-label check">الوظيفة:</label>
                                        <input class="form-check-input" type="radio" name="test"
                                            id="work" value="8">لايعمل
                                        <input class="form-check-input" type="radio" name="test"
                                            id="work" value="9"> يعمل الحكومة او القطاع العام
                            
                            <input class="form-check-input" type="radio" name="test"
                                            id="work" value="10">  يعمل بالقطاع الخاص او العمل الحر
                            </div>
                            </div>
                              <div class="form-group row">

                                <div class="form-group col-md-4">
                                                                                                                                                 <label for="inputPassword" class=" col-form-label">جهة العمل وعنوانه</label>

                                    <input type="text" class="alaa form-control phoneNum" name="work" id="inputPhone"
                                        placeholder="جهة العمل وعنوانه">
                                </div>
                                <div class="form-group col-md-4">
                                                                                                                   <label for="inputPassword" class=" col-form-label">تليفون العمل</label>

                                    <input type="text" class="form-control phoneNum" id="inputPhone2" name="work_phone"
                                        placeholder="تليفون العمل ">
                                </div>
                            </div>
                <div class="form-group row">
                                                <div class="form-group col-md-8">

    <label  for="department">	القسم:<span style="color:#F00">*</span></label>
      
  <select name="department"class=" form-control"  required>
    <?php
        $records = mysqli_query($post, "SELECT * From department");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['dept_id'] ."'>" .$data['dept_name'] ."</option>";  // displaying data in option menu
        }	
    ?> 
     
  </select>
</div>
  </div>
      <div class="form-group row">
       <div class="form-group col-md-4">
                                                   <label for="inputPassword" class=" col-form-label">التخصص المكتوب فى الشهادة <span style="color:#F00">*</span></label>
            <input type="text" class=" form-control" name="special" id="inputAddress" placeholder="التخصص المكتوب فى الشهادة المؤقته " required="" oninvalid="this.setCustomValidity('من فضلك ادخل التخصص المكتوب فى الشهادة')"   oninput="setCustomValidity('')">
                       </div>
                                                  
       <div class="form-group col-md-4">
                                                          <label for="inputPassword" class=" col-form-label">جهة التخرج <span style="color:#F00">*</span></label>

                      <input type="text" class=" form-control" name="grad_place" id="inputAddress" placeholder="جهة التخرج " required="" oninvalid="this.setCustomValidity('من فضلك ادخل جهة التخرج')"   oninput="setCustomValidity('')">
                            </div>
       <div class="form-group col-md-4">
                                                                 <label for="inputPassword" class=" col-form-label">سنة التخرج <span style="color:#F00">*</span></label>

                      <input type="text" class=" form-control" id="inputAddress" required="" oninvalid="this.setCustomValidity('من فضلك ادخل سنة التخرج')"   oninput="setCustomValidity('')" name="grade_year" placeholder="سنة التخرج ">
                       </div>
                            </div>
                              <div class="form-group row">
                                     <div class="form-group col-md-8">

    <label  for="grade">:التقدير التراكمى	<span style="color:#F00">*</span></label>
      
  <select name="grade" class="form-control" >
    <?php
        $records = mysqli_query($post, "SELECT * From grade");  // Use select query here 

        while($data = mysqli_fetch_array($records))
        {
            echo "<option value='". $data['grade_id'] ."'>" .$data['grade'] ."</option>";  // displaying data in option menu
        }	
    ?> 
     
  </select>

  </div>

                           
                       </div>
                                                  <div class="form-group row">
                                                         <div class="form-group col-md-8">

                      <label>ادخل الاوراق المطلوبة بعد ضغطها zip او rar هى الامتدادات المسموح فقط برفعها <span style="color:#F00">*</span></label>

                      <input type="file" class=" form-control" id="inputAddress" name="file" required="" oninvalid="this.setCustomValidity('من فضلك ادخل االورق المطلوب مضغوط بصيغة RAR او ZIP ')"   oninput="setCustomValidity('')">
                                                  </div>  </div>
                                                  
                                                 <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY; ?>"></div>
                                                 <div style="color:#900"><strong>
                                                  برجاء التحقق والتاكد من انك قمت برفع الاوراق التالية فى الملف المضغوط الذى قمت برفعه  
                                                 </strong> </div>		
                                                    <div class="form-group">
                                                  <p><input id="field_terms"  type="checkbox" required="" oninvalid="this.setCustomValidity('برجاء تاكيد شهادة البكالوريوس فى حالة التقديم للماجستير وشهادة الماجستير وصورة من شهادة البكالوريوس فى حالة التقديم للدكتوراة')"   oninput="setCustomValidity('')" name="terms"> شهادة البكالوريوس للتسجيل للماجستير والدبلومة وشهادة الماجستير وصورة من البكالوريوس للتقديم للدكتوراة </u></p>

                                                  </div>   
                                                  <div class="form-group Box5">
                                                  <p><input id="shimaa"  type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع شهادة تقدير اربع سنوات باللغة العربيه للمتقدم لتسجيل الماجستير')"   oninput="setCustomValidity('')" name="shimaa">
                 شهادة تقدير اربع سنوات باللغة العربية للمتقدم لتسجيل الماجستير </u></p>

                                                  </div>  
                                                  <div class="form-group">
                                                  <p><input id="field_terms"  type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع شهادةالميلاد كمبيوتر')"   oninput="setCustomValidity('')" name="terms">
                 شهادة الميلاد كمبيوتر </u></p>

                                                  </div>  
                                                  <div class="form-group Box">
                                                  <p><input id="tgned" value="two"  type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع الموقف من التجنيد')"   oninput="setCustomValidity('')" name="terms">
                 اصل الموقف من التجنيد ( إعفاء نهائى - اعفاء مؤقت - مجند - مؤجل ) </u></p>

                                                  </div> 
                                                  <div class="form-group Box2">
                                                  <p><input id="hor" name="three" value="three" type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع اقرار من الباحث فى حالة العمل الحر او القطاع الخاص')"   oninput="setCustomValidity('')" >
               اقرار من الباحث فى حالة العمل الحر او القطاع الخاص او عدم العمل على ان يكون الاقرار موقع من اثنين من موظفى الحكومة ومختوم بختم الجهه التابعة لهم</u></p>


                                                  </div>   
                                                   <div class="form-group Box3">
                                                  <p><input id="hkoma" name="four" value="four" type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع موافقة جهة العمل للعاملين بالحكومة او القطاع العام على الدراسة')"   oninput="setCustomValidity('')" >
              موافقة جهة العمل للعاملين بالحكومة او القطاع العام على الدراسة</u></p>

                                                  </div>  
                                                   <div class="form-group">
                                                  <p><input id="field_terms"  type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع صورة البطاقة')"   oninput="setCustomValidity('')" name="terms">
              صورة البطاقة</u></p>

                                                  </div> 

                                                    <div class="form-group">
                                                  <p><input id="field_terms"  type="checkbox" required="" oninvalid="this.setCustomValidity(' برجاء التاكيد برفع جميع الاوراق المطلوبة')"   oninput="setCustomValidity('')" name="terms">
              اقر انا بان جميع الاوراق المطلوبة تم رفعها وفى حالة كانت الاوراق المرفوعة غير سليمة للكلية الحق فى رفضها</u></p>

                                                  </div>  
                                                    <input type="hidden" name="MM_insert" value="form1" />
                 
                            <button id="addBtn" type="submit" class="btn btn-lg btn-success btn-block"> تسـجيـل</button>
                  </form>
    
    
              </div>
                    <div class="col-md-1"></div>
    
    
          </div>
      </div>
                            </fieldset>
                        </form>
</div>
    </div>
            </div>
        </div>
    </div>
    <div id="loader"></div>
<!-- INCLUDE "t2228.php:PHP" -->
 
<script src="http://code.jquery.com/jquery.js"></script>
 
<!-- Latest compiled and minified JavaScript -->

</script>
<script>
	var password = document.getElementById("txtNewPassword")
  , confirm_password = document.getElementById("txtConfirmPassword");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;


$(document).ready(function () {

    $('input[type="radio"]').click(function () {
        if ($(this).attr("value") == "2") {
		   $(".Box").hide('slow');
    document.getElementById("tgned").checked = true;

			        }
        if ($(this).attr("value") == "1") {
            $(".Box").show('slow');
			    document.getElementById("tgned").checked = false;


        }
		
		if ($(this).attr("value") == "8") {
            $(".Box3").hide('slow');
			    document.getElementById("hkoma").checked = true;
 $(".Box2").show('slow');
			    document.getElementById("hor").checked = false;
        }
		if ($(this).attr("value") == "9") {
            $(".Box2").hide('slow');
			    document.getElementById("hor").checked = true;
				 $(".Box3").show('slow');
			    document.getElementById("hkoma").checked = false;

        }
		if ($(this).attr("value") == "10") {
            $(".Box3").hide('slow');
			    document.getElementById("hkoma").checked = true;
 $(".Box2").show('slow');
			    document.getElementById("hor").checked = false;
        }
		
		
		
		
    });

    $('input[type="radio"]').trigger('click');  // trigger the event
});
$("#degree").change(function () {
            if ($(this).val() == "1") {
				
				$(".Box5").show('slow');
			   

				}
				else if ($(this).val() == "2") {
					document.getElementById("shimaa").checked = true;


				$(".Box5").hide('slow');

				
				}

				
				else if ($(this).val() == "3") {

				$(".Box5").hide('slow');
			       document.getElementById("shimaa").checked = true;

				
				}
				
		});
	</script>
         

<?php include'l/footer.php'?>