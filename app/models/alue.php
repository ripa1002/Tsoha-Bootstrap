<?php

class Alue extends BaseModel {

    public $id, $name;

    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function kaikki() {
        $kysely = DB::connection()->prepare('SELECT * FROM Alue');
        $kysely->execute();

        $rivit = $kysely->fetchAll();
        $alueet = array();

        foreach ($rivit as $rivi) {
            $alueet[] = new Alue(array(
                'id' => $rivi['id'],
                'name' => $rivi['name']
            ));
        }
        return $alueet;
    }

    public static function etsi($id) {
        $kysely = DB::connection()->prepare('SELECT * FROM Alue WHERE id = :id LIMIT 1');
        $kysely->execute(array('id' => $id));
        $rivi = $kysely->fetch();

        if ($rivi) {
            $alue = new Alue(array(
                'id' => $rivi['id'],
                'name' => $rivi['name']
            ));
            return $alue;
        }
        return null;
    }
}
