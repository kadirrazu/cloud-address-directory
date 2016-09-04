<?php require_once('security-check.php'); ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
    	Export Entries
    </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="css/jquery.dataTables.min.css" rel="stylesheet">-->
    <link href="css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script|Roboto+Slab|Shadows+Into+Light" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>
  <body>

  	<div class="master-area export-page">

  		<div class="export-head">

	  		<div class="header">
	            <div class="row">
	                
	                <!-- header-left -->
	                <div class="col-md-6 col-sm-6 col-xs-12">
	                    <div class="logo-text">
	                        <span>A</span>ddress
	                        <span>D</span>irctory
	                    </div>
	                </div>
	                <!-- /col-md-6 -->
	                    
	            </div>
	            <!-- /row -->
	        </div>
	        <!-- /header -->

	        <hr>

	  	</div>
	  	<!-- /export-head -->

	  	<div class="export-area">
			<?php 
				require_once('database-connection.php'); 

				$result = mysqli_query($connection, "SELECT * FROM kr_contacts ORDER BY first_name ASC, last_name ASC");

				$rowcount = mysqli_num_rows($result);

			?>

			<?php if( $rowcount < 1 ) : ?>

				<div class="not-found-exception">
					<p class="not-found-message">
						Buddy, there is no entry in your directory to export! 
					</p>
					<p>
						First add some fresh entries.
					</p>
				</div>

			<?php else : ?>

				<!-- table-start -->
	        	<table id="directory-table" class="table table-striped table-bordered" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th>Sr.</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Meta Information</th>
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
							<td>
								<div class="export-meta">
									<strong>Email: </strong>
									<?php 
										echo $row['email']; 
									?>
								</div>
								<?php 

								$recordId = $row['id'];

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

								<?php foreach( $meta as $key => $value ) : ?>
									<div class="export-meta">
										<strong>
										<?php 
											echo ucfirst($key); 
										?>: 
										</strong>
										<?php 
											echo $value; 
										?>
									</div>
								<?php endforeach; ?>

								<div class="export-meta">
									<strong>Circle: </strong>
									<?php 
										echo $groupRow['circle_title']; 
									?>
								</div>
							</td>
						</tr>
						<?php $counter++; endwhile;  ?>
					</tbody>
				</table>
	        	<!-- table-ends -->
				
			<?php endif; ?>

		</div>
		<!-- /export-area -->

		<div class="export-foot">
	  		<footer class="copyright">

                <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <p>
                                <strong>
                                    &copy; 2016, IIT Demo App
                                </strong>
                            </p>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12 footer-right">
                            <p>
                                Script Generated At:
                                <strong>
                                    <?php 
                                        date_default_timezone_set('Asia/Dhaka');
                                        echo date('F j, Y, h:i A'); 
                                    ?>
                                </strong>
                            </p>
                        </div>
                    
                </div>
                <!-- /row -->

            </footer>
            <!-- /footer -->

	  	</div>
	  	<!-- /export-foot -->

  	</div>
  	<!-- /master-area -->

  </body>

</html>