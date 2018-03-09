<?php

class ViestiKontrolleri extends BaseController {
    
    public static function luoViesti($id) {
        $ketju = Ketju::etsi($id);
        View::make('viesti/uusiviesti.html', array('oikee' => $ketju->id));
    }
    
    public static function varastoiViesti($id) {
        $params = $_POST;

        $attributes = array(
            'ketju_id' => $id,
            'kayttaja_id' => BaseController::get_user_logged_in()->id,
            'sisalto' => $params['sisalto'], 
            'aika' => date(DATE_RSS)
        );
        $viesti = new Viesti($attributes);
        $errors = $viesti->errors();
        
        if (count($errors) > 0) {
            View::make('viesti/uusiviesti.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $id));
        } else {
            $viesti->save();
            Redirect::to('/aiheet/ketju/' . $id);
        }
    }
    
    public static function destroyViesti($viestiId) {
        $oikee = Viesti::etsi($viestiId);
        $viesti = new Viesti(array('id' => $viestiId));
        $viesti->destroyOne();
        Redirect::to('/aiheet/ketju/' . $oikee->ketju_id, array('message' => 'Viesti on poistettu onnistuneesti!'));
    }
    
    public static function editViesti($id) {
        $viesti = Viesti::etsi($id);
        View::make('viesti/muokkaaviestia.html', array('attributes' => $viesti, 'oikee' => $viesti->id));
    }
    
    public static function updateViesti($viesti_id) {
        $params = $_POST;
        $oikee = Viesti::etsi($viesti_id);
        $attributes = array(
            'id' => $viesti_id,
            'sisalto' => $params['sisalto'],
            'aika' => date(DATE_RSS)
        );

        $viesti = new Viesti($attributes);
        $errors = $viesti->errors();

        if (count($errors) > 0) {
            View::make('viesti/muokkaaviestia.html', array('errors' => $errors, 'attributes' => $attributes, 'oikee' => $viesti->id));
        } else {
            $viesti->update();
            Redirect::to('/aiheet/ketju/' . $oikee->ketju_id, array('message' => 'Viestiä on muokattu onnistuneesti!'));
        }
    }
}
