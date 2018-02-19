<?php

class Kayttajakontrolleri extends BaseController {

    public static function login() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'kirjauduit ulos!'));
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['name'], $params['password']);

        if (!$kayttaja) {
            View::make('suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->name . '!'));
        }
    }

}
