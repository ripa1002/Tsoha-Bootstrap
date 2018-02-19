<?php

class Kayttaja extends BaseModel {

    public $id, $name, $password, $admin;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function authenticate($name, $password) {
        $kysely = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE name = :name AND password = :password LIMIT 1');
        $kysely->execute(array('name' => $name, 'password' => $password));
        $rivi = $kysely->fetch();
        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'name' => $rivi['name'],
                'password' => $rivi['password']
            ));
            return $kayttaja;
        } else {
            return null;
        }
    }
    
    public static function etsi($id) {
        $kysely = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $kysely->execute(array('id' => $id));
        $rivi = $kysely->fetch();

        if ($rivi) {
            $kayttaja = new Kayttaja(array(
                'id' => $rivi['id'],
                'name' => $rivi['name'],
                'password' => $rivi['password']
            ));
            return $kayttaja;
        }
        return null;
    }
    
    public static function kaikki() {
        $kysely = DB::connection()->prepare('SELECT * FROM Kayttaja');
        $kysely->execute();
        $rivit = $kysely->fetchAll();
        $kayttajat = array();
        
        foreach ($rivit as $rivi) {
            $kayttajat[] = new Kayttaja(array(
                'id' => $rivi['id'],
                'name' => $rivi['name'],
                'password' => $rivi['password']
            ));
        }
        return $kayttajat;
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

