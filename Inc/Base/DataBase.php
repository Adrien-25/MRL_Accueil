<?php
/**
 * @package MRLAccueil
 */

namespace Inc\Base;

Use PDO;

class DataBase
{  
    
    public static function dbConnect(){ 
        try
        {
                $db = new PDO('mysql:host=localhost;dbname=wordpress4', 'root', 'toto', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]);
                return $db;
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());
        }
    }

    public static function dons_query(){
        $db = self::dbConnect();
        $req = $db-> query('SELECT nom, ville FROM auditeurs_membres ORDER BY RAND() LIMIT 3') ;
        return $req;
    }

    public static function auditeurs_query(){
        $db = self::dbConnect();
        $req = $db-> query('SELECT nom, ville, img FROM auditeurs_membres ORDER BY RAND() LIMIT 4') ;
        return $req;
    }

}