<?php

class CharlotteAI_Admin_Page
{
    public static function init()
    {
        // Ajouter le menu parent
        add_menu_page(
            'Charlotte AI',                     // Titre de la page
            'Charlotte AI',                     // Texte du menu
            'manage_options',                   // Capacité requise
            'charlotte-ai-dashboard',           // Slug
            [self::class, 'render_dashboard'],  // Fonction de rendu
            'dashicons-admin-site-alt3',        // Icône du menu
            6                                   // Position
        );

        // Ajouter les sous-menus
        add_submenu_page(
            'charlotte-ai-dashboard',           // Parent slug
            'Statistiques Charlotte AI',        // Titre de la page
            'Tableau de Bord',                  // Texte du menu
            'manage_options',                   // Capacité requise
            'charlotte-ai-dashboard',           // Slug
            [self::class, 'render_dashboard']   // Fonction de rendu
        );

        add_submenu_page(
            'charlotte-ai-dashboard',           // Parent slug
            'Logs API Charlotte AI',            // Titre de la page
            'Logs API',                         // Texte du menu
            'manage_options',                   // Capacité requise
            'charlotte-ai-logs',                // Slug
            ['CharlotteAI_Logs_Page', 'render_logs_page'] // Fonction de rendu
        );
    }

    public static function render_dashboard()
    {
        echo '<div class="wrap">';
        echo '<h1>Charlotte AI - Tableau de Bord</h1>';
        echo '<p>Statistiques et options du chatbot à venir.</p>';
        echo '</div>';
    }
}

add_action('admin_menu', ['CharlotteAI_Admin_Page', 'init']);