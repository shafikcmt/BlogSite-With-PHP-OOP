<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<style>
    .leftside{
        float:left;
        width:70%;
    }
    .rightside{
        float:left;
        width:20%;
    }
    .rightside img{
        height:160px;
        width:170px;
    }
</style>

        <div class="grid_10">
		
<div class="box round first grid">
    <h2>Update Site Title and Description</h2>

    <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $title = $fm->validation($_POST['title']);
                $slogan = $fm->validation($_POST['slogan']);
                $title = mysqli_real_escape_string($db->link,$title);
                $slogan = mysqli_real_escape_string($db->link,$slogan);
              
                $permited = array('png');
                $file_name = $_FILES['logo']['name'];
                $file_size = $_FILES['logo']['size'];
                $file_temp = $_FILES['logo']['tmp_name'];
                $div = explode('.',$file_name);
                $file_ext = strtolower(end($div));
                $same_image = 'logo'.'.'.$file_ext;
                $uploaded_image = "uploads/".$same_image;
                if ($title == "" ||$slogan == "") {
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
                    $query="UPDATE title_slogan
                    SET
                    title   = '$title',
                    slogan    = '$slogan',
                    logo   = '$uploaded_image'
                    WHERE id = '1'";
                    $updated_row = $db->update($query);
                    if($updated_row){
                        echo "<div class='success'>Data Updated Successfully</div>";
                    }
                    else{
                        echo "<div class='error'>Data not Updated !</div>";
                    }
                }
            

        }else {
            $query="UPDATE title_slogan
                    SET
                    title   = '$title',
                    slogan    = '$slogan'
                    WHERE id = '1'";
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
<?php
    $query = "select * from title_slogan where id = '1'";
    $blog_title = $db->select($query);
    if ($blog_title) {
        while ($result = $blog_title->fetch_assoc()) {
?>
        <div class="block sloginblock">
            <div class="leftside">          
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['title']; ?>"  name="title" class="medium" />
                    </td>
                </tr>
                    <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['slogan']; ?>" name="slogan" class="medium" />
                    </td>
                </tr>
                    
                <tr>
                    <td>
                        <label>Upload Logo</label>
                    </td>
                    <td>
                        <input type="file" name="logo" />
                    </td>
                </tr>
                
                    <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
            </div> 
           
            <div class="rightside">
                <img src="<?php echo $result['logo']; ?>" alt="Logo">
            </div>
        </div>
        <?php }} ?> 
    </div>
</div>
        <?php include 'inc/footer.php'; ?>
