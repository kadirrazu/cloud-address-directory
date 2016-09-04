<?php require_once('security-check.php'); ?>

<?php require_once('tpl-header.php'); ?>

<?php 
	
	require_once('database-connection.php');

	$valid = 1; 

	$recordId = isset($_GET['id']) ? trim($_GET['id']) : 0;

	$result = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE id = $recordId LIMIT 1");

	$rowcount = mysqli_num_rows($result);

	$row = mysqli_fetch_assoc( $result );

	if( $recordId == "" ){
		$valid = 0;
	}
	else
	{
		$valid = 1;
	}

	$metaResult = mysqli_query($connection, "SELECT * FROM kr_contact_meta WHERE contact_id = $recordId ORDER BY id ASC");

	$meta = array();
	
	while( $metaRow = mysqli_fetch_assoc( $metaResult ) )
	{
		$meta[$metaRow['key']] = $metaRow['value'];
	}

	if( isset($row['circle_id']) )
	{

		$groupResult = mysqli_query($connection, "SELECT * FROM kr_circle WHERE id = ".$row['circle_id']." LIMIT 1");

		$groupRow = mysqli_fetch_assoc( $groupResult );
	}

	$circleResult = mysqli_query($connection, "SELECT * FROM kr_circle ORDER BY circle_title ASC");

?>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">

            <?php require_once('flash-message.php'); ?>

            <?php if ( !$valid || $rowcount < 1 ) : ?>

				<div class="not-found-exception">
					<p class="not-found-message">
						Supplied record ID doesn't seems a valid one! 
					</p>
				</div>

			<?php else : ?>

				<h3 class="page-title">
					Edit Record: 
				</h3>

				<!-- form -->
	            <form action="process-edit-entry.php" method="POST">
				  
				  <div class="row">

					  <div class="form-group col-md-6">
					    <label for="first_name">First Name <span class="required-mark">*</span></label>
					    <input type="text" name="first_name" class="form-control" id="first_name" placeholder="First Name" value="<?php echo $row['first_name']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="last_name">Last Name <span class="required-mark">*</span></label>
					    <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name" value="<?php echo $row['last_name']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="email">Email Address <span class="required-mark">*</span></label>
					    <input type="email" name="email" class="form-control" id="email" placeholder="Email Address" value="<?php echo $row['email']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="mobile">Mobile <span class="required-mark">*</span></label>
					    <input type="text" name="mata[mobile]" class="form-control" id="mobile" placeholder="Mobile Number" value="<?php echo $meta['mobile']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="telephone">Telephone</label>
					    <input type="text" name="mata[telephone]" class="form-control" id="telephone" placeholder="Telephone" value="<?php echo $meta['telephone']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="address">Address</label>
					    <input type="text" name="mata[address]" class="form-control" id="address" placeholder="Address" value="<?php echo $meta['address']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="company">Company</label>
					    <input type="text" name="mata[company]" class="form-control" id="company" placeholder="Company" value="<?php echo $meta['company']; ?>">
					  </div>

					  <div class="form-group col-md-6">
					    <label for="company">Circle</label>
					    <select name="circle_id" class="form-control">
						  <?php while( $circle = mysqli_fetch_assoc($circleResult) ) : ?>
						  <option value="<?php echo $circle['id']; ?>" <?php echo ($circle['id'] == $groupRow['id']) ? 'selected="selected"' : '';  ?>>
						  	<?php echo $circle['circle_title']; ?>
						  </option>
						  <?php endwhile; ?>
						</select>
					  </div>

					  <input type="hidden" name="record_id" value="<?php echo $recordId; ?>">

				  </div>

				  <br>
				  
				  <button type="submit" class="btn btn-info">
				  	Update
				  </button>

				</form>
				<!-- /form -->

			<?php endif; ?>

        </div>
        <!-- /col-md-12 -->

    </div>
    <!-- /row -->

</div>
<!-- /content-body -->

<?php require_once('tpl-footer.php'); ?>