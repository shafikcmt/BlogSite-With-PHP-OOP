<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php
if (!isset($_GET['replymsgid']) || $_GET['replymsgid'] == NULL) {
    echo "<script>window.location = 'inbox.php'; </script>";
    //header("Location:catlist.php");
}else {
    $id = $_GET['replymsgid'];
}
?>
        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Message</h2>
            <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $to         = $fm->validation($_POST['toEmail']);
            $from       = $fm->validation($_POST['fromEmail']);
            $subject    = $fm->validation($_POST['subject']);
            $message    = $fm->validation($_POST['message']);

            $sendmail = mail($to ,$subject ,$message ,$from );
            if ($sendmail) {
                $msg =  "<div class='success'>Message Sent Successfully.</div>";
            }else {
                $msg = "<div class='error'>Message Not Send !</div>";
            }
            }
            ?>
                <div class="block">               
                 <form action="" method="POST">
                 <?php 
						$query = "select * from tbl_contact where id='$id'";
						$contact = $db->select($query);
						if ($contact) {
							while ($result = $contact->fetch_assoc()) {
					?>
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly  name="toEmail" value="<?php echo $result['email']?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text"  name="fromEmail" placeholder="Please Enter Your Email Address." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                            <input type="text"  name="subject" placeholder="Please Enter Your subject." class="medium" />

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Message</label>
                            </td>
                            <td>
                                <textarea name="message"  class="tinymce">
                               
                                </textarea>
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Send" />
                            </td>
                        </tr>
                    </table>
                    <?php } } ?>
                    </form>
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

  