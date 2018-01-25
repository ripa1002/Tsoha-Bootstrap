<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        //View::make('home.html');
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        View::make('helloworld.html');
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
