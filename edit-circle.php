<?php require_once('security-check.php'); ?>

<?php require_once('tpl-header.php'); ?>

<?php 
	
	require_once('database-connection.php');

	$recordId = isset($_GET['id']) ? trim($_GET['id']) : 0;

	$result = mysqli_query($connection, "SELECT * FROM kr_circle WHERE id = $recordId LIMIT 1");

	$rowcount = mysqli_num_rows($result);

	$row = mysqli_fetch_assoc( $result );

?>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">

            <?php require_once('flash-message.php'); ?>

            <?php if ( $rowcount < 1 ) : ?>

				<div class="not-found-exception">
					<p class="not-found-message">
						Supplied record ID doesn't seems a valid one! Would you please check?
					</p>
				</div>

			<?php else : ?>

				<h3 class="page-title">
					Edit Circle: 
				</h3>

				<!-- form -->
	            <form action="process-edit-circle.php" method="POST">
				  
				  <div class="row">

					  <div class="form-group col-md-12">
					    <label for="circle_id_num">Circle ID <span class="required-mark">*</span></label>
					    <input type="text" readonly="readonly" name="circle_id_num" class="form-control" id="circle_id_num" placeholder="Circle ID" value="<?php echo $row['id']; ?>">
					  </div>

					  <div class="form-group col-md-12">
					    <label for="circle_title">Circle Title <span class="required-mark">*</span></label>
					    <input type="text" name="circle_title" class="form-control" id="circle_title" placeholder="Circle Title" value="<?php echo $row['circle_title']; ?>">
					  </div>

					  <input type="hidden" name="circle_id" value="<?php echo $recordId; ?>">

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