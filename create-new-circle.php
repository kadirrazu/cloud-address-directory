<?php require_once('security-check.php'); ?>

<?php require_once('tpl-header.php'); ?>

<?php 
	
	require_once('database-connection.php');

?>

<div class="content-body">

    <div class="row">

        <div class="col-md-12">
            
            <h3 class="page-title">Add New Circle</h3>

            <?php require_once('flash-message.php'); ?>

			<!-- form -->
            <form action="process-add-new-circle.php" method="POST">
			  
			  <div class="row">

				  <div class="form-group col-md-12">
				    <label for="circle_title">Circle Title <span class="required-mark">*</span></label>
				    <input type="text" name="circle_title" class="form-control" id="circle_title" placeholder="Circle Title">
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