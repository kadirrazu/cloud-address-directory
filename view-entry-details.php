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

?>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">

            <?php require_once('flash-message.php'); ?>

			<div class="content-view">

				<?php if ( !$valid || $rowcount < 1 ) : ?>

					<div class="not-found-exception">
						<p class="not-found-message">
							Supplied record ID doesn't seems a valid one! 
						</p>
					</div>

				<?php else : ?>

					<h3 class="page-title">
						Record Details: 
					</h3>

					<div class="row">
						<div class="col-md-6 record-field">
							<div>
								<strong>First Name</strong>:
								<span>
									<?php echo $row['first_name']; ?>
								</span>
							</div>
						</div>
						<div class="col-md-6 record-field">
							<div>
								<strong>Last Name</strong>:
								<span>
									<?php echo $row['last_name']; ?>
								</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 record-field">
							<div>
								<strong>Email Address</strong>:
								<span>
									<?php echo $row['email']; ?>
								</span>
							</div>
						</div>
						<div class="col-md-6 record-field">
							<div>
								<strong>Mobile</strong>:
								<span>
									<?php echo $meta['mobile']; ?>
								</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 record-field">
							<div>
								<strong>Telephone</strong>:
								<span>
									<?php echo $meta['telephone']; ?>
								</span>
							</div>
						</div>
						<div class="col-md-6 record-field">
							<div>
								<strong>Address</strong>:
								<span>
									<?php echo $meta['address']; ?>
								</span>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 record-field">
							<div>
								<strong>Company</strong>:
								<span>
									<?php echo $meta['company']; ?>
								</span>
							</div>
						</div>
						<div class="col-md-6 record-field">
							<div>
								<strong>Circle</strong>:
								<span>
									<?php echo $groupRow['circle_title']; ?>
								</span>
							</div>
						</div>
					</div>

					<br>

					<a href="edit-entry-details.php?id=<?php echo $row['id']; ?>" class="btn btn-info">
						<i class="fa fa-edit"></i>
						Edit this Record
					</a>

				<?php endif ?>
				
			</div>
			<!-- content-view -->

        </div>
        <!-- /col-md-12 -->

    </div>
    <!-- /row -->

</div>
<!-- /content-body -->

<?php require_once('tpl-footer.php'); ?>