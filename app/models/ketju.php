<?php

class Ketju extends BaseModel {

    public $id, $alue_id, $kayttaja_id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function kaikki() {
        // Alustetaan kysely tietokantayhteydellämme
        $kysely = DB::connection()->prepare('SELECT * FROM Ketju');
        // Suoritetaan kysely
        $kysely->execute();
        // Haetaan kyselyn tuottamat rivit
        $rivit = $kysely->fetchAll();
        $ketjut = array();

        foreach ($rivit as $rivi) {
            $ketjut[] = new Ketju(array(
                'id' => $rivi['id'],
                'alue_id' => $rivi['alue_id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'name' => $rivi['name']
            ));
        }
        return $ketjut;
    }

    public static function etsi($id) {
        $kysely = DB::connection()->prepare('SELECT * FROM Ketju WHERE id = :id LIMIT 1');
        $kysely->execute(array('id' => $id));
        $rivi = $kysely->fetch();

        if ($rivi) {
            $ketju = new Ketju(array(
                'id' => $rivi['id'],
                'alue_id' => $rivi['alue_id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'name' => $rivi['name']
            ));
            return $ketju;
        }
        return null;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $kysely = DB::connection()->prepare('INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (2, 2, :name) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $kysely->execute(array('name' => $this->name));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $rivi = $kysely->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $rivi['id'];
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

