<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
    echo "<script>window.location = 'userlist.php'; </script>";
    //header("Location:catlist.php");
}else {
    $id = $_GET['userid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>User Profile</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                echo "<script>window.location = 'userlist.php'; </script>";
                }

            ?>
                <div class="block">   
                    <?php 
                    $query = "select * from tbl_user where id='$id'";
                    $getuser = $db->select($query);
                    if ($getuser) {
                        while ($userresult = $getuser->fetch_assoc()) {
                    ?>            
                 <form action="" method="POST">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['name']; ?>" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['username']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $userresult['email']; ?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce">
                                <?php echo $userresult['detail']; ?>
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="OK" />
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

  