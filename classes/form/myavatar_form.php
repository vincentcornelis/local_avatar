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
 * Edit avatar
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package   local_avatar
 * @copyright 03/09/2024 LdesignMedia.nl - Luuk Verhoeven
 * @author    Vincent Cornelis
 **/

namespace local_avatar\form;

use moodleform;

require_once($CFG->libdir . '/formslib.php');

/**
 * Class myavatar_form
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package   local_avatar
 * @copyright 03/09/2024 LdesignMedia.nl - Luuk Verhoeven
 * @author    Vincent Cornelis
 **/
class myavatar_form extends moodleform {

    protected function definition() {
        $mform = $this->_form;

        $mform->addElement(
            'advcheckbox',
            'showownavatar',
            get_string('myavatarform:showownavatar', 'local_avatar'),
            ' ',
            [0, 1]
        );

        $mform->addElement(
            'advcheckbox',
            'showownavatartoothers',
            get_string('myavatarform:showownavatartoothers', 'local_avatar'),
            ' ',
            [0, 1]
        );

        $mform->addElement(
            'advcheckbox',
            'showotheravatars',
            get_string('myavatarform:showotheravatars', 'local_avatar'),
            ' ',
            [0, 1]
        );

        $mform->addElement('text', 'shownumberofavatars', get_string('myavatarform:shownumberofavatars', 'local_avatar'));
        $mform->setType('shownumberofavatars', PARAM_INT);

        $mform->addElement(
            'advcheckbox',
            'avatarsmovement',
            get_string('myavatarform:avatarsmovement', 'local_avatar'),
            ' ',
            [0, 1]
        );

        $radioarray = [];
        $avatars = [
            '1' => '../pix/avatar1.png',
            '2' => '../pix/avatar1.png',
            '3' => '../pix/avatar1.png',
        ];

        foreach ($avatars as $value => $image) {
            $img = \html_writer::empty_tag('img', ['src' => $image, 'alt' => $value, 'style' => 'width: 50px; height: 50px;']);
            $label = \html_writer::tag('label', $img, ['for' => 'avatar_' . $value]);
            $radioarray[] = $mform->createElement('radio', 'selectedavatar', '', $label, $value);
        }

        $mform->addGroup($radioarray, 'avatarradiogroup', get_string('myavatarform:selectavatar', 'local_avatar'), null, false);

        $mform->addElement('submit', 'submitbutton', get_string('savechanges'));
    }

    public function handle_submission() {
        if ($this->is_cancelled()) {
            // TODO: Handle the cancellation.
            return;
        } else if ($data = $this->get_data()) {
            global $DB;
            global $USER;

            $data->userid = $USER->id;

            // Check if a record for this user already exists.
            if ($existing_record = $DB->get_record('local_avatar', ['userid' => $USER->id])) {
                // Update the existing record.
                $data->id = $existing_record->id; // Set the ID to ensure the correct record is updated.
                $DB->update_record('local_avatar', $data);
            } else {
                // Insert a new record.
                $DB->insert_record('local_avatar', $data);
            }
        }

    }

}
