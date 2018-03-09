<?php

class Ketju extends BaseModel {

    public $id, $alue_id, $kayttaja_id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }

    public static function kaikki() {
        $kysely = DB::connection()->prepare('SELECT * FROM Ketju');
        $kysely->execute();

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
        $kysely = DB::connection()->prepare('SELECT * FROM Ketju WHERE alue_id = :alue_id');
        $kysely->execute(array('alue_id' => $alue_id));

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
        $kysely = DB::connection()->prepare('INSERT INTO Ketju (alue_id, kayttaja_id, name) VALUES (:alue_id, :kayttaja, :name) RETURNING id');
        $kysely->execute(array('name' => $this->name, 'kayttaja' => BaseController::get_user_logged_in()->id ,'alue_id' => $this->alue_id));
        $rivi = $kysely->fetch();
        $this->id = $rivi['id'];
    }

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
        $kysely = DB::connection()->prepare('UPDATE Ketju SET name = :name WHERE id = :id');
        $kysely->execute(array('id' => $this->id, 'name' => $this->name));

    }
    
    public function destroy() {
        $kysely = DB::connection()->prepare('DELETE FROM Ketju WHERE id=:id');
        $kysely->execute(array('id' => $this->id));
    }
    
}


