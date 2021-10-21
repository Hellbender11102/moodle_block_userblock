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

    /**
     * Sets the flag for config file
     * @return bool
     */
    function has_config()
    {
        return true;
    }

    /**
     * Displays all users
     * @return stdClass|stdObject|null
     * @throws coding_exception
     * @throws dml_exception
     */
    function get_content()
    {
        global $DB; //get db global connection

        if ($this->content !== NULL) {
            return $this->content;
        }

        $users = $DB->get_records('user');

        $showcourses = get_config('block_userblock', 'showcourses');
        $content="";
        //if user settings are switched
        if ($showcourses) {
            foreach ($users as $user) {
                // load names and courses
                $userCourses = enrol_get_all_users_courses($user->id);
                $courseTable = '<ul>';
                foreach ($userCourses as $userCourse) {
                    $courseTable .= '<li> ' .get_string('userblock_courid','block_userblock')
                        .' ' . $userCourse->id . '<br>'
                        .get_string('userblock_coursename' ,'block_userblock')
                        . ' '. $userCourse->fullname . '</li>';
                }
                $courseTable .= '</ul>';
                $content .= $user->firstname . ' ' . $user->lastname . $courseTable . '<br>';
            }
        } else
            // load names
            foreach ($users as $user) {
                $content .= $user->firstname . ' ' . $user->lastname . '<br>';
            }


        $this->content = new stdClass();
        $this->content->text = $content;
        $this->content->footer = get_string('userblock_footer','block_userblock').' ' . sizeof($users);

        return $this->content;
    }
}
