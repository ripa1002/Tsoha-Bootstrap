<?php

$routes->get('/', function() {
    AlueKontrolleri::index();
});

$routes->get('/aiheet', function() {
    AlueKontrolleri::index();
});

$routes->get('/login', function() {
    Kayttajakontrolleri::login();
});

$routes->post('/login', function() {
    Kayttajakontrolleri::handle_login();
});

$routes->post('/logout', function() {
    Kayttajakontrolleri::logout();
});

$routes->post('/aiheet/:id', function($id) {
    KetjuKontrolleri::varastoi($id);
});

$routes->get('/aiheet/:id/uusi', function($id) {
    KetjuKontrolleri::luo($id);
});

$routes->get('/aiheet/:id', function($id) {
    KetjuKontrolleri::naytaKetjutAlueittain($id);
});

$routes->post('/aiheet/ketju/:id', function($id) {
    ViestiKontrolleri::varastoiViesti($id);
});

$routes->get('/aiheet/ketju/:id/uusi', function($id) {
    ViestiKontrolleri::luoViesti($id);
});

$routes->get('/aiheet/ketju/:ketju_id', function($ketju_id) {
    KetjuKontrolleri::naytaKetjunSisalto($ketju_id);
});

$routes->get('/register', function() {
    Kayttajakontrolleri::register();
});

$routes->post('/register', function() {
    Kayttajakontrolleri::create_user();
});

$routes->post('/aiheet/:ketju_id/muokkaa', function($ketju_id) {
    KetjuKontrolleri::update($ketju_id);
});

$routes->get('/aiheet/:ketju_id/muokkaa', function($ketju_id) {
    KetjuKontrolleri::edit($ketju_id);
});

$routes->post('/aiheet/ketju/:ketju_id/muokkaa', function($ketju_id) {
    ViestiKontrolleri::updateViesti($ketju_id);
});

$routes->get('/aiheet/ketju/:ketju_id/muokkaa', function($ketju_id) {
    ViestiKontrolleri::editViesti($ketju_id);
});

$routes->post('/aiheet/ketju/:viestiId/destroy', function($viestiId) {
    ViestiKontrolleri::destroyViesti($viestiId);
});
$routes->post('/aiheet/:id/destroy', function($id) {
    KetjuKontrolleri::destroy($id);
});

