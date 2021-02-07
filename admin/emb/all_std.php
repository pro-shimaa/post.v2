<?php
include("../../connections/post.php");
session_start();
if($_SESSION['acc_lvl']==2||$_SESSION['acc_lvl']==3){
include"e/header.php";
include"e/menu.php";//define total number of results you want per page  
    $results_per_page = 10;  
  
    //find the total number of results stored in the database  
    $query = "select *from all_data ";  
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
    $query = "SELECT *FROM all_data  LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($post, $query);  
      
    //display the retrieved result on the webpage 
?>

<body>

    <div id="wrapper">



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                
                    <h1 class="page-header" style="color:#900">جميع الطلاب المتقدمين</h1>
                    
                    
                    
                </div>
                <!-- /.col-lg-12 -->
       
<table class="table" align="center width="100%">

    <tr align="center" style="background-color: rgba(255, 255, 128, .5);">
      
      <td width="97"><strong> الاسم باللغة العربية  </strong></td>
              <td width="70"><strong> رقم المحمول </strong></td>
\                          <td width="70"><strong> القسم </strong></td>
                           <td width="70"><strong> الحالة </strong></td>
                                  <td width="70"><strong> السبب </strong></td>
                                    <td width="70"><strong>عرض بيانات الطالب   </strong></td>
                                 <td width="70"><strong>اضافة حالة   </strong></td>
                                  <td width="70"><strong>تحميل ملف الطالب  </strong></td>

                                            <td width="70"><strong>  تحميل ملف الطالب بعد التعديل  </strong></td>



    </tr>
     <?php while ($row = mysqli_fetch_array($result)) {  ?>
    
<tr align="center">
        
        <td><?php echo $row['arabic_name']; ?></td>
      <td><?php echo $row['phone_mobile']; ?></td>
      <td><?php echo $row['dept_name']; ?></td>
      <td><?php  if($row['status'] ==0)
	  {
		  echo'طالب جديد';
		  }
		  
		   elseif($row['status'] ==1)
	  {
		  echo'طالب مكتمل اوراقه';
		  }
		   elseif($row['status'] ==2)
	  {
		  echo'اوراق غير مكتملة';
		  }
		   elseif($row['status'] ==3)
	  {
		  echo'مرفوض';
		  }
		  elseif($row['status'] ==8)
	  {
		  echo'الطالب قام بتعديل الطلب';
		  }
		   elseif($row['status'] ==4)
	  {
		  echo'تمت الموافقة من قبل مجلس القسم';
		  }
		   elseif($row['status'] ==5)
	  {
		  echo'تمت الرفض من قبل مجلس القسم';
		  }
		   elseif($row['status'] ==6)
	  {
		  echo'تمت الموافقة من قبل مجلس الكلية';
		  }
		   elseif($row['status'] ==7)
	  {
		  echo'تمت الرفض من قبل مجلس الكلية';
		  }
	  
	  
	  
	  ?></td>
    <td><?php echo $row['comment'];?></td>
<td>
      
      <?php
      $tt='show_std.php?id='.$row['std_id'];
	  
	  ?>
 <a href="#" onClick="window.location='<?php echo $tt;?>';return false;" >اضغط هنا</a></td>
<td>
<?php
      $z='add_status.php?id='.$row['std_id'];
	  ?>
 <a href="#" onClick="window.location='<?php echo $z;?>';return false;" >اضافة</a></td>
     
      
<td>
      <?php
      $ss='../log/'. $row['upload_path'];
	  ?>
 <a href="#" onClick="window.location='<?php echo $ss;?>';return false;" >اضغط هنا</a>
      
      </td>
            <td>
            <?php 
			$xx='../log/'.$row['upload_update_path'];
			if($row['upload_update_path']==null || $row['upload_update_path']=="")
			{?>
             <a href="#" onClick="window.location='all_std.php';return false;" >اضغط هنا</a>

				<?php }
				else
				{
			?>
 <a href="#" onClick="window.location='<?php echo $xx;?>';return false;" >اضغط هنا</a>
 <?php
				}
 ?>
</td>
             </tr>
			    <?php
    }  
  
  
    //display the link of the pages in URL  
   
?>                                  </table>
<div align='center'>
<?php 
                 for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "all_std.php?page=' . $page . '">' . $page . ' </a>';  
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
	}
?>
