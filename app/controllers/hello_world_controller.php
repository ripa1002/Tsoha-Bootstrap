<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        //View::make('helloworld.html');
        $testi = new Ketju(array('name' => '', 'kayttaja_id' => 10, 'alue_id' => 10));
        $errors = $testi->errors();
        Kint::dump($errors);
        /*
        $eka = Alue::etsi(1);
        $alueet = Alue::kaikki();
        Kint::dump($eka);
        Kint::dump($alueet);
         */
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function ketjut() {
        View::make('suunnitelmat/ketjut.html');
    }

    public static function kirjaudu() {
        View::make('suunnitelmat/kirjaudu.html');
    }
    
    public static function rekisteroidy() {
        View::make('suunnitelmat/rekisteroidy.html');
    }
    
    public static function muokkaaviestia() {
        View::make('suunnitelmat/muokkaaviestia.html');
    }

}
