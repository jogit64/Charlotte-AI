<?php
// Tester la constante CHARLOTTE_AI_PLUGIN_DIR
define('CHARLOTTE_AI_PLUGIN_DIR', __DIR__ . '/');

echo "<h3>Constante CHARLOTTE_AI_PLUGIN_DIR :</h3>";
var_dump(CHARLOTTE_AI_PLUGIN_DIR);

// Vérifier si un fichier existe
$file_to_check = CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/class-user-session.php';
echo "<h3>Test de l'existence du fichier :</h3>";
if (file_exists($file_to_check)) {
    echo "Fichier trouvé : $file_to_check";
} else {
    echo "Fichier introuvable : $file_to_check";
}

// Lister les fichiers dans le répertoire core
echo "<h3>Fichiers dans 'core/' :</h3>";
$core_dir = CHARLOTTE_AI_PLUGIN_DIR . 'includes/core/';
if (is_dir($core_dir)) {
    $files = scandir($core_dir);
    echo "<ul>";
    foreach ($files as $file) {
        echo "<li>$file</li>";
    }
    echo "</ul>";
} else {
    echo "'core/' n'est pas un répertoire valide.";
}