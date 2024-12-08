<?php

/**
 * Plugin Name: Charlotte AI
 * Description: Un chatbot IA pour la qualification des besoins immobiliers.
 * Version: 1.0.0
 * Author: Johann Renalt | johannr.fr
 */

// Définir les constantes du plugin
define('CHARLOTTE_AI_VERSION', '1.0.0');
define('CHARLOTTE_AI_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CHARLOTTE_AI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Chargement des fichiers nécessaires
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-user-session.php';       // Gestion des sessions utilisateur
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-chat-engine.php';        // Gestion de l'interaction avec l'API OpenAI
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-data-cleaner.php';       // Nettoyage des données utilisateur
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-logger.php';             // Gestion des logs
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-cost-tracker.php';       // Suivi des tokens et des coûts
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/admin/class-admin-page.php';        // Page d'administration principale
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/admin/class-charlotte-ai-logs-page.php'; // Page des logs API
require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/frontend/chat-interface.php';       // Interface utilisateur pour le chatbot




// Installation et désinstallation
register_activation_hook(__FILE__, 'charlotte_ai_install');
register_uninstall_hook(__FILE__, 'charlotte_ai_uninstall');

// Fonction d'installation
function charlotte_ai_install()
{
    require_once CHARLOTTE_AI_PLUGIN_DIR . 'charlotte-ai-install.php';
    charlotte_ai_create_tables();
}

// Fonction de désinstallation
function charlotte_ai_uninstall()
{
    require_once CHARLOTTE_AI_PLUGIN_DIR . 'uninstall.php';
    charlotte_ai_remove_tables();
}

// Chargement du widget pour Elementor
add_action('elementor/widgets/widgets_registered', function ($widgets_manager) {
    require_once CHARLOTTE_AI_PLUGIN_DIR . 'includes/widgets/class-chat-widget.php';
    $widgets_manager->register_widget_type(new CharlotteAI_Widget());
});

// Initialisation des sessions utilisateur
add_action('init', ['UserSession', 'start_session']);