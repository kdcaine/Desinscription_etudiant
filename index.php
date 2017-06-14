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
 * Main info
 *
 * @package    tool_cours_etudiant
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('tool_desinscription_etudiant');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('pluginname', 'tool_desinscription_etudiant');
$PAGE->set_title($strheading);
$PAGE->set_heading('Désinscription d\'étudiant');

echo $OUTPUT->header();
?>

<!DOCTYPE html>
<html>
    
    <center>
        <h1>Système de désinscription d'étudiant :</h1> 
    </center>

    <body>
            <br />
            <p>Veuillez uploader votre fichier à cet emplacement pour permettre la désinscription : </p>
            <br />
            <form action="lecture.php" method='post' enctype="multipart/form-data">
                Votre fichier : <input type='file' name='sel_file' size='20'>
                <input type='submit' name='upload' value='envoyer'>
            </form>
            <br />
            <br />
            <center><h4>Notice d'utilisation : </h4></center>

            <p>Votre fichier est au format ".csv" et il doit être écrit sous forme "nomCours; methode d'inscription; rôles"</p>
            <p>Nous avons différentes méthodes d'inscription :</p>
            <ul>
              <li>manual : ajout manuel par le professeur</li>
              <li>self   : auto-inscription</li>
              <li>guest  : invité</li>
            </ul>
            <p>Voici les différents rôles possibles :</p>
            <ul>
              <li>1 : Etudiant</li>
              <li>2 : Enseignant</li>
              <li>3 : Enseignant non éditeur</li>
            </ul>
            <br />
            <p>Voici un exemple d'écriture pour une ligne votre fichier :</p>
            <center><p>monCours;manual;1</p></center>
    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();