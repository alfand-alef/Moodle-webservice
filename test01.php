<?php

class core_user_external extends external_api {

    /**
     * Returns description of method parameters
     *
     * @return external_function_parameters
     * @since Moodle 2.2
     */
    public static function create_users_parameters() {
        global $CFG;
        $userfields = [
            'createpassword' => new external_value(PARAM_BOOL, 'True if password should be created and mailed to user.',
                    VALUE_OPTIONAL),
            // General.
            'username' => new external_value(core_user::get_property_type('username'),
                    'Username policy is defined in Moodle security config.'),
            'auth' => new external_value(core_user::get_property_type('auth'), 'Auth plugins include manual, ldap, etc',
                    VALUE_DEFAULT, 'manual', core_user::get_property_null('auth')),
            'password' => new external_value(core_user::get_property_type('password'),
                    'Plain text password consisting of any characters', VALUE_OPTIONAL),
            'firstname' => new external_value(core_user::get_property_type('firstname'), 'The first name(s) of the user'),
            'lastname' => new external_value(core_user::get_property_type('lastname'), 'The family name of the user'),
            'email' => new external_value(core_user::get_property_type('email'), 'A valid and unique email address'),
            'maildisplay' => new external_value(core_user::get_property_type('maildisplay'), 'Email display', VALUE_OPTIONAL),
            'city' => new external_value(core_user::get_property_type('city'), 'Home city of the user', VALUE_OPTIONAL),
            'country' => new external_value(core_user::get_property_type('country'),
                    'Home country code of the user, such as AU or CZ', VALUE_OPTIONAL),
            'timezone' => new external_value(core_user::get_property_type('timezone'),
                    'Timezone code such as Australia/Perth, or 99 for default', VALUE_OPTIONAL),
            'description' => new external_value(core_user::get_property_type('description'), 'User profile description, no HTML',
                    VALUE_OPTIONAL),
            // Additional names.
            'firstnamephonetic' => new external_value(core_user::get_property_type('firstnamephonetic'),
                    'The first name(s) phonetically of the user', VALUE_OPTIONAL),
            'lastnamephonetic' => new external_value(core_user::get_property_type('lastnamephonetic'),
                    'The family name phonetically of the user', VALUE_OPTIONAL),
            'middlename' => new external_value(core_user::get_property_type('middlename'), 'The middle name of the user',
                    VALUE_OPTIONAL),
            'alternatename' => new external_value(core_user::get_property_type('alternatename'), 'The alternate name of the user',
                    VALUE_OPTIONAL),
            // Interests.
            'interests' => new external_value(PARAM_TEXT, 'User interests (separated by commas)', VALUE_OPTIONAL),
            // Optional.
            'idnumber' => new external_value(core_user::get_property_type('idnumber'),
                    'An arbitrary ID code number perhaps from the institution', VALUE_DEFAULT, ''),
            'institution' => new external_value(core_user::get_property_type('institution'), 'institution', VALUE_OPTIONAL),
            'department' => new external_value(core_user::get_property_type('department'), 'department', VALUE_OPTIONAL),
            'phone1' => new external_value(core_user::get_property_type('phone1'), 'Phone 1', VALUE_OPTIONAL),
            'phone2' => new external_value(core_user::get_property_type('phone2'), 'Phone 2', VALUE_OPTIONAL),
            'address' => new external_value(core_user::get_property_type('address'), 'Postal address', VALUE_OPTIONAL),
            // Other user preferences stored in the user table.
            'lang' => new external_value(core_user::get_property_type('lang'), 'Language code such as "en", must exist on server',
                    VALUE_DEFAULT, core_user::get_property_default('lang'), core_user::get_property_null('lang')),
            'calendartype' => new external_value(core_user::get_property_type('calendartype'),
                    'Calendar type such as "gregorian", must exist on server', VALUE_DEFAULT, $CFG->calendartype, VALUE_OPTIONAL),
            'theme' => new external_value(core_user::get_property_type('theme'),
                    'Theme name such as "standard", must exist on server', VALUE_OPTIONAL),
            'mailformat' => new external_value(core_user::get_property_type('mailformat'),
                    'Mail format code is 0 for plain text, 1 for HTML etc', VALUE_OPTIONAL),
            // Custom user profile fields.
            'customfields' => new external_multiple_structure(
                    new external_single_structure(
                            [
                        'type' => new external_value(PARAM_ALPHANUMEXT, 'The name of the custom field'),
                        'value' => new external_value(PARAM_RAW, 'The value of the custom field')
                            ]
                    ), 'User custom fields (also known as user profil fields)', VALUE_OPTIONAL),
            // User preferences.
            'preferences' => new external_multiple_structure(
                    new external_single_structure(
                            [
                        'type' => new external_value(PARAM_RAW, 'The name of the preference'),
                        'value' => new external_value(PARAM_RAW, 'The value of the preference')
                            ]
                    ), 'User preferences', VALUE_OPTIONAL),
        ];
        return new external_function_parameters(
                [
            'users' => new external_multiple_structure(
                    new external_single_structure($userfields)
            )
                ]
        );
    }
}
    