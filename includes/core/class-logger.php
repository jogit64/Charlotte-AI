<?php

class CharlotteAI_Logger
{
    const LOG_FILE = WP_CONTENT_DIR . '/debug.log';
    const MAX_LOG_SIZE = 1048576; // 1 Mo

    public static function log($message)
    {
        // Vérifier si le mode debug est activé
        if (defined('WP_DEBUG') && WP_DEBUG) {
            $timestamp = '[' . date('Y-m-d H:i:s') . '] ';
            $log_message = $timestamp . $message . PHP_EOL;

            // Limiter la taille du fichier de logs
            if (file_exists(self::LOG_FILE) && filesize(self::LOG_FILE) > self::MAX_LOG_SIZE) {
                // Lire le fichier en lignes et garder les 500 dernières lignes
                $lines = file(self::LOG_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
                $lines = array_slice($lines, -500); // Conserver les 500 dernières lignes
                file_put_contents(self::LOG_FILE, implode(PHP_EOL, $lines) . PHP_EOL);
            }

            // Ajouter le nouveau message dans les logs
            file_put_contents(self::LOG_FILE, $log_message, FILE_APPEND);
        }
    }
}