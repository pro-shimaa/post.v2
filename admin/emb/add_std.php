<script>
$(document).ready(function () {
          setTimeout(function () {
               
                $('a[href]#no-link').each(function () {
                    var href = this.href;
    
                    $(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        if (href.toLowerCase().indexOf("#") >= 0) {
    
                        } else {
                            window.open(href, '_blank');
                        }
                    });
                });
    
          }, 500);
    });
    </script>
<?php
include("../../connections/post.php");
session_start();
if($_SESSION['acc_lvl']==2||$_SESSION['acc_lvl']==3){
include"e/header.php";
include"e/menu.php";//define total number of results you want per page  
    $results_per_page = 10;  
  
    //find the total number of results stored in the database  
    $query = "select *from all_data where status=0";  
    $result = mysqli_query($post, $query);  
    $number_of_result = mysqli_num_rows($result);  
  
    //determine the total number of pages available  
    $number_of_page = ceil ($number_of_result / $results_per_page);  
  
    //determine which page number visitor is currently on  
    if (!isset ($_GET['page']) ) {  
        $page = 1;  
    } else {  
        $page = $_GET['page'];  
    }  
  
    //determine the sql LIMIT starting number for the results on the displaying page  
    $page_first_result = ($page-1) * $results_per_page;  
  
    //retrieve the selected results from database   
    $query = "SELECT *FROM all_data where status=0 LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($post, $query);  
      
    //display the retrieved result on the webpage 
?>

<body>

    <div id="wrapper">



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                
                    <h1 class="page-header" style="color:#900">طالب جديد</h1>
                    
                    
                    
                </div>
                <!-- /.col-lg-12 -->
       
<table class="table" align="center width="100%">

    <tr align="center" style="background-color: rgba(255, 255, 128, .5);">
      
      <td width="97"><strong> الاسم باللغة العربية  </strong></td>

                            <td width="85"><strong> البريد الإليكترونى  </strong></td>

                        <td width="70"><strong> القسم </strong></td>

                                            <td width="70"><strong>تحميل ملف الطالب  </strong></td>
                                            <td width="70"><strong>عرض بيانات الطالب   </strong></td>
                                        <td width="70"><strong>اضافة حالة الطالب   </strong></td>


    </tr>
     <?php while ($row = mysqli_fetch_array($result)) {  ?>
    
<tr align="center">
        
        <td><?php echo $row['arabic_name']; ?></td>

      <td><?php echo $row['email']; ?></td>
      
      <td><?php echo $row['dept_name']; ?></td>
      <?php
      	 $x='../log/'.$row['upload_path'];

	  ?>
      <td>
 <a href="#" onClick="window.location='<?php echo $x;?>';return false;" >Download</a></td>


      <td><?php
      
	  $y='show_std.php?id='.$row['std_id'];
	  ?>
 <a href="#" onClick="window.location='<?php echo $y;?>';return false;" >اضغط هنا</a></td>
 
      <td>
      <?php
      $z='add_status.php?id='.$row['std_id'];
	  ?>
 <a href="#" onClick="window.location='<?php echo $z;?>';return false;" >اضغط هنا</a></td>

             </tr>
			    <?php
    }  
  
  
    //display the link of the pages in URL  
   
?>                                  </table>
<div align='center'>
<?php 
                 for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "add_std.php?page=' . $page . '">' . $page . ' </a>';  
    }  
  
                

  ?>
  
  </div>
  
  
  </main>


     </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrappe
<?php
include"e/footer.php";
}
else
{
	echo'<h2 align="center">غير مسموح بدخول هذه الصفحة</h2>';
	header('Location:login.php');
exit;
	}
?>
<script>
$(document).ready(function () {
          setTimeout(function () {
               
                $('a[href]#no-link').each(function () {
                    var href = this.href;
    
                    $(this).removeAttr('href').css('cursor', 'pointer').click(function () {
                        if (href.toLowerCase().indexOf("#") >= 0) {
    
                        } else {
                            window.open(href, '_blank');
                        }
                    });
                });
    
          }, 500);
    });
    </script>