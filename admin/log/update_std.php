<?php
session_start();
ob_start();
if($_SESSION['email']!=""){

include'l/header.php';
?>
<?php
include("../../connections/post.php");


?>

<?php
mysqli_set_charset($post,"utf8");
$query_Recordset1= "select * from all_data where email='".$_SESSION['email']."'";
$Recordset1 = mysqli_query($post, $query_Recordset1);
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
if($row_Recordset1['status']==2||$row_Recordset1['status']==0){	
$errMSG="";
// start insert code
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
	
	
	$textFile = $_FILES['file']['name'];

  $tmp_dir = $_FILES['file']['tmp_name'];
  $txtSize = $_FILES['file']['size'];
  
  $upload_dir = 'upload_update/'; // upload directory
 
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
     $errMSG = "Sorry, your file is too large.";
    }
   }
   else{
    $errMSG = "لم يتم اضافة التعديلات حيث ان الملف الذى قمت برفعه ليس امتدد zip او RAR  برجاء رفع الملفات مضغوطة بصيغة rar او zip";  
   }
   
if($errMSG ==""){

	
 mysqli_set_charset($post,"utf8");

$sql="update  temp set email = '".$_POST["email"]."',degree_id = '".$_POST["degree"]."' , arabic_name = '".$_POST["arname"]."',english_name= '".$_POST["ennmae"]."' ,gender = '".$_POST["inlineRadioOptions"]."' ,birthdate = '".$_POST["birthdate"]."' ,birthplace='".$_POST["birthplace"]."',country='".$_POST["country"]."' ,state='".$_POST["state"]."',region='".$_POST["region"]."',address='".$_POST["address"]."' ,phone_home='".$_POST["phone"]."' ,phone_mobile='".$_POST["mobile"]."',            id_number=".$_POST["id_no"].",id_place='".$_POST["id_place"]."',id_date='".$_POST["id_date"]."',jop='".$_POST["work"]."',jop_phone='".$_POST["work_phone"]."',dept_id='".$_POST["department"]."',special='".$_POST["special"]."',grad_place='".$_POST["grad_place"]."',grade_id='".$_POST["grade"]."',grade_year='".$_POST["grade_year"]."',upload_update_path='".$path."'
,update_std=1,status=8 where std_id=".$_POST["std_id"]."";
            mysqli_query($post, $sql);
			
header('Location: success_update.php');
exit;
 
}}


?>


