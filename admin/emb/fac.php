<?php
include("../../connections/post.php");
session_start();
if($_SESSION['acc_lvl']==2||$_SESSION['acc_lvl']==3){
include"e/header.php";
include"e/menu.php";//define total number of results you want per page  
    $results_per_page = 10;  
  
    //find the total number of results stored in the database  
    $query = "select *from temp,department where status=4 and temp.dept_id=department.dept_id";  
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
    $query = "SELECT *FROM temp,department where status=4 and temp.dept_id=department.dept_id LIMIT " . $page_first_result . ',' . $results_per_page;  
    $result = mysqli_query($post, $query);  
      
    //display the retrieved result on the webpage 
?>

<body>

    <div id="wrapper">



        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                
                
                    <h1 class="page-header">اضافة موافقة مجلس الكلية</h1>
                    
                    
                    
                </div>
                <!-- /.col-lg-12 -->
       
<table class="table" align="center width="100%">

    <tr align="center" style="background-color:coral">
      
      <td width="97"><strong> الاسم باللغة العربية  </strong></td>

                            <td width="85"><strong> البريد الإليكترونى  </strong></td>

                        <td width="70"><strong> رقم المحمول  </strong></td>

                                            <td width="70"><strong>عرض بيانات الطالب   </strong></td>
                                        <td width="70"><strong>مجلس الكلية   </strong></td>


    </tr>
     <?php while ($row = mysqli_fetch_array($result)) {  ?>
    
<tr align="center">
        
        <td><?php echo $row['arabic_name']; ?></td>

      <td><?php echo $row['dept_name']; ?></td>
      
      <td><?php echo $row['phone_mobile']; ?></td>
      <td><a href="show_std.php?id=<?php echo $row['std_id'];?>">اضغط هنا </a></td>
      <td><a href="add_fac_coun.php?id=<?php echo $row['std_id'];?>">اضغط هنا </a></td>

             </tr>
			    <?php
    }  
  
  
    //display the link of the pages in URL  
   
?>                                  </table>
<div align='center'>
<?php 
                 for($page = 1; $page<= $number_of_page; $page++) {  
        echo '<a href = "fac.php?page=' . $page . '">' . $page . ' </a>';  
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