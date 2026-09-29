<?php
defined('BASEPATH') or exit('No direct script access allowed');

function get_secure_api_key($name)
{
    static $keys = null;

    if ($keys === null) {
        $file = FCPATH . 'private/apikeys.php';

        if (!file_exists($file)) {
            log_message('error', 'API key file not found: ' . $file);
            return null;
        }

        $keys = require($file);

        if (!is_array($keys)) {
            log_message('error', 'API key file did not return an array.');
            $keys = [];
        }
    }

    return isset($keys[$name]) ? $keys[$name] : null;
}
