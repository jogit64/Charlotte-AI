<?php

if (!defined('ABSPATH')) {
    exit;
}

class DataCleaner
{
    public static function sanitize_input($message)
    {
        $message = sanitize_text_field($message);
        $message = str_replace('k', '000', $message); // Convertit "200k" en "200000"
        return trim($message);
    }
}