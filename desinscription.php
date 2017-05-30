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
session_start();
?>
    <center>
        <h1>Désinscription final :</h1> 
    </center>

<!DOCTYPE html>
<html>
    <body>

            <br />
            <h4> Validation final pour la désinscription </h4>
            <br />
            <p> En cliquant sur ce bouton ci-dessous, vous allez valider la désinscription et revenir sur la page principal :</p>
            <!-- Bouton de redirection à la page principale du plugin -->
            <br />
            <center>
            <form name="x" action="suppIndex.php" method="post">
                <input type="submit" value="DESINSCRIRE">
            </form>
            </center>
            <br /><br /><br />
            <p> Si vous souhaitez obtenir une sauvegarde des etudiants désinscrit, veuillez cliquer =>
            <a href="#" onClick='f=window.open("savePopUp.php","fenetre","width=300, height=300") '><font color="red">ICI</font></a></p>

    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();