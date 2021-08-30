<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
    echo "<script>window.location = 'index.php'; </script>";
    //header("Location:index.php");
}else {
    $id = $_GET['pageid'];
}
?>
   <style>
       .actiondel{
           margin-left:10px;

       }
       .actiondel a{
        border: 1px solid #ddd;
        color: #444;
        cursor: pointer;
        font-size: 20px;
        padding: 2px 10px;
        background:#F0F0F0;
        font-weight:normal;
       }
   </style>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Edit Page</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = mysqli_real_escape_string($db->link,$_POST['name']);
                $body = mysqli_real_escape_string($db->link,$_POST['body']);
              
                if ($name == "" ||$name == "" ) {
                    echo "<span class='error'>Field Must Not not be empty !</span>";
                }
                else{
                    $query = "UPDATE tbl_page
                    SET
                    name = '$name',
                    body = '$body'
                    WHERE id = '$id';
                    ";
                    $updatedrow = $db->update($query);
                 if($updatedrow){
                    echo "<div class='success'>Page Updated Successfully.</div>";
                }
                else{
                    echo "<div class='error'>Page not Updated !</div>";
                }
            }
            }
            ?>
                <div class="block">   
                <?php
                $pagequery = "select * from tbl_page where id='$id'";
                $pagedetails = $db->select($pagequery);
                if ($pagedetails) {
                    while ($result = $pagedetails->fetch_assoc()) {
                ?>            
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea name="body" class="tinymce">
                                <?php echo $result['body']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                                <span class="actiondel"><a onclick="return confirm('Are You sure to Delete !!')" href="deletepage.php?delpage=<?php echo $result['id'] ?>">Delete</a></span>
                            </td>
                        </tr>
                    </table>
                    </form>
                    <?php }}?>
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

  