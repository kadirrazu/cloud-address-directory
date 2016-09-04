<?php 
/**
 * Project Title: Cloud Address Directory
 * Coded By: Md. Abdul Kadir
 * Description: Simple CRUD implementation using CorePHP and MySQL. This project follow simple security implementations to templating system using partials. It may be an ideal project for the beginers to dig in. 
 */
?>
<?php 
	require_once('database-connection.php'); 

	$circleId = isset($_GET['circle_id']) ? trim($_GET['circle_id']) : 0;

	$result = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE circle_id = $circleId ORDER BY first_name ASC, last_name ASC");

	$rowcount = mysqli_num_rows($result);
?>

<div class="content-body">
    <div class="row">
        <div class="col-md-12">

            <?php require_once('flash-message.php'); ?>

            <?php if( $rowcount < 1 ) : ?>

				<div class="not-found-exception">
					<p class="not-found-message">
						Buddy, system was unable to found any entries under your selected circle! 
					</p>
					<p>
						Consider creating 
						<a href="create-new-entry.php">
							a new one
						</a>
					</p>
				</div>

        	<?php else : ?>

        	<div class="text-success">
        		<strong>Entries from the Circle: </strong>
        		<?php 
        			$resultCircle = mysqli_query($connection, "SELECT circle_title FROM kr_circle WHERE id = $circleId LIMIT 1");
        			$circle = mysqli_fetch_array($resultCircle, MYSQLI_ASSOC);
        			echo $circle['circle_title'];
        		?>
        	</div>

        	<br>

        	<!-- table-start -->
        	<table id="directory-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Sr.</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$counter = 1;
						while( $row = mysqli_fetch_array($result, MYSQLI_ASSOC) ) : 
					?>
					<tr>
						<td><?php echo $counter; ?></td>
						<td><?php echo $row['first_name']; ?></td>
						<td><?php echo $row['last_name']; ?></td>
						<td><?php echo $row['email']; ?></td>
						<td>
							<a class="btn btn-default btn-sm" data-toggle="modal" href="view-single-entry.php?id=<?php echo $row['id']; ?>" data-target="#myModal">
								<i class="fa fa-paper-plane"></i>
								Instant View
							</a>
							<a class="btn btn-default btn-sm" href="view-entry-details.php?id=<?php echo $row['id']; ?>">
								<i class="fa fa-info-circle"></i>
								Details
							</a>
							<a class="btn btn-default btn-sm" href="edit-entry-details.php?id=<?php echo $row['id']; ?>">
								<i class="fa fa-edit"></i>
								Edit
							</a>
							<a class="btn btn-default btn-sm" href="delete-entry.php?id=<?php echo $row['id']; ?>">
								<i class="fa fa-trash"></i>
								Delete
							</a>
						</td>
					</tr>
					<?php $counter++; endwhile;  ?>
				</tbody>
			</table>
        	<!-- table-ends -->

        	<br>      	

        	<div>
        		<!-- Export Buttons -->
	        	<a href="export-all-entries.php" class="btn btn-warning btn-sm" target="_blank">
	        		<i class="fa fa-list"></i>
	        		Export as HTML
	        	</a>
	        	<a href="export-all-entries-pdf.php" class="btn btn-warning btn-sm" target="_blank">
	        		<i class="fa fa-file"></i>
	        		Export as PDF
	        	</a>
        	</div>

        	<?php endif; ?>

        	<!-- Modal -->
			<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			      </div>
			      <div class="modal-body">
			        
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<!-- /.modal -->

        </div>
    </div>
</div>
<!-- /content-body -->