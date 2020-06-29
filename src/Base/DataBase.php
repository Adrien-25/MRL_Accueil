<?php
/**
 * @package MRLAccueil
 */

namespace Accueil\Base;

Use PDO;

class DataBase
{  
    
    public static function dbConnect(){ 
        $credentials = (include('dbcredentials.php'));
        try
        {
                $db = new PDO($credentials['dsn'], $credentials['user'], $credentials['password'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_ERRMODE => PDO::FETCH_ASSOC
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
        $req = $db-> query('SELECT nom, ville, image FROM auditeurs_membres ORDER BY RAND() LIMIT 4') ;
        return $req;
    }

}