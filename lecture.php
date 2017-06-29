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
        <h1><?php echo get_string('titrelecture', 'tool_desinscription_etudiant'); ?></h1> 
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
    $fileupload = get_string('filecsv', 'tool_desinscription_etudiant');
    echo $fileupload.$fname.' ';

    $chkext = explode(".", $fname);

    if (strtolower(end($chkext)) == "csv") {
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");

        // Sauvegarde de toutes les données du fichier CSV dans un tableau.
        $stockdonnee = array();
        // Sauvegarde des rôles des users à supprimer.
        $_SESSION['$role0'] = array();
        $_SESSION['$role1'] = array();
        $_SESSION['$role2'] = array();
        $compterole = 0;

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
                $_SESSION['$role0'][$compterole] = 5;
                // Id du rôle du prof.
                $_SESSION['$role1'][$compterole] = 3;
                // Id du rôle du tuteur.
                $_SESSION['$role2'][$compterole] = 4;
                $compterole++;
            } else if ($data[2] == 2) {
                $role = 'enseignant';
                $_SESSION['$role0'][$compterole] = 3;
                // Id du rôle de l'étudiant.
                $_SESSION['$role1'][$compterole] = 5;
                // Id du rôle du tuteur.
                $_SESSION['$role2'][$compterole] = 4;
                $compterole++;
            } else {
                $role = 'tuteur';
                $_SESSION['$role0'][$compterole] = 4;
                // Id du rôle de l'étudiant.
                $_SESSION['$role1'][$compterole] = 5;
                // Id du rôle du professeur.
                $_SESSION['$role2'][$compterole] = 3;
                $compterole++;
            }

            echo get_string('namecours', 'tool_desinscription_etudiant').$data[0];
            echo '<br>';
            echo get_string('type', 'tool_desinscription_etudiant').$typeinscription;
            echo '<br>';
            echo get_string('role', 'tool_desinscription_etudiant').$role;
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
        echo get_string('novalide', 'tool_desinscription_etudiant');
    }
}
?>
            <center>
            <p> <?php echo get_string('listeuser', 'tool_desinscription_etudiant'); ?></p>
            </center>
            <div style="overflow:scroll; border:#7FDD4C 3px solid;">
            <center>
            <table>
                <tr>
                   <th>Login</th>
                   <th><?php echo get_string('prenom', 'tool_desinscription_etudiant'); ?></th>
                   <th><?php echo get_string('nom', 'tool_desinscription_etudiant'); ?></th>
                   <th><?php echo get_string('cours', 'tool_desinscription_etudiant'); ?></th>
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
    $role = $_SESSION['$role0'][$c];

    $selection = 'username, firstname, lastname, {course}.shortname';
    $table = '{enrol}, {user}, {user_enrolments}, {course}, {role}, {role_assignments}';
    $condition0 = "{role_assignments}.userid = {user}.id AND {role}.id = {role_assignments}.roleid";
    $condition1 = "{role_assignments}.roleid = '$role'";
    $condition2 = "{user}.id = {user_enrolments}.userid AND {enrol}.id = {user_enrolments}.enrolid";
    $condition3 = " {user_enrolments}.enrolid ='$idcourst' AND {course}.shortname = '$courst'";

    $sql4 = " SELECT $selection FROM $table WHERE $condition0 AND $condition1 AND $condition2 AND $condition3";
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
            <p><?php echo get_string('confirmer', 'tool_desinscription_etudiant'); ?></p>
           

            <!-- Bouton de redirection à la page principale du plugin -->
            <br />

            <table> 
            <tr> 
            <td> 
            <form action="index.php" onsubmit="window.open('suppIndex.php','popup','width=200, height=10')"  method="post">
                <input type="submit" value="<?php echo get_string('d', 'tool_desinscription_etudiant'); ?>">
            </form>
            </td>
            <td>
            <form action="index.php" onsubmit="window.open('savePopUp.php','popup','width=300, height=300')" method="post">
                <input type="submit" value="<?php echo get_string('dl', 'tool_desinscription_etudiant'); ?>">
            </form>
            </td>
            <td>
            <!-- Bouton pour annuler le processus --> 
            <form name="x" action="index.php" method="post">
                <input type="submit" value="<?php echo get_string('annuler', 'tool_desinscription_etudiant'); ?>">
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