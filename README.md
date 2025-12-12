# 🏋️‍♂️ Plateforme de Gestion d’une Salle de Sport

**Gestion des cours, équipements et tableau de bord – PHP / MySQL**

---

## 📘 Introduction

Cette application web permet à une salle de sport de gérer facilement ses cours, ses équipements et de visualiser des statistiques dans un dashboard intégré directement dans `index.php`.  
Elle inclut la gestion CRUD complète des cours et équipements, ainsi qu’une table associative optionnelle pour lier plusieurs équipements à un cours.

---

## 📑 Table des Matières

- [Fonctionnalités](#-fonctionnalités)  
- [Base de Données](#-base-de-données)  
- [Installation](#-installation)  
- [Configuration](#-configuration)  
- [Utilisation](#-utilisation)  
- [Dépannage](#-dépannage)  
- [Contributeurs](#-contributeurs)   

---

## 🚀 Fonctionnalités

- Authentification (login/register)
- Graphiques supplémentaires
- Filtres et tri 

### 📝 Gestion des Cours
- Liste complète : nom, catégorie, date, heure, durée, nombre max. participants  
- Ajouter un cours  
- Modifier un cours  
- Supprimer un cours  
- Validation des champs obligatoires
- Export CSV  

### 🏋️ Gestion des Équipements
- Liste : nom, type, quantité, état  
- Ajouter / Modifier / Supprimer  
- Validation des champs 
- Export CSV     

### 📊 Tableau de Bord (`index.php`)
- Nombre total de cours  
- Nombre total d’équipements  
- Répartition des cours par catégorie  
- Répartition des équipements par type  
- Graphiques  

### 🔗 Table Associative 
- Associer plusieurs équipements à un cours  
- Délier un équipement d’un cours  
- Filtrer cours ↔ équipements  

---

## 🗄 Base de Données

Le fichier `database.sql` doit contenir :  
- Les tables principales  
- La table associative (optionnelle)  
- Les clés primaires, clés étrangères et contraintes  
- Les types SQL nécessaires (`VARCHAR`, `INT`, `DATE`, `TIME`, `ENUM`, etc.)  

---

## 🛠 Installation

1. Cloner le projet  
    ```bash
    git clone <url-du-repo>
    cd projet-salle-sport

2. Importer la base de données  
    ```bash
    SOURCE database.sql;

3. Configurer la connexion (config.php)
    ```bash
    $host = "localhost";
    $dbname = "salle_sport";
    $user = "root";
    $password = "";

4. Démarrer le serveur
    ```bash 
    php -S localhost:8000

---

## ⚙ Configuration

Modifier config.php selon votre environnement :

    Paramètres MySQL

    Paramètres CSV

    Paramètres d’authentification (si activée)

---

## 💻 Utilisation

### Accueil / Dashboard — `index.php`
Affiche :  
- Statistiques  
- Graphiques  
- Liens vers les modules  

### Gestion des Cours
- `cours.php` : liste  
- `add_cours.php` : ajout  
- `edit_cours.php` : modification  
- `delete_cours.php` : suppression  

### Gestion des Équipements
- `equipements.php` : liste  
- `add_equipements.php` : ajout  
- `edit_equipements.php` : modification  
- `delete_equipements.php` : suppression  

---

## 🛠 Dépannage

| Problème           | Cause possible         | Solution                     |
| ------------------ | ---------------------- | ---------------------------- |
| Erreur MySQL       | Mauvaise configuration | Vérifier `config.php`        |
| Page blanche       | Erreur PHP             | Activer `display_errors`     |
| Graphiques absents | Chart.js non chargé    | Vérifier l’inclusion         |
| Données manquantes | Mauvais SELECT         | Vérifier les noms des tables |

--- 

## 👥 Contributeurs

- Youness Ait Jamaa — Développeur principal
