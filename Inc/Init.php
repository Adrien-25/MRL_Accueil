<?php
/**
 * @package MRLAccueil
 */

namespace Inc;

final class Init
{
    /**
     * Store all the classes inside an array
     * @return array Full list of classes
     */

    public static function get_services()
    {
        return [
            
            Pages\Dashboard::class,
            Base\Enqueue::class,
            Base\SettingsLink::class,
            Base\SliderController::class,
            Base\VideoYoutubeController::class,
            Base\ParticipeEcouteController::class,
            Base\TetaisLaController::class,
            Base\DonsController::class,
            Base\SeptemTrionisController::class,
            Base\DernierPodcastController::class,
            Base\CAAController::class,
            Base\AuditeursController::class,
            Base\MaurcieBougeotteController::class,
            Base\IllustrationController::class,
            Base\BoutiqueController::class
        ];
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if it exists
     * @return
     */

    public static function register_services()
    {
        foreach ( self::get_services() as $class) {
            $service = self::instantiate( $class );
            if ( method_exists( $service, 'register' ) ) {
                $service->register();
            }
        }
    }

    /**
     * Initialise the classe
     * @param class $class  class from the services array
     * @return class instance new instance of the class
     */


    private static function instantiate( $class )
    {
        return new $class;
    }
}

