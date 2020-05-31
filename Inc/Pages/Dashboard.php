<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;
use \Inc\API\SettingsApi;
use \Inc\API\Callbacks\AdminCallbacks;
use \Inc\API\Callbacks\ManagerCallbacks;

class Dashboard extends BaseController
{
    public $settings;

    public $pages = array();

    public $callbacks;
    public $callbacks_mngr;

    public function setPages(){
        $this->pages = [
            [
                'page_title' => 'MRL Plugin',
                'menu_title' => 'MRL Accueil',
                'capability' => 'manage_options',
                'menu_slug' => 'mrl_plugin',
                'callback' => [$this->callbacks, 'adminDashboard'],
                'icon_url' => 'dashicons-store',
                'position' => 110
            ]
        ];

    }

    public function setSettings(){

            $args = [
                [ 'option_group' => 'mrl_plugin_settings',
                'option_name' => 'mrl_plugin',
                'callback' => [$this->callbacks_mngr, 'checkboxSanitize']
                ]
            ];

            $this->settings->setSettings($args);
    }

    public function setSections(){
        $args = [
            [
                'id' => 'mrl_admin_index',
                'title' => 'Settings Manager',
                'callback' => [$this->callbacks_mngr, 'adminSectionManager'],
                'page' => 'mrl_plugin'
            ]
            ];

            $this->settings->setSections($args);
    }

    public function setFields(){

        $args = [];

        foreach ( $this->managers_admin as $key => $value) {
            $args[] = [
                'id' => $key,
                'title' => $value,
                'callback' => [$this->callbacks_mngr, 'checkboxField'],
                'page' => 'mrl_plugin',
                'section' => 'mrl_admin_index',
                'args' => [
                    [
                        'option_name' => 'mrl_plugin',
                        'label_for' => $key,
                        'class' => 'example-classe'
                    ]
                ]
            ];
        }

            $this->settings->setFields($args);
    }


    public function register(){
        $this->settings = new SettingsApi();

        $this->callbacks = new AdminCallbacks;
        $this->callbacks_mngr = new ManagerCallbacks;

        $this->setPages();

        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPages( $this->pages )->subPage('Accueil')->register();
    }
}