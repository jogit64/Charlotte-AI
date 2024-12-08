# Base Chatbot AI Plugin

## Description

Ce projet est une base pour créer des plugins WordPress conversationnels utilisant React et l'API OpenAI.  
Il inclut :

- Une architecture modulaire pour séparer la logique métier et la logique technique.
- Une interface utilisateur React intégrée à WordPress.
- Un système de suivi des coûts d'utilisation de l'API.

---

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

1. **PHP** (version >= 7.4).
2. **WordPress** (version >= 6.0).
3. **Node.js** et **npm** (pour gérer et compiler React).  
   [Télécharger Node.js et npm](https://nodejs.org/).
4. **7-Zip** (pour créer une archive ZIP).  
   [Télécharger 7-Zip](https://www.7-zip.org/).
5. **Git** (pour versionner votre projet sur GitHub).  
   [Télécharger Git](https://git-scm.com/).

---

## Installation : Étapes détaillées

### 1. Cloner le projet

Téléchargez ou clonez ce dépôt :

```bash
git clone https://github.com/votre-compte/base-chatbot-ai-plugin.git
cd base-chatbot-ai-plugin
```

````

---

### 2. Installer les dépendances React

Allez dans le répertoire React du plugin :

```bash
cd includes/frontend/react-app
```

Initialisez le projet Node.js (à faire une seule fois si vous partez d'une nouvelle copie) :

```bash
npm init -y
```

Installez les dépendances nécessaires pour React et Webpack :

```bash
npm install react react-dom
npm install --save-dev @babel/core @babel/preset-env @babel/preset-react babel-loader webpack webpack-cli webpack-dev-server
```

---

### 3. Compiler React

Pour compiler le code React en JavaScript utilisable par WordPress :
Depuis le dossier `react-app`, exécutez cette commande :

```bash
npx webpack --config webpack.config.js
```

> **Remarque :** Cette commande génère le fichier `bundle.js` dans `includes/frontend/assets/`.

---

### 4. Créer une archive ZIP pour l'installation WordPress

À la racine du plugin (`base-chatbot-ai-plugin`), exécutez le script PowerShell pour générer un fichier ZIP :

```bash
./build-plugin.ps1
```

---

### 5. Installer le plugin dans WordPress

1. Rendez-vous sur l'interface WordPress : **Extensions** > **Ajouter** > **Téléverser une extension**.
2. Sélectionnez le fichier ZIP généré (`base-chatbot-ai-plugin.zip`).
3. Activez le plugin.

---

## Fonctionnement

### A. Ajout d’un chatbot sur une page

Utilisez le shortcode suivant dans une page ou un article WordPress :

```plaintext
[charlotte_ai_react]
```

Cela ajoutera le chatbot React à votre page.

---

### B. Accéder aux logs

Les logs d'utilisation (coût, tokens, etc.) sont visibles dans l'admin WordPress sous :
**Base Chatbot AI > Logs API**.

---

### C. Structure du projet

Voici un tableau des principaux fichiers et répertoires :

| Fichier / Répertoire                              | Description                                                                        |
| ------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `charlotte-ai.php`                                | Fichier principal du plugin (point d'entrée).                                      |
| `includes/core/class-chat-engine.php`             | Gère les interactions avec l'API OpenAI.                                           |
| `includes/core/class-user-session.php`            | Gère les sessions utilisateur pour suivre l’état de la conversation.               |
| `includes/core/class-logger.php`                  | Gère l’écriture des logs dans `debug.log`.                                         |
| `includes/core/class-cost-tracker.php`            | Suit les tokens utilisés et le coût des requêtes API.                              |
| `includes/frontend/react-app`                     | Contient le code React du chatbot.                                                 |
| `includes/admin/class-charlotte-ai-logs-page.php` | Génère la page admin des logs.                                                     |
| `uninstall.php`                                   | Gère la suppression du plugin et des données associées lors de la désinstallation. |
| `build-plugin.ps1`                                | Script PowerShell pour générer un fichier ZIP pour l'installation WordPress.       |
| `.gitignore`                                      | Fichiers/dossiers ignorés par Git (ex. : `node_modules/`, `.zip`, etc.).           |

---

Tableau non formaté :

Fichier / Répertoire Description
charlotte-ai.php Fichier principal du plugin (point d'entrée).
includes/core/class-chat-engine.php Gère les interactions avec l'API OpenAI.
includes/core/class-user-session.php Gère les sessions utilisateur pour suivre l’état de la conversation.
includes/core/class-logger.php Gère l’écriture des logs dans debug.log.
includes/core/class-cost-tracker.php Suit les tokens utilisés et le coût des requêtes API.
includes/frontend/react-app Contient le code React du chatbot.
includes/admin/class-charlotte-ai-logs-page.php Génère la page admin des logs.
uninstall.php Gère la suppression du plugin et des données associées lors de la désinstallation.
build-plugin.ps1 Script PowerShell pour générer un fichier ZIP pour l'installation WordPress.
.gitignore Fichiers/dossiers ignorés par Git (ex. : node_modules/, .zip, etc.).

---

## Guide de Développement

### Pour modifier le code React :

1. Modifiez les fichiers dans `includes/frontend/react-app/src/`.
2. Recompilez le code avec :

```bash
npx webpack --config webpack.config.js
```

---

### Pour mettre à jour le suivi des coûts et logs :

Les fichiers principaux pour les logs et le suivi des coûts sont :

- `includes/core/class-cost-tracker.php`
- `includes/core/class-logger.php`
- `includes/admin/class-charlotte-ai-logs-page.php`

---

## Conseils pour Git

### A. Ignorer les fichiers inutiles

Assurez-vous que votre `.gitignore` contient ces lignes :

```plaintext
node_modules/
*.zip
*.log
build-plugin.ps1
includes/frontend/assets/
```

### B. Pousser les modifications sur GitHub

1. **Ajouter les changements :**

```bash
git add .
git commit -m "Mise à jour du plugin de base"
```

2. **Pousser sur GitHub :**

```bash
git push
```

---

## FAQ

### 1. Pourquoi utiliser `npx webpack` et pas `npm run build` ?

Vous utilisez `npx webpack --config webpack.config.js` parce que votre projet n'a pas de script personnalisé défini dans `package.json`. Vous pourriez ajouter ceci à `package.json` :

```json
"scripts": {
  "build": "webpack --config webpack.config.js"
}
```

Ensuite, la commande `npm run build` fonctionnera de la même manière.

---

Ce guide est conçu pour vous rappeler toutes les étapes nécessaires pour utiliser, recompiler, et publier votre plugin. Si vous avez d’autres questions ou besoins, n’hésitez pas à les ajouter dans ce README.

```

---

### Instructions supplémentaires :
1. Copiez ce texte dans un fichier nommé `README.md` dans la racine de votre projet.
2. Une fois prêt, versionnez le projet sur GitHub en suivant les étapes décrites dans le fichier.
```
````
