<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Post List</h2>
                <div class="block">  
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th width="5%">No.</th>
							<th width="15%">Post Title</th>
							<th width="10%">Image</th>
							<th width="10%">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$query = "SELECT * from tbl_slider";
						$slider = $db->select($query);
						if ($slider) {
							$i=0;
							while ($result = $slider->fetch_assoc()) {
								$i++;
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['title']; ?></td>
						
							<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px" /></td>
						
							<td>
						
					<?php 
					if (Session::get('userRole') == '0') { ?>
						 <a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are You sure to Delete !!')" href="deleteslider.php?sliderid=<?php echo $result['id']; ?>">Delete</a> 
					<?php } ?>
							
							</td>
						</tr>
						<?php } } ?>
					</tbody>
				</table>
	
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
    </script>
<?php include 'inc/footer.php'; ?>