<body>

    <div class="container" >
        <div class="row" >
            <div class="col-md-29 col-md-offset-29" >
                <div class="register-panel panel panel-default">
                    <div class="panel-heading">
                        <h1 class="panel-title" align="center" style="color:#006"><strong>تسجيل الطالب للدراسات العليا</strong></h1>

                        <h3 align="center"><?php echo $errMSG;?></h3>
                    </div>
                    <div class="panel-body">
                     <form method="post"  class="mt-5 px-4" name="form1" action="update_std.php" enctype="multipart/form-data"> 
                                <div class="form-group row">
        <div class="col-sm-4">
                                         <label for="inputPassword" class=" col-form-label">الاسم باللغة العربية<span style="color:#F00">*</span></label>


                 <input type="text"  id="ar" class="form-control" name="arname" value="<?php echo $row_Recordset1['arabic_name'];?>" oninvalid="this.setCustomValidity('من فضلك ادخل الاسم رباعى باللغة العربية')" placeholder="الاسم رباعى باللغة العربية" autofocus pattern="[ء-ي\s]+"  required oninput="setCustomValidity('')">
                                </div>
                              
        <div class="col-sm-4">
                                                 <label for="inputPassword" class=" col-form-label">الاسم باللغة الانجليزية<span style="color:#F00">*</span></label>

                                <input type="text" class="form-control" id="inputName" name="ennmae" placeholder="الاسم رباعى اللغة الانجليزية" required=""  value="<?php echo $row_Recordset1['english_name'];?>" pattern="[a-zA-Z0-9\s]+" oninvalid="this.setCustomValidity('من فضلك ادخل الاسم رباعى باللغة الانجليزية')"   oninput="setCustomValidity('')">
                                
                            </div>
                                </div>
                                
                                            <div class="form-group row">
                                                    <div class="col-sm-8">
                                                                                                     <label for="inputPassword" class=" col-form-label">البريد الإليكترونى<span style="color:#F00">*</span></label>


                                <input type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$" class=" form-control" id="inputAddress" value="<?php echo $row_Recordset1['email'];?>" name="email" placeholder="البريد الالكترونى " required="" oninvalid="this.setCustomValidity('من فضلك ادخل بريد اليكترونى صحيح')"   oninput="setCustomValidity('')" >
                            </div>
                            </div>
                            
                       <div class="form-row">
                         
                            <div class="form-group row" >
                                                    <div class="col-sm-8">
                                                                                                     <label for="inputPassword" class=" col-form-label">الدرجة المتقدم لها<span style="color:#F00">*</span></label>
      
  <select name="degree" class="form-control" id="degree" required>
    
      <?php
        $records = mysqli_query($post, "SELECT * From degree");  // Use select query here 

        while($d = mysqli_fetch_array($records))
        {
           ?> 
  <option value="<?php echo ($d['degree_id']); ?>"  <?php if($d['degree_id']==$row_Recordset1['degree_id']){?> selected="selected"<?php }?>><?php echo $d['degree']?></option>
  
  
      <?php  }	
    ?>
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

                                    <input type="text" class="alaa form-control phoneNum" value ="<?php echo $row_Recordset1['phone_home'];?>" name="phone" id="inputPhone"
                                        placeholder="رقم التليفون">
                                </div>
                                <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">رقم المحمول<span style="color:#F00">*</span></label>

                                    <input type="text" class="form-control phoneNum" value ="<?php echo $row_Recordset1['phone_mobile'];?>" name="mobile" id="inputPhone2"
                                        placeholder="رقم المحمول " pattern=".{11,}"  minlength="11" maxlength="11" required="" oninvalid="this.setCustomValidity('من فضلك ادخل رقم الهاتف المحمول الخاص بك')"   oninput="setCustomValidity('')">
                                </div>
                            </div>
                            
                          
                              
                            
                            <div class="form-group row">
 <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">تاريخ الميلاد<span style="color:#F00">*</span></label>


                                <input type="date" class=" form-control" name="birthdate"  value="<?php echo $row_Recordset1['birthdate'];?>" id="inputAddress" placeholder="تاريخ الميلاد		 " required="" oninvalid="this.setCustomValidity('من فضلك ادخل تاريخ الميلاد')"   oninput="setCustomValidity('')">
                            </div>
                                                       <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">جهة الميلاد<span style="color:#F00">*</span></label>
                                <input type="text" value="<?php echo $row_Recordset1["birthplace"];?>" class=" form-control" id="inputAddress" name="birthplace" placeholder="جهة الميلاد " required="" oninvalid="this.setCustomValidity('من فضلك ادخل  جهة الميلاد')"   oninput="setCustomValidity('')">
                            </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group col-md-4">
                                                                            <label for="inputPassword" class=" col-form-label">البلد</label>

                                    <input type="text" name="state" value="<?php echo $row_Recordset1["state"];?>" class="alaa form-control phoneNum" id="inputPhone"
                                        placeholder="البلد">
                                </div>
                                <div class="form-group col-md-4">
                                                                            <label for="inputPassword" class=" col-form-label">المركز</label>

                                    <input type="text" class="form-control phoneNum" value="<?php echo $row_Recordset1["region"];?>" name="region" id="inputPhone2"
                                        placeholder="المركز ">
                                </div>
                                </div>
                            <div class="form-group row">
                                                            <div class="form-group col-md-4">
                                            <label for="inputPassword" class=" col-form-label">المحافظة<span style="color:#F00">*</span></label>

                                    <input type="text" class="form-control phoneNum" value="<?php echo $row_Recordset1["country"];?>"  name="country" id="inputPhone2"
                                        placeholder="المحافظة " required="" oninvalid="this.setCustomValidity(' من فضلك ادخل  المحافظة   ')"   oninput="setCustomValidity('')">
                              </div>    
                            
                            <div class="form-group col-md-4">
                                                                        <label for="inputPassword" class=" col-form-label">العنوان<span style="color:#F00">*</span></label>

  <input type="text" class=" form-control" name="address"value="<?php echo $row_Recordset1["address"];?>"  id="inputAddress" placeholder="عنوان محل الاقامة الذى يتم ارسال الخطابات عليه " required="" oninvalid="this.setCustomValidity('من فضلك ادخل عنوان محل الاقامة الذى سيتم ارسال الخطابات عليه')"   oninput="setCustomValidity('')">
                            </div>
                            </div>
                            <div class="form-group row">
                                                                                 <div class="form-group col-md-8">
                                                   <label for="inputPassword" class=" col-form-label">رقم بطاقة الرقم القومى<span style="color:#F00">*</span></label>

                                <input type="text" class=" form-control" name="id_no" value="<?php echo $row_Recordset1['id_number'];?>" id="inputAddress" placeholder="بطاقة الرقم القومى " required="" oninvalid="this.setCustomValidity('من فضلك ادخل رقم البطاقة المكون من 14 رقم')"   oninput="setCustomValidity('')" minlength="14" maxlength="14">
                            </div>
                            </div>
                                <div class="form-group row">
                                <div class="form-group col-md-4">
                                                                                   <label for="inputPassword" class=" col-form-label">جهة صدور بطاقة الرقم القومى<span style="color:#F00">*</span></label>

   <input type="text" class="alaa form-control phoneNum"value="<?php echo $row_Recordset1["id_place"];?>"  name="id_place" id="inputPhone"
    placeholder="جهة صدورها" required="" oninvalid="this.setCustomValidity('من فضلك ادخل جهة صدور البطاقة')"   oninput="setCustomValidity('')">
                                </div>

                                <div class="form-group col-md-4">
                                                                                   <label for="inputPassword" class=" col-form-label">تاريخ صدور بطاقة الرقم القومى<span style="color:#F00">*</span></label>

                                    <input type="text" value="<?php echo $row_Recordset1["id_date"];?>" class="form-control phoneNum" id="inputPhone2" name="id_date"
        placeholder="تاريخ الصدور " required="" oninvalid="this.setCustomValidity('من فضلك ادخل تاريخ الصدور')"   oninput="setCustomValidity('')">
                                </div>
                            </div>
                             
                              <div class="form-group row">

                                <div class="form-group col-md-4">
                                                                                                                                                 <label for="inputPassword" class=" col-form-label">جهة العمل وعنوانه</label>

                                    <input type="text" class="alaa form-control phoneNum" value="<?php echo $row_Recordset1["jop"];?>" name="work" id="inputPhone"
                                        placeholder="جهة العمل وعنوانه">
                                </div>
                                <div class="form-group col-md-4">
                                                                                                                   <label for="inputPassword" class=" col-form-label">تليفون العمل</label>

                                    <input type="text" value="<?php echo $row_Recordset1["jop_phone"];?>" class="form-control phoneNum" id="inputPhone2" name="work_phone"
                                        placeholder="تليفون العمل ">
                                </div>
                            </div>
                <div class="form-group row">
                                                <div class="form-group col-md-8">

    <label  for="department">	القسم:<span style="color:#F00">*</span></label>
      
 <select name="department"class=" form-control"  required>
     <?php
        $records = mysqli_query($post, "SELECT * From department");  // Use select query here 

        while($d = mysqli_fetch_array($records))
        {
           ?> 
  
  <option value="<?php echo ($d['dept_id']); ?>"  <?php if($d['dept_id']==$row_Recordset1['dept_id']){?> selected="selected"<?php }?>><?php echo $d['dept_name']?></option>
  
  
      <?php  }	?>
  </select>

