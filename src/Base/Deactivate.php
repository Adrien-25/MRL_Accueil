<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

class Deactivate
{
    public static function deactivate(){
        flush_rewrite_rules();
    }
}
