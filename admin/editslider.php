<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL) {
    echo "<script>window.location = 'sliderlist.php'; </script>";
    //header("Location:postlist.php");
}else {
    $sliderid = $_GET['sliderid'];
}
?>
   
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = mysqli_real_escape_string($db->link,$_POST['title']);
                $permited = array('jpg','jpeg','png','gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
                $div = explode('.',$file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
                $uploaded_image = "uploads/slider/".$unique_image;
                if ($title == "") {
                    echo "<span class='error'>Field Must Not not be empty !</span>";
                }else {
                if (!empty($file_name)) {
                   
                    if($file_size>1048567){
                        echo "<div class='success'>Image size should be less than 1kb.</div>";
                    }
                    elseif(in_array($file_ext,$permited) === false){
                        echo "<div class='success'>You can upload only:-".implode(', ',$permited)."</div>";
                    }
                    else{
                    move_uploaded_file($file_temp,$uploaded_image);
                    $query="UPDATE tbl_slider
                    SET
                    title   = '$title',
                    image   = '$uploaded_image'
                    WHERE id = '$sliderid'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'>Slider Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>Slider not Updated !</div>";
                    }
                }
            

        }else {
            $query="UPDATE tbl_slider
                    SET
                    title   = '$title'
                    WHERE id = '$sliderid'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'>Slider Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>Slider not Updated !</div>";
                    }
            }
        }
            }
            ?>
                <div class="block">   
                    <?php 
                    $query = "select * from tbl_slider where id='$sliderid'";
                    $getslider = $db->select($query);
                    if ($getslider) {
                        while ($slideresult = $getslider->fetch_assoc()) {
                    ?>            
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $slideresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     

                    
                      
                        <tr>
                            <td>
                                <label>Upload New Slider</label>
                            </td>
                            <td>
                                <img src=" <?php echo $slideresult['image']; ?>" height="100px" width="250px" alt=""><br/>
                                <input type="file" name="image" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }} ?>
                </div>
            </div>
        </div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
setupTinyMCE();
setDatePicker('date-picker');
$('input[type="checkbox"]').fancybutton();
$('input[type="radio"]').fancybutton();
});
</script>
<script type="text/javascript">
$(document).ready(function () {
setupLeftMenu();
setSidebarHeight();
});
</script>

<?php include 'inc/footer.php'; ?>

  