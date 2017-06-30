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
 * telechargement.php
 *
 * @package    tool_filtered_bulk_unenrollment
 * @copyright  2017 Puagnol André John
 */

require_once(dirname(dirname(dirname(dirname(__FILE__)))).'/config.php');

$a = getcwd().'\sauvegarde\"'. "\n";
$b = substr($a, 0, -2);
$c = str_replace("\\", "/", $b);
$chemin = $c.'suppression.csv';
header('Content-Transfer-Encoding: binary');
header('Content-Disposition: attachment; filename="liste-utilisateurs-désinscrit.csv"');
header("Pragma: public");
readfile($chemin);
