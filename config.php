<?php

// ---- ROOT ---- //

$root_path = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR .  'jibe' . DIRECTORY_SEPARATOR;

// ---- MODEL + ERRORS ---- //

$model_path = $root_path . "model" . DIRECTORY_SEPARATOR;
$error_path = $root_path . "errors" . DIRECTORY_SEPARATOR;

// ---- HEADER + FOOTER ---- //

$header_path = $root_path . "view" . DIRECTORY_SEPARATOR;
$footer_path = $root_path . "view" . DIRECTORY_SEPARATOR;

// ---- CSS + JS ---- //

$css_path = $root_path . "css" . DIRECTORY_SEPARATOR;
$js_path = $root_path . "js" . DIRECTORY_SEPARATOR;

// ---- IMAGES ---- //

$image_path = $root_path . "images_upload" . DIRECTORY_SEPARATOR;
$profile_path = $image_path . "profiles" . DIRECTORY_SEPARATOR;
$thumb_path = $image_path . "thumbs" . DIRECTORY_SEPARATOR;

// ---- ADMIN AREA ---- //

$admin_path = $root_path . "admin" . DIRECTORY_SEPARATOR;
$admin_header_path = $admin_path . "view" . DIRECTORY_SEPARATOR;
$admin_footer_path = $admin_path . "view" . DIRECTORY_SEPARATOR;