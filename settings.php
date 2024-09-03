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
 * Plug-in admin settings.
 *
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 *
 * @package   local_avatar
 * @copyright 03/09/2024 LdesignMedia.nl - Luuk Verhoeven
 * @author    Vincent Cornelis
 **/

defined('MOODLE_INTERNAL') || die;

global $ADMIN;

if ($hassiteconfig) {

    $settings = new admin_settingpage('local_avatar', get_string('pluginname', 'local_avatar'));

    $settings->add(
        new admin_setting_configcheckbox(
            'local_avatar/enable',
            get_string('settings:enable', 'local_avatar'),
            get_string('settings:enable_desc', 'local_avatar'),
            true,
            get_string('settings:enabled', 'local_avatar'),
            get_string('settings:disabled', 'local_avatar')
        )
    );

    $ADMIN->add('localplugins', $settings);

    // TODO: Plugin active/not.

    // TODO: Admin externalpage with filemaanger for avatar images.

}
