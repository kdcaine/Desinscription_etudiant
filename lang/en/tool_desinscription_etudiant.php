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

$string['pluginname'] = 'Unenroll student courses';
$string['maintitle'] = 'Main page title';
// Traduction fichier index.
$string['titreindex'] = 'Student unsubscribe system : ';
$string['emplacement'] = 'Please upload your file to this location for unsubscription : ';
$string['fichier'] = 'Your file : ';
$string['envoyer'] = 'send';
$string['notice'] = 'Instructions for use : ';
$string['format'] = "Your file is a CSV file and must be written as 'course shortname, registration method, roles'";
$string['methode'] = 'We have different enrollment methods :';
$string['methode1'] = 'manual : manual enroll by teacher';
$string['methode2'] = 'self   : auto-enrollment';
$string['methode3'] = 'guest';
$string['rolepossible'] = 'Différent role : ';
$string['role1'] = '1 : Student';
$string['role2'] = '2 : Teacher';
$string['role3'] = '3 : Assistant Teacher';
$string['noticeexemple'] = 'An example of writing for a line in your file : ';
$string['example'] = 'coursName;manual;1';
// Traduction fichier lecture.
$string['titrelecture'] = 'Read CSV file upload :';
$string['filecsv'] = 'CSV file upload : ';
$string['namecours'] = 'Course name : ';
$string['type'] = 'Enrollment type : ';
$string['role'] = 'Role : ';
$string['novalide'] = 'No files present or invalid file !';
$string['listeuser'] = 'List of users selected for unsubscription:';
$string['prenom'] = 'Firstname';
$string['nom'] = 'Lastname';
$string['cours'] = 'Course';
$string['confirmer'] = 'Please confirm your action :';
$string['d'] = 'UNSUBSCRIBE';
$string['dl'] = 'UNSUBSCRIBE + LOG';
$string['annuler'] = 'CANCEL';
// Traduction fichier savePopUp.
$string['titresave'] = 'Please confirm for unsubscription ';
$string['boutonconfirmer'] = 'Confirm';
// Traduction fichier suppIndex.
$string['titresuppi'] = 'Successful unsubscription';