</div>
  </div>
      <div class="form-group row">
       <div class="form-group col-md-4">
                                                   <label for="inputPassword" class=" col-form-label">التخصص المكتوب فى الشهادة <span style="color:#F00">*</span></label>
            <input type="text" class=" form-control" name="special" value="<?php echo $row_Recordset1["special"];?>" id="inputAddress" placeholder="التخصص المكتوب فى الشهادة المؤقته " required="" oninvalid="this.setCustomValidity('من فضلك ادخل التخصص المكتوب فى الشهادة')"   oninput="setCustomValidity('')">
                       </div>
                                                  
       <div class="form-group col-md-4">
                                                          <label for="inputPassword" class=" col-form-label">جهة التخرج <span style="color:#F00">*</span></label>

                      <input type="text" class=" form-control" name="grad_place" value="<?php echo $row_Recordset1["grad_place"];?>"  id="inputAddress" placeholder="جهة التخرج " required="" oninvalid="this.setCustomValidity('من فضلك ادخل جهة التخرج')"   oninput="setCustomValidity('')">
                            </div>
       <div class="form-group col-md-4">
                                                                 <label for="inputPassword"  class=" col-form-label">سنة التخرج <span style="color:#F00">*</span></label>

                      <input type="text" class=" form-control" value="<?php echo $row_Recordset1["grade_year"];?>" id="inputAddress" required="" oninvalid="this.setCustomValidity('من فضلك ادخل سنة التخرج')"   oninput="setCustomValidity('')" name="grade_year" placeholder="سنة التخرج ">
                       </div>
                            </div>
                              <div class="form-group row">
                                     <div class="form-group col-md-8">

    <label  for="grade">:التقدير التراكمى	<span style="color:#F00">*</span></label>
   <select name="grade" class=" form-control"  required>

    <?php
        $records = mysqli_query($post, "SELECT * From grade");  // Use select query here 

        while($d = mysqli_fetch_array($records))
        {
           ?> 
  
  <option value="<?php echo ($d['grade_id']); ?>"  <?php if($d['grade_id']==$row_Recordset1['grade_id']){?> selected="selected"<?php }?>><?php echo $d['grade']?></option>
  
  
      <?php  }	?>
  </select>

  </div>

                           
                       </div>
                                     <div class="form-group row">
                 <div class="form-group col-md-8">
<?php
      
	   $x=$row_Recordset1['upload_path'];
	  ?>
 <a href="#" onClick="window.location='<?php echo $x;?>';return false;" >تحميل الملفات التى سبق رفعها</a></td>

                      
                                                  </div>  </div>
                                                  <div class="form-group row">
                 <div class="form-group col-md-8">
 <label>برجاء استكمال الاوراق zip او rar هى الامتدادات المسموح فقط برفعها <span style="color:#F00">*</span></label>

                      <input type="file" class=" form-control" id="inputAddress" name="file" required="" oninvalid="this.setCustomValidity('من فضلك ادخل االورق المطلوب مضغوط بصيغة RAR او ZIP ')"   oninput="setCustomValidity('')">
                                                  </div>  </div>
                                               
                                                    <input type="hidden" name="MM_insert" value="form1" />
                                                    <input type="hidden" name="std_id" value="<?php echo $row_Recordset1['std_id'];?>">    

                 
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
<?php 

}
else
{
header('Location: not_allow.php');
exit;
	}

 include'l/footer.php';
}


else
{
	
	header('Location: login.php');
exit;
	}
?>