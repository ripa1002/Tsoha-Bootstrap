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
    
    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->name) < 4) {
            $errors[] = 'Nimen pituuden tulee olla vähintään neljä merkkiä!';
        }
        return $errors;
    }
    
    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $kysely = DB::connection()->prepare('INSERT INTO Kayttaja (name, password) VALUES (:name, :password) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $kysely->execute(array('name' => $this->name, 'password' => $this->password));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $rivi = $kysely->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $rivi['id'];
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

