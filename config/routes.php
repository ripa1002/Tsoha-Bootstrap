<?php

$routes->get('/', function() {
    AlueKontrolleri::index();
});

$routes->get('/aiheet', function() {
    AlueKontrolleri::index();
});

$routes->get('/login', function() {
    // Kirjautumislomakkeen esittäminen
    Kayttajakontrolleri::login();
});
$routes->post('/login', function() {
    // Kirjautumisen käsittely
    Kayttajakontrolleri::handle_login();
});

$routes->post('/aiheet/:id', function($id) {
    AlueKontrolleri::varastoi($id);
});

$routes->get('/aiheet/:id/uusi', function($id) {
    AlueKontrolleri::luo($id);
});

$routes->get('/aiheet/:id', function($id) {
    AlueKontrolleri::naytaKetjutAlueittain($id);
});

$routes->post('/aiheet/ketju/:id', function($id) {
    AlueKontrolleri::varastoiViesti($id);
});

$routes->get('/aiheet/ketju/:id/uusi', function($id) {
    AlueKontrolleri::luoViesti($id);
});

$routes->get('/aiheet/ketju/:ketju_id', function($ketju_id) {
    AlueKontrolleri::naytaKetjunSisalto($ketju_id);
});

$routes->get('/rekisteroidy', function() {
    HelloWorldController::rekisteroidy();
});

$routes->post('/aiheet/:ketju_id/muokkaa', function($ketju_id) {
    AlueKontrolleri::update($ketju_id);
});

$routes->get('/aiheet/:ketju_id/muokkaa', function($ketju_id) {
    AlueKontrolleri::edit($ketju_id);
});

$routes->post('/aiheet/:id/destroy', function($id) {
    AlueKontrolleri::destroy($id);
});

/*
$routes->get('/hiekkalaatikko', function() {
    AlueKontrolleri::sandbox();
});
$routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
});
*/
