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
 * Lecture fchier csv
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
echo '<br>';

if (isset($_POST['upload'])) {
    $fname = $_FILES['sel_file']['name'];
    echo '<br>';
    echo 'Fichier csv uploader: '.$fname.' ';
    $chkext = explode(".", $fname);

    if (strtolower(end($chkext)) == "csv") {
        $filename = $_FILES['sel_file']['tmp_name'];
        $handle = fopen($filename, "r");
        if (($data = fgetcsv($handle, 1000, ";")) !== false) {
            echo '<br>';
            echo '<br>';

            if ($data[1] == 1) {
                $typeinscription = 'manual';
            } else {
                $typeinscription = 'self';
            }
            if ($data[2] == 1) {
                $role = 'étudiant';
            }
            echo "nom du cours : " .$data[0];
            echo '<br>';
            echo "Type d'inscription : " .$typeinscription;
            echo '<br>';
            echo "role : " .$role;
            echo '<br>';
            $idcours = $DB->get_records_sql('SELECT {enrol}.id
                                                FROM {enrol}, {course}
                                                WHERE {enrol}.enrol = ?
                                                AND {enrol}.courseid = {course}.id
                                                AND {course}.shortname = ?',
                                                array($typeinscription, $data[0])
                                              );

            foreach ($idcours as $cours) {
                $cours2 = $cours->id;
            }
            $idcours1 = $cours2;

            $_SESSION['idcours'] = $idcours1;
            $_SESSION['nomCours'] = $data[0];
        }
        fclose($handle);
        echo '<br>';
    } else {
        echo "Aucun fichier présent ou fichier invalide !";
    }
}
?>

<!DOCTYPE html>
<html>
    
    <body>

            <center>
           
           <!-- Execution de l'enregistrement avant la desinscription' --> 
            <form name="y" action="desinscription.php" method="post">
                <input type="submit" value="Valider la désinscription">
            </form>

            <!-- Bouton pour annuler le processus --> 
            <form name="x" action="index.php" method="post">
                <input type="submit" value="Annuler">
            </form>

            </center>

            <br />
            <br />

    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();