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
 * Strings for component 'tool_desinscription_etudiant', language 'en'.
 *
 * @package    tool_desinscription_etudiant
 * @copyright  2017 Puagnol André John
 */

defined('MOODLE_INTERNAL') || die();

$string['pluginname'] = 'Filtered Bulk Unenrollment';
$string['maintitle'] = 'Main page title';
// Traduction fichier index.
$string['titreindex'] = 'User unsubscription system: ';
$string['emplacement'] = 'Please upload your file to this location for unsubscription: ';
$string['fichier'] = 'Your file: ';
$string['envoyer'] = 'send';
$string['notice'] = 'Instructions: ';
$string['format'] = "Your file is a CSV and must be written as 'course shortname, registration method, roles'";
$string['methode'] = 'Enrollment methods:';
$string['methode1'] = 'manual : manual enrollment by teacher';
$string['methode2'] = 'self   : auto-enrollment';
$string['methode3'] = 'guest';
$string['rolepossible'] = 'Roles : ';
$string['role1'] = '1 : Student';
$string['role2'] = '2 : Editing Teacher';
$string['role3'] = '3 : Teacher';
$string['noticeexemple'] = 'Example of line in your file: ';
$string['example'] = 'coursName;manual;1';
// Traduction fichier lecture.
$string['titrelecture'] = 'CSV file analysis:';
$string['filecsv'] = 'CSV file name: ';
$string['namecours'] = 'Course name: ';
$string['type'] = 'Enrollment type: ';
$string['role'] = 'Role: ';
$string['novalide'] = 'No file detected or invalid file !';
$string['listeuser'] = 'List of users selected for unsubscription:';
$string['prenom'] = 'Firstname';
$string['nom'] = 'Lastname';
$string['cours'] = 'Course';
$string['confirmer'] = 'Please confirm your action:';
$string['d'] = 'UNSUBSCRIBE';
$string['dl'] = 'UNSUBSCRIBE + LOG';
$string['annuler'] = 'CANCEL';
// Traduction fichier savePopUp.
$string['titresave'] = 'Please confirm for unsubscription ';
$string['boutonconfirmer'] = 'Confirm';
// Traduction fichier suppIndex.
$string['titresuppi'] = 'Successful unsubscription';