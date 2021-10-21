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
 * ${userblock} file description here.
 *
 * @package    ${userblock}
 * @copyright  2021 SysBind Ltd. <service@sysbind.co.il>
 * @auther     schindlerl
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_userblock extends block_base
{

    function init()
    {
        $this->title = get_string('pluginname', 'block_userblock');
    }


    function get_content()
    {
        global $DB;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $users = $DB->get_records('user');
        foreach ($users as $user) {
            $userString .= $user->id . ' ' . $user->firstname . ' ' . $user->lastname . '<br>';
        }
        $this->content = new stdClass();
        $this->content->text = $userString;
        $this->content->footer = 'System known user count: ' . sizeof($users);

        return $this->content;
    }
}
