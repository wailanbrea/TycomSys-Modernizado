<?php

/**
 * Laravel Application Entry Point
 * 
 * This file redirects all requests to the public directory
 * where the actual Laravel application is served from.
 */

// Redirect to public directory
$request_uri = $_SERVER['REQUEST_URI'] ?? '/';
$public_path = '/public' . $request_uri;

// If it's a directory request, ensure we have a trailing slash
if (is_dir(__DIR__ . '/public' . $request_uri) && substr($request_uri, -1) !== '/') {
    $public_path = '/public' . $request_uri . '/';
}

// Redirect to public directory
header('Location: ' . $public_path);
exit;
