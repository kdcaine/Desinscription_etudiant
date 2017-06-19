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
 * savePopUp.php
 *
 * @package    tool_description_etudiant
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once("$CFG->libdir/dml/moodle_database.php");

echo $OUTPUT->header();

global $DB;

// Test de recuperation de donner en plusieurs pages.
session_start();

?>
<html>
    <body onload="setTimeout(window.close, 10000)">
            <!-- Bouton de redirection à la page principale du plugin --> 
            <center>

            <br />
            <h5> Merci de valider pour la désinscription </h5>
            
            <form name="x" action="suppression.php" method="post">
                <input type="submit" value="Confirmer">
            </form>
           
            </center>
    </body>
</html>

<?php

// Tableau pour enregistrer les valeurs obtenue par la requete.
$numetudiant = array();
$prenom = array();
$nom = array();
$email = array();
$cours = array();

// Compteur pour enregistrer chaque valeur obtenue par la requete.
$f = 0;

// Enregistrer le resultat de la requete de suppression.
for ($c = 0; $c < $_SESSION['$taille']; $c++) {

    $idcourst = $_SESSION['idcours'][$c];
    $courst = $_SESSION['nomCours'][$c];

    $selection = 'username, firstname, lastname , email , shortname';
    $tableselectionner = '{user}, {user_enrolments}, {course}';
    $formatsave = "FIELDS TERMINATED BY ';' ENCLOSED BY '' ";
    $line = "LINES TERMINATED BY '\n'";
    $wherecondition = "enrolid ='$idcourst'and {user}.username != 'guest' and {user}.username != 'admin'and shortname = '$courst'";

    // Obtention du dossier de sauvegarde en dynamique pour les multi-platerforme.
    $a = getcwd().'\sauvegarde\"'. "\n";
    $b = substr($a, 0, -2);
    $d = str_replace("\\", "/", $b);
    $chemin = $d.'suppression.csv';

    if (file_exists($chemin)) {
        unlink($chemin);
    }

    $sql2 = "SELECT DISTINCT $selection from $tableselectionner WHERE $wherecondition ";
    $sql3 = $DB->get_records_sql($sql2);

    foreach ($sql3 as $liste) {
        $numetudiant[$f][0] = $liste->username;
        $prenom[$f][1] = $liste->firstname;
        $nom[$f][2] = $liste->lastname;
        $email[$f][3] = $liste->email;
        $cours[$f][4] = $liste->shortname;
        $f++;
    }
}
// Création du fichier log.
$monfichier = fopen($chemin, 'a+');

// Boucle pour écrire dans le fichier log.
for ($e = 0; $e < $f; $e++) {
    fputs($monfichier, $numetudiant[$e][0]);
    fputs($monfichier, ';');
    fputs($monfichier, $prenom[$e][1]);
    fputs($monfichier, ';');
    fputs($monfichier, $nom[$e][2]);
    fputs($monfichier, ';');
    fputs($monfichier, $email[$e][3]);
    fputs($monfichier, ';');
    fputs($monfichier, $cours[$e][4]);
    fputs($monfichier, "\n");
}