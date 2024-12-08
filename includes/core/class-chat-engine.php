<?php

if (!defined('ABSPATH')) {
    exit;
}

class ChatEngine
{
    public static function process_message($message)
    {
        global $wpdb;

        $api_key = defined('OPENAI_API_KEY') ? OPENAI_API_KEY : null;

        if (!$api_key) {
            CharlotteAI_Logger::log('[CharlotteAI] Clé API absente ou non configurée.');
            return json_encode(['reply' => 'Erreur : Clé API manquante.']);
        }

        // Préparer la requête
        $request_body = [
            'model' => 'gpt-4', // Modèle de chat
            'messages' => [
                ['role' => 'system', 'content' => 'Vous êtes Charlotte, une assistante immobilière.'],
                ['role' => 'user', 'content' => $message],
            ],
            'max_tokens' => 150,
        ];

        CharlotteAI_Logger::log('[CharlotteAI] Requête API préparée : ' . json_encode($request_body));

        // Effectuer la requête API (avec le bon endpoint)
        $start_time = microtime(true);

        $response = wp_remote_post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $api_key,
                'Content-Type' => 'application/json',
            ],
            'body' => json_encode($request_body),
            'timeout' => 15, // Augmente le délai d'attente
        ]);

        $elapsed_time = microtime(true) - $start_time;
        CharlotteAI_Logger::log('[CharlotteAI] Temps de requête : ' . number_format($elapsed_time, 2) . ' secondes');



        // Vérification des erreurs
        if (is_wp_error($response)) {
            CharlotteAI_Logger::log('[CharlotteAI] Erreur API : ' . $response->get_error_message());
            return json_encode(['reply' => 'Désolé, Charlotte a rencontré un problème technique. Veuillez réessayer plus tard.']);
        }


        // Réponse brute
        $response_body = wp_remote_retrieve_body($response);
        CharlotteAI_Logger::log('[CharlotteAI] Réponse brute de l’API : ' . $response_body);

        // Décoder la réponse
        $body = json_decode($response_body, true);

        // Vérifier la structure de la réponse
        if (!isset($body['choices'][0]['message']['content'])) {
            CharlotteAI_Logger::log('[CharlotteAI] Réponse invalide : ' . $response_body);
            return json_encode(['reply' => 'Erreur : Réponse invalide.']);
        }

        $cleaned_response = trim($body['choices'][0]['message']['content']);

        // Suivi des tokens utilisés et estimation des coûts
        $tokens_used = $body['usage']['total_tokens'] ?? 0;
        $cost = $tokens_used * 0.03 / 1000; // Exemple de coût estimé pour GPT-4 à $0.03/1k tokens
        $prompt_length = strlen($message);

        CharlotteAI_Logger::log("[CharlotteAI] Tokens utilisés : $tokens_used, Coût estimé : $" . number_format($cost, 5));

        // Mettre à jour le tracker des coûts
        CharlotteAI_Cost_Tracker::add_cost($tokens_used, $cost);

        // Enregistrer dans la table des logs API
        $wpdb->insert(
            $wpdb->prefix . 'charlotte_ai_api_logs',
            [
                'timestamp' => current_time('mysql'),
                'prompt_length' => $prompt_length,
                'tokens_used' => $tokens_used,
                'cost' => $cost,
            ]
        );

        CharlotteAI_Logger::log('[CharlotteAI] Réponse nettoyée : ' . $cleaned_response);

        return json_encode(['reply' => $cleaned_response]);
    }
}