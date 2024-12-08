<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

global $wpdb;

// Supprimer uniquement la table des prospects
$prospects_table = $wpdb->prefix . 'charlotte_prospects';
$wpdb->query("DROP TABLE IF EXISTS $prospects_table");

// Laisser la table des logs intacte