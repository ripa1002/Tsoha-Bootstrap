<?php

class AlueKontrolleri extends BaseController {

    public static function index() {
        $alueet = Alue::kaikki();
        View::make('alue/etusivu.html', array('alueet' => $alueet));
    }

    public static function ketjuja() {
        $ketjut = Ketju::kaikki();
        View::make('ketju/ketjut.html', array('ketjut' => $ketjut));
    }
    
    public static function luo() {
        View::make('ketju/uusiketju.html');
    }

    public static function varastoi() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Game-luokan olion käyttäjän syöttämillä arvoilla
        $ketju = new Ketju(array(
            'name' => $params['name']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $ketju->save();
        
        // Ohjataan käyttäjä lisäyksen jälkeen pelin esittelysivulle
        Redirect::to('/hiekkalaatikko');
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

