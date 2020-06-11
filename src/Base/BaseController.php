<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

class BaseController
{

    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public $managers_admin = array();

    public function __construct(){
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 2 ) );
        $this->plugin_url = plugin_dir_url( dirname( __FILE__, 2 ) );
        $this->plugin = plugin_basename( realpath(__DIR__ . '/../..') );// link settings marche pas la con de ses mort

        $this->managers_admin = [
            'slider_accueil' => 'Slider',
            'video_youtube_accueil' => 'Vidéo Youtube',
            'participe_ecoute_accueil' => 'Participe / Écoute',
            'tetais_la_accueil' => 'T\'étais Là',
            'bravo_dons_accueil' => 'Bravo Pour Vos Dons',
            'septem_trionis_accueil' => 'Septem Trionis',
            'dernier_podcast_accueil' => 'Le Dernier Podcast',
            'caa_accueil' => 'CAA',
            'auditeurs_acceuil' => 'Les Auditeurs',
            'maurice_bougeotte_accueil' => 'Maurice A La Bougeotte',
            'illustration_accueil' => 'Illustrations',
            'boutique_accueil' => 'La Boutique'
        ];
    }

    public function activated(  string $key )
    {
        $option = get_option('mrl_plugin');
        return isset($option[$key]) ? $option[$key] : false;

    }

}
;