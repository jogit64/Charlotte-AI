<?php

if (!defined('ABSPATH')) {
    exit;
}

class CharlotteAI_Logs_Page
{
    public static function render_logs_page()
    {
        $log_file = WP_CONTENT_DIR . '/debug.log';
        $tracker = CharlotteAI_Cost_Tracker::get_tracker();

        echo '<div class="wrap">';
        echo '<h1>Logs API Charlotte AI</h1>';
        echo '<p><strong>Coût total estimé :</strong> $' . number_format($tracker['cost'], 5) . '</p>';
        echo '<p><strong>Tokens utilisés :</strong> ' . $tracker['tokens'] . '</p>';

        if (!file_exists($log_file)) {
            echo '<div class="notice notice-warning"><p>Aucun log disponible.</p></div>';
        } else {
            if (isset($_POST['clear_logs'])) {
                unlink($log_file); // Supprimer le fichier de logs
                echo '<div class="notice notice-success"><p>Les logs ont été effacés avec succès.</p></div>';
            }

            if (isset($_POST['reset_tracker'])) {
                CharlotteAI_Cost_Tracker::reset_tracker();
                echo '<div class="notice notice-success"><p>Le compteur de coûts et de tokens a été réinitialisé.</p></div>';
            }

            echo '<form method="post" style="margin-bottom: 15px;">';
            echo '<button type="submit" name="clear_logs" class="button button-secondary">Effacer les logs</button>';
            echo '<button type="submit" name="reset_tracker" class="button button-secondary">Réinitialiser le compteur</button>';
            echo '</form>';

            // Afficher le contenu des logs en respectant la limite de 500 lignes
            echo '<pre style="background: #f7f7f7; padding: 15px; border: 1px solid #ccc; max-height: 500px; overflow-y: auto;">';
            $lines = file($log_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            $lines = array_slice($lines, -500); // Conserver uniquement les 500 dernières lignes
            foreach ($lines as $line) {
                echo esc_html($line) . PHP_EOL;
            }
            echo '</pre>';
        }

        echo '</div>';
    }
}