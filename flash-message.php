<?php if( isset($_SESSION["flash_message"]) ) : ?>
	<div class="notification bg-<?php echo $_SESSION["flash_type"]; ?>">
		<?php 
			echo $_SESSION["flash_message"];
		?>
	</div>
<?php endif; ?>

<?php 
	unset($_SESSION["flash_type"]);
	unset($_SESSION["flash_message"]);
?>