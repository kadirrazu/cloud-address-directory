<?php require_once('security-check.php'); ?>

<?php require_once('tpl-header.php'); ?>

<?php 
	
	require_once('database-connection.php'); 

	$result = mysqli_query($connection, "SELECT * FROM kr_circle WHERE id != 1 ORDER BY circle_title ASC");

?>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">
            
            <h3 class="page-title">Add New Entry</h3>

            <?php require_once('flash-message.php'); ?>

			<!-- form -->
            <form action="process-add-new-entry.php" method="POST">
			  
			  <div class="row">

				  <div class="form-group col-md-6">
				    <label for="first_name">First Name <span class="required-mark">*</span></label>
				    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="last_name">Last Name <span class="required-mark">*</span></label>
				    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="email">Email Address <span class="required-mark">*</span></label>
				    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="mobile">Mobile <span class="required-mark">*</span></label>
				    <input type="text" name="mata[mobile]" class="form-control" id="mobile" placeholder="Mobile Number">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="telephone">Telephone</label>
				    <input type="text" name="mata[telephone]" class="form-control" id="telephone" placeholder="Telephone">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="address">Address</label>
				    <input type="text" name="mata[address]" class="form-control" id="address" placeholder="Address">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="company">Company</label>
				    <input type="text" name="mata[company]" class="form-control" id="company" placeholder="Company">
				  </div>

				  <div class="form-group col-md-6">
				    <label for="company">Circle</label>
				    <select name="circle_id" class="form-control">
					  <option value="1" selected>No Circle</option>
					  <?php while( $circle = mysqli_fetch_assoc($result) ) : ?>
					  <option value="<?php echo $circle['id']; ?>">
					  	<?php echo $circle['circle_title']; ?>
					  </option>
					  <?php endwhile; ?>
					</select>
				  </div>

			  </div>

			  <br>
			  
			  <button type="submit" class="btn btn-info">
			  	Submit
			  </button>

			</form>
			<!-- /form -->

        </div>
        <!-- /col-md-12 -->

    </div>
    <!-- /row -->

</div>
<!-- /content-body -->

<?php require_once('tpl-footer.php'); ?>