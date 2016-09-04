<?php require_once('security-check.php'); ?>

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

<html>
<head>
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="css/jquery.dataTables.min.css" rel="stylesheet">-->
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Roboto+Slab|Shadows+Into+Light" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">

			<div class="content-view single-entry-view">

				<?php if ( !$valid || $rowcount < 1 ) : ?>

					<div class="not-found-exception">
						<p class="not-found-message">
							Supplied record ID doesn't seems a valid one! 
						</p>
					</div>

				<?php else : ?>

					<h3 class="page-title">
						<u>Record Details:</u>
					</h3>

					<table class="table table-striped table-hover">
						<tr>
							<th>First Name</th>
							<td>
								: <?php echo $row['first_name']; ?>
							</td>
						</tr>
						<tr>
							<th>Last Name</th>
							<td>
								: <?php echo $row['last_name']; ?>
							</td>
						</tr>
						<tr>
							<th>Email Address</th>
							<td>
								: <?php echo $row['email']; ?>
							</td>
						</tr>
						<tr>
							<th>Mobile</th>
							<td>
								: <?php echo $meta['mobile']; ?>
							</td>
						</tr>
						<tr>
							<th>Telephone</th>
							<td>
								: <?php echo $meta['telephone']; ?>
							</td>
						</tr>
						<tr>
							<th>Address</th>
							<td>
								: <?php echo $meta['address']; ?>
							</td>
						</tr>
						<tr>
							<th>Company</th>
							<td>
								: <?php echo $meta['company']; ?>
							</td>
						</tr>
						<tr>
							<th>Circle</th>
							<td>
								: <?php echo $groupRow['circle_title']; ?>
							</td>
						</tr>
					</table>

				<?php endif ?>
				
			</div>
			<!-- content-view -->

        </div>
        <!-- /col-md-12 -->

    </div>
    <!-- /row -->

</div>
<!-- /content-body -->

<div class="modal-footer">
	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>

</body>
</html>