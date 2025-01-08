<?php
	$name = $args["name"];
	$value = get_option($name);
?>

<input type="checkbox" id="<?= $name ?>" name="<?= $name ?>" <?= $value == "on" ? "checked" : "" ?> >