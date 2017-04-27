<?php

/*
	Plugin Name: CKEditor4 for admin
	Plugin URI: 
	Plugin Description: Replaces HTML-enable-TEXTAREA of admin page to CKEditor
	Plugin Version: 1.0.0
	Plugin Date: 2017-04-27
	Plugin Author: ProThoughts
	Plugin Author URI: https://github.com/prothoughts
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.6
	Plugin Update Check URI: 
*/

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}

	qa_register_plugin_layer('qa-ckeditor4-admin-layer.php', 'CKEditor4 for admin');
	qa_register_plugin_module('module', 'qa-ckeditor4-admin-form.php', 'qa_ckeditor4_admin_form', 'CKEditor4 for admin');
	qa_register_plugin_phrases('qa-ckeditor4-admin-lang-*.php', 'ckeditor4_admin');	

/*
	Omit PHP closing tag to help avoid accidental output
*/