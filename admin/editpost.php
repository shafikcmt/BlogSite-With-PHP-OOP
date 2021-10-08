<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['editpostid']) || $_GET['editpostid'] == NULL) {
    echo "<script>window.location = 'postlist.php'; </script>";
    //header("Location:postlist.php");
}else {
    $postid = $_GET['editpostid'];
}
?>
   
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = mysqli_real_escape_string($db->link,$_POST['title']);
                $cat = mysqli_real_escape_string($db->link,$_POST['cat']);
                $body = mysqli_real_escape_string($db->link,$_POST['body']);
                $tags = mysqli_real_escape_string($db->link,$_POST['tags']);
                $author = mysqli_real_escape_string($db->link,$_POST['author']);
                $userid = mysqli_real_escape_string($db->link,$_POST['userid']);

                $permited = array('jpg','jpeg','png','gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];
                $div = explode('.',$file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()),0,10).'.'.$file_ext;
                $uploaded_image = "uploads/".$unique_image;
                if ($title == "" ||$cat == "" ||$body == "" ||$tags == "" ||$author == "" ) {
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
                    $query="UPDATE tbl_post
                    SET
                    cat     = '$cat',
                    title   = '$title',
                    body    = '$body',
                    image   = '$uploaded_image',
                    author  = '$author',
                    tags    = '$tags',
                    userid  = '$userid'
                    WHERE id = '$postid'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'>Data Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>Data not Updated !</div>";
                    }
                }
            

        }else {
            $query="UPDATE tbl_post
                    SET
                    cat     = '$cat',
                    title   = '$title',
                    body    = '$body',
                    author  = '$author',
                    tags    = '$tags',
                    userid  = '$userid'
                    WHERE id = '$postid'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'>Data Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>Data not Updated !</div>";
                    }
            }
        }
            }
            ?>
                <div class="block">   
                    <?php 
                    $query = "select * from tbl_post where id='$postid'";
                    $getpost = $db->select($query);
                    if ($getpost) {
                        while ($postresult = $getpost->fetch_assoc()) {
                    ?>            
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" name="title" value="<?php echo $postresult['title']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="cat">
                                    <option>Select Category</option>
                                    <?php 
                                    $query = "select * from tbl_category";
                                    $category = $db->select($query);
                                    if ($category) {
                                       while ($result = $category->fetch_assoc()) {
                                    ?>
                                    <option 
                                    <?php 
                                    if ($postresult['cat'] == $result['id']) { ?>
                                        selected = "selected"
                                   <?php } ?>
                                    value="<?php echo $result['id']; ?>"><?php echo $result['name']; ?></option>
                                  <?php }} ?>
                                </select>
                            </td>
                        </tr>
                   
                    
                      
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <img src=" <?php echo $postresult['image']; ?>" height="80px" width="200px" alt=""><br/>
                                <input type="file" name="image" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                <?php echo $postresult['body']; ?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" name="tags" value="<?php echo $postresult['tags']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $postresult['author']; ?>" name="author" class="medium" />
                                <input type="hidden" name="userid" value="<?php echo Session::get('userId') ?>" class="medium" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Save" />
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

  