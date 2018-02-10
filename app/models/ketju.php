<?php

class Ketju extends BaseModel {

    public $id, $alue_id, $kayttaja_id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
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
    
    public static function etsiAlueittain($alue_id) {
        // Alustetaan kysely tietokantayhteydellämme
        $kysely = DB::connection()->prepare('SELECT * FROM Ketju WHERE alue_id = :alue_id');
        // Suoritetaan kysely
        $kysely->execute(array('alue_id' => $alue_id));
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

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $kysely = DB::connection()->prepare('INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (:alue_id, 2, :name) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $kysely->execute(array('name' => $this->name, 'alue_id' => $this->alue_id));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $rivi = $kysely->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $rivi['id'];
    }

    // Huomaathan, että validate_name funktio EI ole staattinen!
    public function validate_name() {
        $errors = array();
        if ($this->name == '' || $this->name == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->name) < 2) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kaksi merkkiä!';
        }
        return $errors;
    }
    
    public function update() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $kysely = DB::connection()->prepare('UPDATE Ketju SET name = :name WHERE id = :id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $kysely->execute(array('id' => $this->id, 'name' => $this->name));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        /*
        $rivi = $kysely->fetch();
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        $this->id = $rivi['id'];*/
    }
    
    public function destroy() {
        $kysely = DB::connection()->prepare('DELETE FROM Ketju WHERE id=:id');
        $kysely->execute(array('id' => $this->id));
    }
    
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

