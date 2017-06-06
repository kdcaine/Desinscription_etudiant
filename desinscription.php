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
 * désinscription.php
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

// Recuperation de donner en plusieurs pages.
session_start();

?>


<!DOCTYPE html>
<html>
    <center>
        <h1>Désinscription final :</h1> 
    </center>
    <body>

            <br />
            <h4> Validation final pour la désinscription </h4>
            <br />
            <p> Voici la liste des étudiant sélectionner pour la désinscription accompagner du cours :</p>
            
            <div style="overflow:scroll; border:#7FDD4C 3px solid;">
            <center>
            <table>
                <tr>
                   <th>Numero étudiant</th>
                   <th>Prénom</th>
                   <th>Nom</th>
                   <th>Cours</th>
                </tr>
                <tr>
<?php
// Tableau pour enregistrer les valeurs obtenue par la requete.
$numEtudiant = array();
$prenom = array();
$nom = array();
$cours = array();

// Compteur pour enregistrer chaque valeur obtenue par la requete.
$d = 0;

for ($c = 0; $c < $_SESSION['$taille']; $c++) {

    $idcourst = $_SESSION['idcours'][$c];
    $courst = $_SESSION['nomCours'][$c];

    $sql4 = " SELECT username, firstname, lastname, shortname FROM {enrol}, {user}, {user_enrolments}, {course} WHERE {user}.id = {user_enrolments}.userid AND {user}.username != 'guest' AND {user}.username != 'admin'AND {enrol}.id = {user_enrolments}.enrolid AND {user_enrolments}.enrolid ='$idcourst' AND shortname = '$courst'";
    $sql5 = $DB->get_records_sql($sql4);

    foreach ($sql5 as $liste)  {
        $numEtudiant[$d][0] = $liste->username;
        $prenom[$d][1] = $liste->firstname;
        $nom[$d][2] = $liste->lastname;
        $cours[$d][3] = $liste->shortname;
        $d++;
    }
}
    echo '<br />';

for ($e = 0; $e < $d; $e++) {
?>

                    <td><?php echo $numEtudiant[$e][0]; ?></td>
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
            <p> En cliquant sur ce bouton ci-dessous, vous allez valider la désinscription et revenir sur la page principal :</p>
            <!-- Bouton de redirection à la page principale du plugin -->
            <br />
            <center>
            <form action="index.php" onsubmit="window.open('suppIndex.php','popup','width=200, height=10')"  method="post">
                <input type="submit" value="DESINSCRIRE">
            </form>
            </center>
            <br /><br /><br />
            <p> Si vous souhaitez obtenir une sauvegarde des etudiants désinscrit, veuillez cliquer ci-dessous : </p>

            <center>
                <form action="index.php" onsubmit="window.open('savePopUp.php','popup','width=300, height=300')" method="post">
                    <input type="submit" value="DESINSCRIRE + LOG">
                </form>
            </center>

    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();