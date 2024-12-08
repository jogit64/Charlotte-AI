# Ce script génère une archive ZIP du plugin
# Assurez-vous que 7-Zip est installé sur votre système.
# Exemple : C:\Program Files\7-Zip\7z.exe

$PluginName = "charlotte-ai"
$Destination = "$PluginName.zip"

# Supprimer l'ancien ZIP s'il existe
if (Test-Path $Destination) {
    Remove-Item $Destination
}

# Créer le ZIP avec 7-Zip (remplacez le chemin si nécessaire)
& "C:\Program Files\7-Zip\7z.exe" a -tzip $Destination .\* -xr!"node_modules" -xr!"src" -xr!".git" -xr!"package.json" -xr!"package-lock.json" -xr!"webpack.config.js" -xr!"build-plugin.ps1"

Write-Output "Archive $Destination créée avec succès avec 7-Zip."
