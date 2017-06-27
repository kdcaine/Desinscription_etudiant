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

$idusertrouverasuppfinale = array();
$idusertrouver = array();

for ($c = 0; $c < $_SESSION['$taille']; $c++) {
    $f = 0;
    $idcourstrouver = $_SESSION['idcours'][$c];
    $nomcours = $_SESSION['nomCours'][$c];

    // On récupère le rôle depuis le fichier CSV.
    $role = $_SESSION['$role0'][$c];

    // Requete pour retrouver l'id des users pour ne pas les supprimer.
    $useridtrouveragarder = $DB->get_records_sql("SELECT DISTINCT {user_enrolments}.userid
                                        FROM {role}, {role_assignments}, {user}, {user_enrolments}, {enrol}, {course}
                                        WHERE {role_assignments}.userid = {user}.id
                                        AND {role}.id = {role_assignments}.roleid
                                        AND {role_assignments}.roleid != ?
                                        AND {user}.id = {user_enrolments}.userid
                                        AND {enrol}.id = {user_enrolments}.enrolid
                                        AND {user_enrolments}.enrolid = ?
                                        AND {course}.shortname = ?
                                        AND {course}.id = {enrol}.courseid",
                                        array($role, $idcourstrouver, $nomcours)
                                    );
    $p = 0;
    foreach ($useridtrouveragarder as $idgarder) {
        $idusertrouver[$p] = $idgarder->userid;
        $p++;
    }

    for ($q = 0; $q < $p ; $q++) {
        // Requete pour retrouver l'id des user pour les supprimer.
        $useridtrouverasupp = $DB->get_records_sql('SELECT DISTINCT {user_enrolments}.userid
                                        FROM {user}, {user_enrolments}, {enrol}, {course}, {role_assignments}, {role}
                                        WHERE {user}.id = {user_enrolments}.userid
                                        AND {enrol}.id = {user_enrolments}.enrolid
                                        AND {user_enrolments}.enrolid = ?
                                        AND {course}.id = {enrol}.courseid
                                        AND {user_enrolments}.userid != ?
                                        AND {role_assignments}.roleid = ?
                                        AND {role_assignments}.userid = {user}.id
                                        AND {role}.id = {role_assignments}.roleid',
                                        array($idcourstrouver, $idusertrouver[$q],$role)
                                    ); 
    }    

    foreach ($useridtrouverasupp as $requete) {
        $idusertrouverasuppfinale[$f] = $requete->userid;
        $table = 'user_enrolments';
        $conditions = array('enrolid' => $idcourstrouver, 'userid' => $idusertrouverasuppfinale[$f]);
        $suppetudiant = $DB->delete_records($table, $conditions);
        $f++;
    }
}