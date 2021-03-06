<?php

class KetjuKontrolleri extends BaseController {
    
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
                'kayttaja_id' => BaseController::get_user_logged_in()->id,
                'sisalto' => $params['sisalto'], 'aika' => date(DATE_RSS));

            $viesti = new Viesti($viestinAttributes);
            $viesti->save();
            Redirect::to('/aiheet/' . $ketju->alue_id, array('message' => 'Ketju lisätty!'));
        } else {
            View::make('ketju/uusiketju.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $alue->id));
        }
    }
    
    public static function naytaKetjutAlueittain($id) {
        $ketjut = Ketju::etsiAlueittain($id);
        $alue = Alue::etsi($id);
        $kayttajat = Kayttaja::kaikki();
        View::make('ketju/ketjut.html', array('ketjut' => $ketjut, 'oikee' => $alue->id, 'alueenNimi' => $alue->name, 'kayttajat' => $kayttajat));
    }

    public static function naytaKetjunSisalto($ketju_id) {
        $ketju = Ketju::etsi($ketju_id);
        $viestit = Viesti::etsiKetjuittain($ketju_id);
        $kayttajat = Kayttaja::kaikki();
        View::make('ketju/sisalto.html', array('ketju' => $ketju, 'viestit' => $viestit, 'oikee' => $ketju->id, 'kayttajat' => $kayttajat));
    }

    public static function edit($id) {
        $ketju = Ketju::etsi($id);
        View::make('ketju/muokkaaketjua.html', array('attributes' => $ketju, 'oikee' => $ketju->id));
    }

    public static function update($ketju_id) {
        $params = $_POST;
        $oikee = Ketju::etsi($ketju_id);
        $attributes = array(
            'id' => $ketju_id,
            'name' => $params['name']
        );

        $ketju = new Ketju($attributes);
        $errors = $ketju->errors();

        if (count($errors) > 0) {
            View::make('ketju/muokkaaketjua.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $ketju->id));
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
