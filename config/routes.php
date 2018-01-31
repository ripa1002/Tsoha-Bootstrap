<?php

$routes->get('/', function() {
    AlueKontrolleri::index();
});

$routes->get('/aiheet', function() {
    AlueKontrolleri::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/aiheet/:id', function($id) {
    AlueKontrolleri::show($id);
});

$routes->get('/kirjaudu', function() {
  HelloWorldController::kirjaudu();
});

$routes->get('/rekisteroidy', function() {
  HelloWorldController::rekisteroidy();
});

//tämän polku tulee vielä muuttumaan
$routes->get('/muokkaa', function() {
  HelloWorldController::muokkaaviestia();
});