<?php

class AlueKontrolleri extends BaseController {

    public static function index() {
        $alueet = Alue::kaikki();
        View::make('alue/etusivu.html', array('alueet' => $alueet));
    }

    public static function kaikkiKetjut() {
        $ketjut = Ketju::kaikki();
        View::make('ketju/ketjut.html', array('ketjut' => $ketjut));
    }

    public static function luo($id) {
        $alue = Alue::etsi($id);
        View::make('ketju/uusiketju.html', array('oikee' => $alue->id));
    }

    public static function varastoi($id) {
        $alue = Alue::etsi($id);
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
            'name' => $params['name'],
            'alue_id' => $id
        );
        $ketju = new Ketju($attributes);
        $errors = $ketju->errors();
        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan

        if (count($errors) == 0) {
            $ketju->save();
            // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
            Redirect::to('/aiheet/' . $ketju->alue_id, array('message' => 'Ketju lisätty!'));
        } else {
            View::make('ketju/uusiketju.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $alue->id));
        }
    }

    public static function naytaKetjutAlueittain($id) {
        $ketjut = Ketju::etsiAlueittain($id);
        $alue = Alue::etsi($id);
        View::make('ketju/ketjut.html', array('ketjut' => $ketjut, 'oikee' => $alue->id));
    }

    public static function edit($id) {
        $ketju = Ketju::etsi($id);
        View::make('suunnitelmat/muokkaaviestia.html', array('attributes' => $ketju));
    }

    // Pelin muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;

        $attributes = array(
            'id' => $id,
            'name' => $params['name'],
            'alue_id' => $params['alue_id']
        );

        // Alustetaan Game-olio käyttäjän syöttämillä tiedoilla
        $ketju = new Game($attributes);
        $errors = $ketju->errors();

        if (count($errors) > 0) {
            View::make('suunnitelmat/muokkaaviestia.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            // Kutsutaan alustetun olion update-metodia, joka päivittää pelin tiedot tietokannassa
            $ketju->update();

            Redirect::to('/aiheet/' . $ketju->alue_id, array('message' => 'Ketjua on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        
        $ketju = new Ketju(array('id' => $id));
        $luku = Ketju::etsi($id);
        $ketju->destroy();

        Redirect::to('/aiheet/' . $luku->alue_id, array('message' => 'Ketju on poistettu onnistuneesti!'));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

