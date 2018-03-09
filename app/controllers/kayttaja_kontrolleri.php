<?php

class Kayttajakontrolleri extends BaseController {

    public static function login() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function logout() {
        $_SESSION['kayttaja'] = null;
        Redirect::to('/', array('message' => 'kirjauduit ulos!'));
    }

    public static function register() {
        View::make('suunnitelmat/rekisteroidy.html');
    }

    public static function create_user() {
        $params = $_POST;

        $attributes = array(
            'name' => $params['name'],
            'password' => $params['password']
        );
        if ($params['password'] != $params['password_confirm']) {
            View::make('suunnitelmat/rekisteroidy.html', array('message' => 'Salasanan pitää täsmätä vahvistuksen kanssa!'));
        } else {
        $kayttaja = new Kayttaja($attributes);
        //$errors = $kayttaja->errors();
        //if (count($errors) == 0) {
        $kayttaja->save();
        Redirect::to('/', array('message' => 'Uusi käyttäjä luotu onnistuneesti! Voit nyt kirjautua sisään antamillasi tiedoilla.'));
        /* } else {
          View::make('suunnitelmat/rekisteroidy.html', array('errors' => $errors, 'attributes' => $attributes));
          } */
        }
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
