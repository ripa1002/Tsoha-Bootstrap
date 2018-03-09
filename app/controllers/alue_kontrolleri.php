<?php

class AlueKontrolleri extends BaseController {

    public static function index() {
        $alueet = Alue::kaikki();
        View::make('alue/etusivu.html', array('alueet' => $alueet));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

