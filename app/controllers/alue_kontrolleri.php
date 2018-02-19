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

    public static function luoViesti($id) {
        $ketju = Ketju::etsi($id);
        View::make('ketju/uusiviesti.html', array('oikee' => $ketju->id));
    }

    public static function varastoi($id) {
        $alue = Alue::etsi($id);
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'alue_id' => $id,
            'kayttaja_id' => BaseController::get_user_logged_in()->id
        );
        $ketju = new Ketju($attributes);
        $errors = $ketju->errors();

        if (count($errors) == 0) {
            $ketju->save();
            $viestinAttributes = array(
                'ketju_id' => $ketju->id,
                'kayttaja_id' => '2',
                'sisalto' => $params['sisalto'], 'aika' => date_default_timezone_get());

            $viesti = new Viesti($viestinAttributes);
            $viesti->save();
            Redirect::to('/aiheet/' . $ketju->alue_id, array('message' => 'Ketju lisätty!'));
        } else {
            View::make('ketju/uusiketju.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $alue->id));
        }
    }

    public static function varastoiViesti($id) {
        $params = $_POST;

        $attributes = array(
            'ketju_id' => $id,
            'kayttaja_id' => '2',
            'sisalto' => $params['sisalto'], 'aika' => date_default_timezone_get()
        );
        $viesti = new Viesti($attributes);
        $viesti->save();
        Redirect::to('/aiheet/ketju/' . $id);
    }

    public static function naytaKetjutAlueittain($id) {
        $ketjut = Ketju::etsiAlueittain($id);
        $alue = Alue::etsi($id);
        View::make('ketju/ketjut.html', array('ketjut' => $ketjut, 'oikee' => $alue->id));
    }

    public static function naytaKetjunSisalto($ketju_id) {
        $ketju = Ketju::etsi($ketju_id);
        $viestit = Viesti::etsiKetjuittain($ketju_id);
        View::make('ketju/sisalto.html', array('ketju' => $ketju, 'viestit' => $viestit, 'oikee' => $ketju->id));
    }

    public static function edit($id) {
        $ketju = Ketju::etsi($id);
        View::make('suunnitelmat/muokkaaviestia.html', array('attributes' => $ketju, 'oikee' => $ketju->id));
    }

    public static function update($ketju_id) {
        $params = $_POST;
        $oikee = Ketju::etsi($ketju_id);
        $attributes = array(
            'id' => $ketju_id,
            'name' => $params['name']
                //'alue_id' => $alue_id
        );

        $ketju = new Ketju($attributes);
        $errors = $ketju->errors();

        if (count($errors) > 0) {
            View::make('suunnitelmat/muokkaaviestia.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $ketju->id));
        } else {
            $ketju->update();
            Redirect::to('/aiheet/' . $oikee->alue_id, array('message' => 'Ketjua on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {

        $ketju = new Ketju(array('id' => $id));
        $viesti = new Viesti(array('ketju_id' => $id));
        $alue = Ketju::etsi($id);
        $viesti->destroy();
        $ketju->destroy();

        Redirect::to('/aiheet/' . $alue->alue_id, array('message' => 'Ketju on poistettu onnistuneesti!'));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

