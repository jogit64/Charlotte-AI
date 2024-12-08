<?php

// Charger les scripts React
function charlotte_ai_enqueue_react()
{
    wp_enqueue_script(
        'charlotte-ai-react',
        CHARLOTTE_AI_PLUGIN_URL . 'includes/frontend/assets/bundle.js', // Fichier React compilé
        [], // Pas de dépendances supplémentaires
        CHARLOTTE_AI_VERSION,
        true // Charger en pied de page
    );

    // Ajouter l'URL AJAX pour utilisation dans React
    $script_data = [
        'ajaxurl' => admin_url('admin-ajax.php'), // URL de WordPress pour les requêtes AJAX
    ];
    $inline_script = 'const ajaxurl = ' . json_encode($script_data['ajaxurl']) . ';';
    wp_add_inline_script('charlotte-ai-react', $inline_script, 'before'); // Ajouter avant le fichier React
}
add_action('wp_enqueue_scripts', 'charlotte_ai_enqueue_react');

// Shortcode pour afficher le chatbot React
function charlotte_ai_react_chat()
{
    // Conteneur React
    return '<div id="charlotte-react-root"></div>';
}
add_shortcode('charlotte_ai_react', 'charlotte_ai_react_chat');

// Action AJAX pour traiter les messages utilisateur
add_action('wp_ajax_charlotte_ai_process', 'charlotte_ai_process'); // Utilisateur connecté
add_action('wp_ajax_nopriv_charlotte_ai_process', 'charlotte_ai_process'); // Utilisateur non connecté

function charlotte_ai_process()
{
    // Récupérer et nettoyer le message utilisateur
    $message = $_POST['message'] ?? '';
    $sanitized_message = DataCleaner::sanitize_input($message); // Nettoyer les données utilisateur

    // Passer le message à ChatEngine pour traitement
    $response = ChatEngine::process_message($sanitized_message);

    // Retourner la réponse (JSON)
    echo $response;
    wp_die();
}