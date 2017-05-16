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
 * enregistrer.php
 *
 * @package    tool_description_etudiant
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once($CFG->libdir.'/moodlelib.php');
require_once($CFG->libdir.'/adminlib.php');
require_once($CFG->libdir.'/formslib.php');
require_once($CFG->libdir.'/tablelib.php');
require_once(dirname(__FILE__).'/version.php');
require_once("$CFG->libdir/dml/moodle_database.php");

admin_externalpage_setup('tool_desinscription_etudiant');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('pluginname', 'tool_desinscription_etudiant');
$PAGE->set_title($strheading);
$PAGE->set_heading('Désinscription d\'étudiant');
$PAGE->set_pagelayout('standard');

echo $OUTPUT->header();

global $DB;


// Test de recuperation de donner en plusieurs pages.
session_start();

?>
<html>

    <center>
        <h1>Enregistrement de la suppression :</h1> 
    </center>


    <body>
            <!-- Bouton de redirection à la page principale du plugin --> 
            <center>

            <br />
            <h5> En cliquant sur ce bouton, vous validez la désinscription </h5>
            <h5>vous retrouverez un fichier listant tous les étudiants que vous avez désinscrit avec le cours</h5>
            <form name="y" action="desinscription.php" method="post">
                <input type="submit" value="Valider la Désinscription">
            </form>

            <br />
            <h5>Pour annuler et revenir à la page d'acceuil veuillez cliquer sur ce lien : </h5>
            <form name="x" action="index.php" method="post">
                <input type="submit" value="Page accueil">
            </form>
            
            </center>
    </body>
</html>

<?php
// Display the footer.
echo $OUTPUT->footer();

// Enregistrer le resultat de la requete de suppression.
$idcourstrouver = $_SESSION['idcours'];
$courstrouver = $_SESSION['nomCours'];

$selection = 'username, firstname, lastname , email , shortname';
$tableselectionner = '{user}, {user_enrolments}, {course}';
$formatsauvegarde = "FIELDS TERMINATED BY ';' ENCLOSED BY '' ";
$line = "LINES TERMINATED BY '\n'";
$wherecondition = "enrolid ='$idcourstrouver'and {user}.username != 'guest' and {user}.username != 'admin'and shortname = '$courstrouver'";
$chemin = "'C:/Users/kdcaine/Desktop/suppression.csv'";

$sql2 = "SELECT DISTINCT $selection from $tableselectionner WHERE $wherecondition INTO OUTFILE $chemin $formatsauvegarde $line";
$sql3 = $DB->get_record_sql($sql2);