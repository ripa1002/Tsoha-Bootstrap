<?php

$routes->get('/', function() {
    HelloWorldController::etusivu();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/aihe1', function() {
    HelloWorldController::ketjut();
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