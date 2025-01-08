<?php 
?>

<section>
	<h1>Site Settings</h1>
	<form action="options.php" method="POST">
		
		<?php 
			settings_fields('site-defaults');
			do_settings_sections('site-settings');
			submit_button();
		?>
	</form>
</section>