# Gestion des Cours et des Sections (Mini LMS)

## 📌 Description
Ce projet est une mini application web permettant de gérer des cours et leurs sections.
Chaque cours peut contenir plusieurs sections.
Le projet a été réalisé individuellement dans le cadre d’un apprentissage du PHP procédural et MySQL.

## 🎯 Objectifs
- Comprendre la relation 1:N (Course → Sections)
- Mettre en place un CRUD en PHP procédural
- Utiliser une base de données relationnelle avec clés étrangères

## 🧱 Base de données
La base de données contient deux tables :

### Table courses
- id (INT, PK, AI)
- title (VARCHAR)
- description (TEXT)
- level (VARCHAR)
- created_at (DATETIME)

### Table sections
- id (INT, PK, AI)
- course_id (INT, FK → courses.id)
- title (VARCHAR)
- content (TEXT)
- created_at (DATETIME)

Relation :  
Un cours peut contenir plusieurs sections (1:N).

## 🛠️ Technologies utilisées
- PHP 8 (procédural)
- MySQL
- HTML / CSS
- Laragon (environnement local)

## ⚙️ Installation
1. Cloner ou télécharger le projet
2. Importer le fichier SQL dans phpMyAdmin
3. Configurer la connexion à la base de données dans `config.php`
4. Lancer le projet via `localhost`

## ▶️ Utilisation
- Ajouter, modifier et supprimer des cours
- Ajouter et supprimer des sections pour chaque cours
- Afficher les sections d’un cours spécifique

## 📂 Structure du projet
/project
│── config.php <br>
│── header.php <br>
│── footer.php <br>
│── courses_list.php <br>
│── courses_create.php <br>
│── courses_edit.php <br>
│── courses_delete.php <br>
│── sections_list.php <br>
│── sections_create.php <br>
│── sections_delete.php <br>
│── assets/ <br>
│ └── img/ <br>


## ✍️ Auteur
Projet réalisé individuellement par **Achraf El Berkaoui**.
