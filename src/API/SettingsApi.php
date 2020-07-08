<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\API;

class SettingsApi
{
    public $admin_pages = array();
    public $admin_subpages = array();
    public $settings = array();
    public $sections = array();
    public $fields = array();

    public function register()
    {
        if ( ! empty( $this->admin_pages) || ! empty( $this->admin_subpages)) {
            add_action( 'admin_menu', array( $this, 'addAdminMenu' ) );
        }

        if ( !empty($this->settings) ) {
            add_action( 'admin_menu', [$this, 'registerCustomFields']);
        }
    }

    /*On récupère l'array concernant la page principal du tableau de bord.
    Cet array est recupéré depuis Dashboard.php dans la fonction setPages.*/
    public function addPages( array $pages )
    {
        $this->admin_pages = $pages;

        return $this;
    }

    /*On récupère les arrays contenant les infos sur les sous-pages et on les y insère dans admin_subpages
    Ces arrays sont dans chaque controlleur correspondant à une sous pages possédant une fonction setSubpages()*/
    public function addSubpages( array $pages )
    {
        $this->admin_subpages = array_merge( $this->admin_subpages, $pages);
        return $this;
    }

    public function setSettings( array $settings )
    {
        $this->settings = $settings;

        return $this;
    }
    public function setSections( array $sections )
    {
        $this->sections = $sections;

        return $this;
    }
    public function setfields( array $fields )
    {
        $this->fields = $fields;

        return $this;
    }


    /*Sert juste à changer le nom de la premère sous-page lié à la page principal
    On entre le nom dans Dashboard.php dans la fonction register()*/
    public function subPage( string $title = null )
    {
        if ( empty( $this->admin_pages) ) {
            return $this;
        }

        $admin_page = $this->admin_pages[0];

        $sub_page = [
                [
                    'parent_slug' => $admin_page['menu_slug'],
                    'page_title' => $admin_page['page_title'],
                    'menu_title' => ($title) ? $title : $admin_page['menu_title'],
                    'capability' => $admin_page['capability'],
                    'menu_slug' => $admin_page['menu_slug'],
                    'callback' => $admin_page['callback']
                ]
            ];

        $this->admin_subpages = $sub_page;

        return $this;
    }

    public function addAdminMenu()
    {
        /*On récupère les infos correspondant à chaques pages représenté par des arrays dans l'array admin_subpages.
        Puis on créé une page dans le tableau de bord par array dans admin_pages */
        foreach ( $this->admin_pages as $page ) {
            add_menu_page( $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'], $page['icon_url'], $page['position'] );
        }

        /*On récupère les infos correspondant à chaques sous-pages représenté par des arrays dans l'array admin_subpages.
        Puis on créé une sous-page dans le tableau de bord par array dans admin_subpages */
        foreach ( $this->admin_subpages as $page ) {
            add_submenu_page( $page['parent_slug'], $page['page_title'], $page['menu_title'], $page['capability'], $page['menu_slug'], $page['callback'] );
        }
    }

    public function registerCustomFields()
    {
        foreach ( $this->settings as $setting ) {
        register_setting( $setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : '') );
        }

        foreach ( $this->sections as $section ) {
        add_settings_section( $section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : ''), $section["page"] );
        }

        foreach ( $this->fields as $field ) {
        add_settings_field($field["id"], $field["title"], (isset($field["callback"]) ? $field["callback"] : ''), $field['page'], $field['section'], (isset($field["args"]) ? $field["args"] : ''));
        }
    }
}