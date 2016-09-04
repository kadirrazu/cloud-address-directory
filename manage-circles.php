<?php require_once('security-check.php'); ?>

<?php require_once('tpl-header.php'); ?>

<?php 
	require_once('database-connection.php'); 

	$result = mysqli_query($connection, "SELECT * FROM kr_circle ORDER BY circle_title ASC");

	$rowcount = mysqli_num_rows($result);
?>

<div class="content-body">
    <div class="row">
        <div class="col-md-12">

            <?php require_once('flash-message.php'); ?>

            <?php if( $rowcount < 1 ) : ?>

				<div class="not-found-exception">
					<p class="not-found-message">
						Buddy, we found no Circle under your directory to display! 
					</p>
					<p>
						Consider creating 
						<a href="create-new-circle.php">
							a new one
						</a>
					</p>
				</div>

        	<?php else : ?>

        	<a href="create-new-circle.php" class="btn btn-info btn-sm">
        		<i class="fa fa-plus"></i>
        		Add New Circle
        	</a>

        	<br>
        	<br>

        	<!-- table-start -->
        	<table id="directory-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Circle Title</th>
						<th>Number of Records</th>
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
						<td>
							<a href="view-circle-contacts.php?circle_id=<?php echo $row['id']; ?>" title="View Entries Under This Circle">
								<?php echo $row['circle_title']; ?>
							</a>
						</td>
						<td>
							<?php 
								$resultCount = mysqli_query($connection, "SELECT * FROM kr_contacts WHERE circle_id = ".$row['id']."");

								$count = mysqli_num_rows($resultCount);
								echo $count;
							?>
						</td>
						<td>
							<a class="btn btn-default btn-sm" href="edit-circle.php?id=<?php echo $row['id']; ?>">
								<i class="fa fa-edit"></i>
								Edit
							</a>
							<?php if( $row['id'] != 1 ) : ?>
							<a class="btn btn-default btn-sm" href="delete-circle.php?id=<?php echo $row['id']; ?>">
								<i class="fa fa-trash"></i>
								Delete
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php $counter++; endwhile;  ?>
				</tbody>
			</table>
        	<!-- table-ends -->

        	<?php endif; ?>

        </div>
    </div>
</div>
<!-- /content-body -->

<?php require_once('tpl-footer.php'); ?>

