<?php

function charlotte_ai_create_tables()
{
    global $wpdb;

    $charset_collate = $wpdb->get_charset_collate();

    // Table des prospects
    $prospects_table = $wpdb->prefix . 'charlotte_prospects';
    $prospects_sql = "CREATE TABLE $prospects_table (
        id INT NOT NULL AUTO_INCREMENT,
        type ENUM('acheteur', 'vendeur') NOT NULL,
        bien_type VARCHAR(100),
        localisation VARCHAR(255),
        budget DECIMAL(10,2),
        delai VARCHAR(50),
        nom VARCHAR(100),
        email VARCHAR(100),
        telephone VARCHAR(15),
        date_enregistrement TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Table des logs API
    $logs_table = $wpdb->prefix . 'charlotte_ai_api_logs';
    $logs_sql = "CREATE TABLE $logs_table (
        id INT NOT NULL AUTO_INCREMENT,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        prompt_length INT,
        tokens_used INT,
        cost DECIMAL(10, 5),
        PRIMARY KEY (id)
    ) $charset_collate;";

    // Charger dbDelta et exécuter les requêtes
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($prospects_sql);
    dbDelta($logs_sql);
}

register_activation_hook(__FILE__, 'charlotte_ai_create_tables');