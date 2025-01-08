<?php
/**
 * site_settings_enhancements_init
 * subhead for enhancements section
 * @return void
 */
function site_settings_enhancements_init() {
}

function site_settings_defaults_init() {
}

/**
 * announcement_bar_toggle_init
 * renders a checkbox for a given togglable field
 * @return void
 */
function render_checkbox_field($args) {
	if (!isset($args["name"])) {
		return;
	}

	$template = plugin_dir_path(__FILE__) . "/templates/checkbox-field.php";
	
	if (file_exists($template)) {
		load_template($template, false, $args);
	}
}

function render_media_select_field($args) {
	if (!isset($args["name"])) {
		return;
	}

	$template = plugin_dir_path(__FILE__) . "/templates/media-select-field.php";

	if (file_exists($template)) {
		load_template($template, false, $args);
	}
}

/**
 * site_settings_admin_init
 * create site settings
 * @return void
 */
function site_settings_admin_init() {
	$setting_sections = [
		[
			"id" => "site-settings-defaults",
			"title" => "Defaults",
			"callback" => "site_settings_defaults_init",
			"page" => "site-settings"
		],
		[
			"id" => "site-settings-enhancements",
			"title" => "Enhancements",
			"callback" => "site_settings_enhancements_init",
			"page" => "site-settings"
		],
	];

	array_map(function($section) {
		add_settings_section($section["id"], $section["title"], $section["callback"], $section["page"]);
	}, $setting_sections);

	$settings = [
		[
			"id" => "fallback_image",
			"title" => "Fallback Image",
			"callback" => "render_media_select_field",
			"page" => "site-settings",
			"section" => "site-settings-defaults",
			"args" => [
				"name" => "fallback_image"
			],
			"group" => "site-defaults"
		],
		[
			"id" => "announcement_bar_enabled",
			"title" => "Announcement Bar Toggle",
			"callback" => "render_checkbox_field",
			"page" => "site-settings",
			"section" => "site-settings-enhancements",
			"args" => [
				"name" => "announcement_bar_enabled"
			],
			"group" => "site-defaults"
		]
	];

	array_map(function($setting) {
		register_setting($setting["group"], $setting["id"]);
		add_settings_field($setting["id"], $setting["title"], $setting["callback"], $setting["page"], $setting["section"], $setting["args"]);
	
	}, $settings);
}

add_filter("admin_init", "site_settings_admin_init");


/**
 * site_settings_init
 *
 * @return void
 */
function site_settings_menu_init() {
	add_options_page( 
		__("Site Settings", "site-settings"), 
		__("Site Settings", "site-settings"), 
		"manage_options", 
		"site-settings", 
		"site_settings_page_init"
	);
}

add_filter("admin_menu", "site_settings_menu_init");

/**
 * site_settings_page_init
 * include site settings page
 * @return void
 */
function site_settings_page_init() {
	if ( !current_user_can( "manage_options" ) )  {
		wp_die( __( "You do not have sufficient permissions to access this page." ) );
	}

	include "pages/settings.php";
	wp_enqueue_script("site-settings-scripts", plugin_dir_url(__FILE__) . "/scripts/settings.js");
}



add_action( 'admin_enqueue_scripts', function() {
	wp_enqueue_media();
} );