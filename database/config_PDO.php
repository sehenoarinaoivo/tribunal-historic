<?php

    try{
        $bdd = new PDO("mysql:host=localhost; dbname=tribunal","root","");
    }
    catch(exception $e){
    die("Erreur".$e->getMessage());
    }

?>