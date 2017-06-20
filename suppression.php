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
 * suppression.php
 *
 * @package    tool_description_etudiant
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');
require_once("$CFG->libdir/dml/moodle_database.php");

global $DB;

// Test de recuperation de donner en plusieurs pages.
session_start();

header('Location: telechargement.php');

$ici = array();

for ($c = 0; $c < $_SESSION['$taille']; $c++) { 
    $f = 0;
    $idcourstrouver = $_SESSION['idcours'][$c];

    $useridtrouver = $DB->get_records_sql('SELECT {user_enrolments}.userid
                                        FROM {user}, {user_enrolments}, {enrol}, {course} 
                                        WHERE {user}.id = {user_enrolments}.userid
                                        AND {enrol}.id = {user_enrolments}.enrolid
                                        AND {user_enrolments}.enrolid = ?
                                        AND {course}.id = {enrol}.courseid
                                        AND {user_enrolments}.userid != ?',
                                        array($idcourstrouver, 2)
                                    );
    foreach ($useridtrouver as $requete) {
        $ici[$f] = $requete->userid;
        $table = 'user_enrolments';
        $conditions = array('enrolid' => $idcourstrouver, 'userid' => $ici[$f]);
        $suppetudiant = $DB->delete_records($table, $conditions);
        $f++;
    }
}
echo "<script language='javascript'>window.close()</script>";
