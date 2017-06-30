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
 * Add page to admin menu.
 * @package    tool_filtered_bulk_unenrollment
 * @copyright  2017 Puagnol André John
 */

defined('MOODLE_INTERNAL') || die;

if ($hassiteconfig) { // Needs this condition or there is error on login page.
    $ADMIN->add('server', new admin_externalpage('tool_filtered_bulk_unenrollment',
            get_string('pluginname', 'tool_filtered_bulk_unenrollment'),
            new moodle_url('/admin/tool/filtered_bulk_unenrollment/index.php')));
}