<?php

class Kayttajakontrolleri extends BaseController {

    public static function login() {
        View::make('kayttaja/kirjaudu.html');
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'kirjauduit ulos!'));
    }

    public static function register() {
        View::make('kayttaja/rekisteroidy.html');
    }

    public static function create_user() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'password' => $params['password']
        );
        if ($params['password'] != $params['password_confirm']) {
            View::make('kayttaja/rekisteroidy.html', array('message' => 'Salasanan pitää täsmätä vahvistuksen kanssa!'));
        } else if (strlen($params['password']) < 4) {
            View::make('kayttaja/rekisteroidy.html', array('message' => 'Salasanan pitää olla vähintään 4 merkkiä pitkä!'));
        } else {
        $kayttaja = new Kayttaja($attributes);

        $kayttaja->save();
        Redirect::to('/', array('message' => 'Uusi käyttäjä luotu onnistuneesti! Voit nyt kirjautua sisään antamillasi tiedoilla.'));     
        }
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['name'], $params['password']);

        if (!$kayttaja) {
            View::make('kayttaja/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $kayttaja->name . '!'));
        }
    }

}
