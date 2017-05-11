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
session_start();
?>
    <center>
        <h1>Désinscription final :</h1> 
    </center>
<?php
        $idcourstrouver = $_SESSION['idcours'];
        $table = 'user_enrolments';
        $conditions = array('enrolid' => $idcourstrouver);

        $suppetudiant = $DB->delete_records($table, $conditions);
?>
<!DOCTYPE html>
<html>
    <body>

            <br />
            <h4> La désinscription est un succès </h4>


            <p> Pour revenir à la page principal cliquer sur le bouton ci-dessous</p>
            <!-- Bouton de redirection à la page principale du plugin --> 
            <center><form name="x" action="index.php" method="post">
                <input type="submit" value="Page accueil">
            </form></center>

    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();
