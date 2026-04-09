# 🎓 STEAM Learning Platform

## 📌 Présentation
Plateforme web d’apprentissage STEAM développée pour une école de formation.

Ce projet est en cours de développement et a pour objectif de centraliser et gérer les contenus pédagogiques ainsi que les données liées à la plateforme.

---

## ⚙️ Fonctionnalités actuelles

- Gestion des sélections :
  - Ajout de nouvelles sélections
  - Suppression de sélections
- Backend connecté à une base de données
- Système d’authentification :
  - Connexion
  - Déconnexion
  - Gestion des rôles (administrateur / responsable)
- Interface adaptée selon le rôle de l’utilisateur
  - Navigation rouge 🔴 pour les administrateurs
  - Navigation verte 🟢 pour les responsables
- Page d’accueil affichant les 5 dernières actualités
- Menu des sélections permettant :
  - La consultation des programmes
  - La visualisation des cours et des éléments pédagogiques

---

## 🔐 Authentification et rôles utilisateurs

Le projet intègre un système de connexion pour deux types d’utilisateurs :

- 👤 Administrateur  
- 👤 Responsable  

Après authentification :
- Les administrateurs disposent d’une interface avec une barre de navigation rouge 🔴  
- Les responsables disposent d’une interface avec une barre de navigation verte 🟢  

Cette distinction permet d’adapter l’interface en fonction du rôle de l’utilisateur.

---

## 📝 Inscription avec code d’accès

La plateforme inclut une page d’inscription nécessitant un **code d’accès** pour créer un compte.

👉 Par défaut, les comptes créés sont désactivés et nécessitent une validation avant utilisation.

Ce système permet de contrôler l’accès à la plateforme et d’éviter les inscriptions non autorisées.

---

## 🖥️ Interface utilisateur (Frontend)

L’interface utilisateur comprend :

### 📰 Page d’accueil
- Affichage des 5 dernières actualités publiées

### 📚 Menu “Sélections”
- Accès aux différentes sélections
- Consultation des programmes associés
- Visualisation des cours et des éléments pédagogiques

### 🔗 Ressources
- Les ressources pédagogiques sont visibles dans l’interface
- Les liens d’accès aux ressources sont en cours d’intégration

---

## 🚧 En cours de développement

- Gestion des éléments pédagogiques
- Gestion complète des utilisateurs (création et profils détaillés)
- Intégration des liens vers les ressources
- Finalisation de certaines fonctionnalités frontend
- Amélioration de l’interface utilisateur

---

## 🛠️ Technologies utilisées

- PHP
- MySQL
- HTML
- CSS
- JavaScript

---

## 🎯 Objectif du projet

Créer une plateforme éducative moderne, intuitive et évolutive permettant une gestion efficace des contenus et des utilisateurs dans un environnement STEAM.

---

## 📂 Structure du projet
/v2
├── index.php
├── /vitrine
│ ├── sel.php
│ ├── select.php
│ ├── selection.php
 ---

## 👩‍💻 Auteur

- Lysa Belkacem

---

## 📌 Statut

Projet en cours de développement