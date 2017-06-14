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
 * Lecture et validation désinscription
 *
 * @package    tool_desinscription_etudiant
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');
require_once("$CFG->libdir/dml/moodle_database.php");

admin_externalpage_setup('tool_desinscription_etudiant');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('pluginname', 'tool_desinscription_etudiant');
$PAGE->set_title($strheading);
$PAGE->set_heading('Désinscription d\'étudiant');

echo $OUTPUT->header();

global $DB;


?>
    <center>
        <h1>Lecture du fichier CSV fourni :</h1> 
    </center>
<?php


// Recuperation de donner en plusieurs pages.
session_start();

// Lecture fichier csv.

?>

<!DOCTYPE html>
<html>
    
    <body>

<?php
echo '<br>';

if (isset($_POST['upload'])) {
    $fname = $_FILES['sel_file']['name'];
    echo '<br>';
    echo 'Fichier csv uploadé : '.$fname.' ';
    $chkext = explode(".", $fname);

    if (strtolower(end($chkext)) == "csv") {
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");

        // Sauvegarde de toutes les données du fichier CSV dans un tableau.
        $stockdonnee = array();

        while (($data = fgetcsv($handle, 1000, ";")) !== false) {
            echo '<br>';
            echo '<br>';

            if ($data[1] == 'manual') {
                $typeinscription = 'manual';

            } else {
                $typeinscription = 'self';
            }
            if ($data[2] == 1) {
                $role = 'étudiant';
            }
            echo "Nom du cours : " .$data[0];
            echo '<br>';
            echo "Type d'inscription : " .$typeinscription;
            echo '<br>';
            echo "Rôle : " .$role;
            echo '<br>';

            array_push($stockdonnee, $data);
        }
        fclose($handle);
        echo '<br>';
        // Récupère la taille du taille contenant toute les variables du fichier csv.
        // Dans notre cas la valeur sera de 2 car j'ai que deux cours a supprimer.
        $_SESSION['$taille'] = count($stockdonnee);


        // Création des sessions sous forme de tableau.
        $_SESSION['idcours'] = array();
        $_SESSION['nomCours'] = array();

        for ($c = 0; $c < $_SESSION['$taille']; $c++) {
            $idcours = $DB->get_records_sql('SELECT {enrol}.id
                                                FROM {enrol}, {course}
                                                WHERE {enrol}.enrol = ?
                                                AND {enrol}.courseid = {course}.id
                                                AND {course}.shortname = ?',
                                                array($stockdonnee[$c][1], $stockdonnee[$c][0])
                                              );
            foreach ($idcours as $cours) {
                $cours2 = $cours->id;
            }
            $idcours1 = $cours2;

            // Affectations de l'id cours obtenue par la requete dans le tableau.
            $_SESSION['idcours'][$c] = $idcours1;


            // Insertion du nom du cours dans le tableau.
            $_SESSION['nomCours'][$c] = $stockdonnee[$c][0];
        }
    } else {
        echo "Aucun fichier présent ou fichier invalide !";
    }
}
?>
            <center>
            <p> Voici la liste des étudiants sélectionné pour la désinscription :</p>
            </center>
            <div style="overflow:scroll; border:#7FDD4C 3px solid;">
            <center>
            <table>
                <tr>
                   <th>Login</th>
                   <th>Prénom</th>
                   <th>Nom</th>
                   <th>Cours</th>
                </tr>
                <tr>
<?php

// Tableau pour enregistrer les valeurs obtenue par la requete.
$numetudiant = array();
$prenom = array();
$nom = array();
$cours = array();

// Compteur pour enregistrer chaque valeur obtenue par la requete.
$d = 0;

for ($c = 0; $c < $_SESSION['$taille']; $c++) {

    $idcourst = $_SESSION['idcours'][$c];
    $courst = $_SESSION['nomCours'][$c];

    $selection = 'username, firstname, lastname, shortname';
    $table = '{enrol}, {user}, {user_enrolments}, {course}';
    $condition1 = "{user}.id = {user_enrolments}.userid AND {user}.username != 'guest' AND {user}.username != 'admin'";
    $condition2 = "{enrol}.id = {user_enrolments}.enrolid AND {user_enrolments}.enrolid ='$idcourst' AND shortname = '$courst'";

    $sql4 = " SELECT $selection FROM $table WHERE $condition1 AND $condition2";
    $sql5 = $DB->get_records_sql($sql4);

    foreach ($sql5 as $liste) {
        $numetudiant[$d][0] = $liste->username;
        $prenom[$d][1] = $liste->firstname;
        $nom[$d][2] = $liste->lastname;
        $cours[$d][3] = $liste->shortname;
        $d++;
    }
}
    echo '<br />';

for ($e = 0; $e < $d; $e++) {
?>

                    <td><?php echo $numetudiant[$e][0]; ?></td>
                    <td><?php echo $prenom[$e][1]; ?></td>
                    <td><?php echo $nom[$e][2]; ?></td>
                    <td><?php echo $cours[$e][3]; ?></td>
                </tr>
<?php
}
?>
            </table>
            </center>
            </div>

            <br />
            <br />

            <center>
            <p> Merci de confirmer votre opération :</p>
           

            <!-- Bouton de redirection à la page principale du plugin -->
            <br />

            <table> 
            <tr> 
            <td> 
            <form action="index.php" onsubmit="window.open('suppIndex.php','popup','width=200, height=10')"  method="post">
                <input type="submit" value="DESINSCRIRE">
            </form>
            </td>
            <td>
            <form action="index.php" onsubmit="window.open('savePopUp.php','popup','width=300, height=300')" method="post">
                <input type="submit" value="DESINSCRIRE + LOG">
            </form>
            </td>
            <td>
            <!-- Bouton pour annuler le processus --> 
            <form name="x" action="index.php" method="post">
                <input type="submit" value="Annuler">
            </form>
            </td>
            </tr> 
            </table> 

             </center>
    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();