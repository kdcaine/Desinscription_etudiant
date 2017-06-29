<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Strings for component 'tool_desinscription_etudiant', language 'fr'.
 *
 * @package    tool_desinscription_etudiant
 * @copyright  2017 Puagnol André John
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Desinscription étudiant';
$string['maintitle'] = 'Affichage des cours suivi par un étudiant';
// Traduction fichier index.
$string['titreindex'] = "Système de désinscription d'étudiant :";
$string['emplacement'] = 'Veuillez uploader votre fichier à cet emplacement pour permettre la désinscription : ';
$string['fichier'] = 'Votre fichier : ';
$string['envoyer'] = 'envoyer';
$string['notice'] = "Notice d'utilisation : ";
$string['format'] = "Votre fichier est au format '.csv' et il doit être écrit sous forme 'nomCours; methode d'inscription; rôles'";
$string['methode'] = "Nous avons différentes méthodes d'inscription : ";
$string['methode1'] = 'manual : ajout manuel par le professeur';
$string['methode2'] = 'self   : auto-inscription';
$string['methode3'] = 'guest  : invité';
$string['rolepossible'] = 'Voici les différents rôles possibles :';
$string['role1'] = '1 : Etudiant';
$string['role2'] = '2 : Enseignant';
$string['role3'] = '3 : Enseignant non éditeur';
$string['noticeexemple'] = "Voici un exemple d'écriture pour une ligne de votre fichier : ";
$string['example'] = 'monCours;manual;1';
// Traduction fichier lecture.
$string['titrelecture'] = 'Lecture du fichier CSV fourni :';
$string['filecsv'] = 'Fichier csv uploadé : ';
$string['namecours'] = 'Nom du cours : ';
$string['type'] = "Type d'inscription : ";
$string['role'] = 'Rôle : ';
$string['novalide'] = 'Aucun fichier présent ou fichier invalide !';
$string['listeuser'] = 'Voici la liste des utilisateurs sélectionné pour la désinscription :';
$string['prenom'] = 'Prénom';
$string['nom'] = 'Nom';
$string['cours'] = 'Cours';
$string['confirmer'] = 'Merci de confirmer votre opération : ';
$string['d'] = 'DESINSCRIRE';
$string['dl'] = 'DESINSCRIRE + LOG';
$string['annuler'] = 'Annuler';
// Traduction fichier savePopUp.
$string['titresave'] = 'Merci de valider pour la désinscription ';
$string['boutonconfirmer'] = 'Confirmer';
// Traduction fichier suppIndex.
$string['titresuppi'] = 'Désinscription réussi';