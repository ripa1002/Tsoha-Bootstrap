<?php

class Viesti extends BaseModel {
    
    public $id, $ketju_id, $kayttaja_id, $sisalto, $aika;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_name');
    }
    
    public static function etsi($id) {
        $kysely = DB::connection()->prepare('SELECT * FROM Viesti WHERE id = :id LIMIT 1');
        $kysely->execute(array('id' => $id));
        $rivi = $kysely->fetch();

        if ($rivi) {
            $viesti = new Viesti(array(
                'id' => $rivi['id'],
                'ketju_id' => $rivi['ketju_id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'sisalto' => $rivi['sisalto'],
                'aika' => $rivi['aika']
            ));
            return $viesti;
        }
        return null;
    }
    
    public static function etsiKetjuittain($ketju_id) {
        $kysely = DB::connection()->prepare('SELECT * FROM Viesti WHERE ketju_id = :ketju_id');
        $kysely->execute(array('ketju_id' => $ketju_id));
        
        $rivit = $kysely->fetchAll();
        $viestit = array();

        foreach ($rivit as $rivi) {
            $viestit[] = new Viesti(array(
                'id' => $rivi['id'],
                'ketju_id' => $rivi['ketju_id'],
                'kayttaja_id' => $rivi['kayttaja_id'],
                'sisalto' => $rivi['sisalto'],
                'aika' => $rivi['aika']
            ));
        }
        return $viestit;
    }
    
    public function save() {
        $kysely = DB::connection()->prepare('INSERT INTO Viesti (ketju_id, kayttaja_id, sisalto, aika) VALUES (:ketju_id, :kayttaja, :sisalto, :aika) RETURNING id');
        $kysely->execute(array('sisalto' => $this->sisalto, 'kayttaja' => BaseController::get_user_logged_in()->id ,'ketju_id' => $this->ketju_id, 'aika' => $this->aika));
        $rivi = $kysely->fetch();
        $this->id = $rivi['id'];
    }
    
    public function update() {
        $kysely = DB::connection()->prepare('UPDATE Viesti SET sisalto = :sisalto WHERE id = :id');
        $kysely->execute(array('id' => $this->id, 'sisalto' => $this->sisalto));
    }
    
    public function validate_name() {
        $errors = array();
        if ($this->sisalto == '' || $this->sisalto == null) {
            $errors[] = 'Viesti ei saa olla tyhjä!';
        }
        return $errors;
    }
    
    public function destroyOne() {
        $kysely = DB::connection()->prepare('DELETE FROM Viesti WHERE id=:id');
        $kysely->execute(array('id' => $this->id));
    }
    
    public function destroy() {
        $kysely = DB::connection()->prepare('DELETE FROM Viesti WHERE ketju_id=:ketju_id');
        $kysely->execute(array('ketju_id' => $this->ketju_id));
    }
}