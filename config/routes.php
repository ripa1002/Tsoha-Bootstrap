<?php

$routes->get('/', function() {
    AlueKontrolleri::index();
});

$routes->get('/aiheet', function() {
    AlueKontrolleri::index();
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

$routes->get('/kirjaudu', function() {
    HelloWorldController::kirjaudu();
});

$routes->get('/rekisteroidy', function() {
    HelloWorldController::rekisteroidy();
});

$routes->get('aiheet/:id/muokkaa', function($id) {
    AlueKontrolleri::edit($id);
});

$routes->post('/aiheet/:id/edit', function($id){
    AlueKontrolleri::update($id);
});

$routes->post('/aiheet/:id/destroy', function($id){
  AlueKontrolleri::destroy($id);
});

/*
$routes->get('/hiekkalaatikko', function() {
    AlueKontrolleri::sandbox();
});
*/
