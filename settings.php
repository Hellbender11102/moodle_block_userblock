<?php

if($ADMIN->fulltree){
    $settings->add(new admin_setting_configcheckbox('block_userblock/showcourses',
        get_string('userblock_settings_visiblename','block_userblock'),
        get_string('userblock_settings_descriptopn','block_userblock'),
        0
    ));
}