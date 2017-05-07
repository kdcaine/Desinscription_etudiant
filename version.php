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
 * Version details.
 *
 * @package    tool_desinscription_etudiant
 * @copyright  2017 Puagnol André John
 */

defined('MOODLE_INTERNAL') || die;

$plugin = new stdClass();

$plugin->version  = 2017042500;
$plugin->release = '1.0';
$plugin->requires = 2015051103;
$plugin->maturity = MATURITY_STABLE;
$plugin->component = 'tool_desinscription_etudiant'; //nom complet du plugin (pour diagnostic)
