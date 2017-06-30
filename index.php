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
 * @package    tool_filtered_bulk_unenrollment
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once($CFG->libdir.'/adminlib.php');

admin_externalpage_setup('tool_filtered_bulk_unenrollment');

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('admin');
$strheading = get_string('pluginname', 'tool_filtered_bulk_unenrollment');
$PAGE->set_title($strheading);
$PAGE->set_heading($strheading);

echo $OUTPUT->header();
?>

<!DOCTYPE html>
<html>
    
    <center>
        <h1><?php echo get_string('titreindex', 'tool_filtered_bulk_unenrollment'); ?></h1> 
    </center>

    <body>
            <br />
            <p><?php echo get_string('emplacement', 'tool_filtered_bulk_unenrollment'); ?></p>
            <br />
            <form action="lecture.php" method='post' enctype="multipart/form-data">
                <?php echo get_string('fichier', 'tool_filtered_bulk_unenrollment'); ?><input type='file' name='sel_file' size='20'>
                <input type='submit' name='upload' value="<?php echo get_string('envoyer', 'tool_filtered_bulk_unenrollment'); ?>">
            </form>
            <br />
            <br />
            <center><h4><?php echo get_string('notice', 'tool_filtered_bulk_unenrollment'); ?></h4></center>

            <p><?php echo get_string('format', 'tool_filtered_bulk_unenrollment'); ?></p>
            <p><?php echo get_string('methode', 'tool_filtered_bulk_unenrollment'); ?></p>
            <ul>
              <li><?php echo get_string('methode1', 'tool_filtered_bulk_unenrollment'); ?></li>
              <li><?php echo get_string('methode2', 'tool_filtered_bulk_unenrollment'); ?></li>
              <li><?php echo get_string('methode3', 'tool_filtered_bulk_unenrollment'); ?></li>
            </ul>
            <p><?php echo get_string('rolepossible', 'tool_filtered_bulk_unenrollment'); ?></p>
            <ul>
              <li><?php echo get_string('role1', 'tool_filtered_bulk_unenrollment'); ?></li>
              <li><?php echo get_string('role2', 'tool_filtered_bulk_unenrollment'); ?></li>
              <li><?php echo get_string('role3', 'tool_filtered_bulk_unenrollment'); ?></li>
            </ul>
            <br />
            <p><?php echo get_string('noticeexemple', 'tool_filtered_bulk_unenrollment'); ?></p>
            <center><p><?php echo get_string('example', 'tool_filtered_bulk_unenrollment'); ?></p></center>
    </body>
</html>  

<?php
// Display the footer.
echo $OUTPUT->footer();