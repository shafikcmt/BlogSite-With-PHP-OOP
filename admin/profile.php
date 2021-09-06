<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
$userid     = Session::get('userId');
$userrole   = Session::get('userRole');
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name       = mysqli_real_escape_string($db->link,$_POST['name']);
                $username   = mysqli_real_escape_string($db->link,$_POST['username']);
                $email      = mysqli_real_escape_string($db->link,$_POST['email']);
                $detail     = mysqli_real_escape_string($db->link,$_POST['detail']);
               
            $query="UPDATE tbl_user
                    SET
                    name     = '$name',
                    username = '$username',
                    email    = '$email',
                    detail   = '$detail'
                    WHERE id = '$userid'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'> User Data Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>User Data not Updated !</div>";
                    }
                }

            ?>
                <div class="block">   
                    <?php 
                    $query = "select * from tbl_user where id='$userid' AND role='$userrole'";
                    $getuser = $db->select($query);
                    if ($getuser) {
                        while ($userresult = $getuser->fetch_assoc()) {
                    ?>            
                 <form action="" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" name="name" value="<?php echo $userresult['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" name="username" value="<?php echo $userresult['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" name="email" value="<?php echo $userresult['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea name="detail" class="tinymce">
                                <?php echo $userresult['detail']; ?>
                                </textarea>
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

  