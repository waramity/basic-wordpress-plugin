<div class="wrap">
	<h1>Basic Plugin</h1>
	<?php settings_errors(); ?>

	<form method="post" action="options.php">
		<?php 
			settings_fields( 'basic_options_group' );
			do_settings_sections( 'basic_plugin_menu_slug' );
			submit_button();
		?>
	</form>
</div>