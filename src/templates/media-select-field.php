<?php 
	$name = $args["name"];
	$value = get_option($name);
?>

<input type="text" value="<?= $value; ?>" name="<?= $name; ?>" />
<button class="button media-upload" id="select-<?= str_replace(" ", "-", $name); ?>" data-input-name="<?= $name; ?>">
	Select Media
</button>