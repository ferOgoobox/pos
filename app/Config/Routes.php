<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Usuarios');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Usuarios::login');
$routes->post('/usuarios/valida', 'Usuarios::valida');
$routes->get('/usuarios/cambia_password', 'Usuarios::cambia_password');
$routes->post('/usuarios/actualizar_password', 'Usuarios::actualizar_password');
$routes->get('/usuarios/logout', 'Usuarios::logout');


$routes->get('/unidades', 'Unidades::index');
$routes->get('/unidades/nuevo', 'Unidades::nuevo');
$routes->post('/unidades/insertar', 'Unidades::insertar');
$routes->get('/unidades/editar/(:any)', 'Unidades::editar/$1');
$routes->get('/unidades/eliminar/(:any)', 'Unidades::eliminar/$1');
$routes->post('/unidades/actualizar', 'Unidades::actualizar');
$routes->get('/unidades/eliminados', 'Unidades::eliminados');
$routes->get('/unidades/reingresar/(:any)', 'Unidades::reingresar/$1');

$routes->get('/categorias', 'Categorias::index');
$routes->get('/categorias/nuevo', 'Categorias::nuevo');
$routes->post('/categorias/insertar', 'Categorias::insertar');
$routes->get('/categorias/editar/(:any)', 'Categorias::editar/$1');
$routes->get('/categorias/eliminar/(:any)', 'Categorias::eliminar/$1');
$routes->post('/categorias/actualizar', 'Categorias::actualizar');
$routes->get('/categorias/eliminados', 'Categorias::eliminados');
$routes->get('/categorias/reingresar/(:any)', 'Categorias::reingresar/$1');

$routes->get('/productos', 'Productos::index');
$routes->get('/productos/nuevo', 'Productos::nuevo');
$routes->post('/productos/insertar', 'Productos::insertar');
$routes->get('/productos/editar/(:any)', 'Productos::editar/$1');
$routes->get('/productos/eliminar/(:any)', 'Productos::eliminar/$1');
$routes->post('/productos/actualizar', 'Productos::actualizar');
$routes->get('/productos/eliminados', 'Productos::eliminados');
$routes->get('/productos/reingresar/(:any)', 'Productos::reingresar/$1');

$routes->get('/clientes', 'Clientes::index');
$routes->get('/clientes/nuevo', 'Clientes::nuevo');
$routes->post('/clientes/insertar', 'Clientes::insertar');
$routes->get('/clientes/editar/(:any)', 'Clientes::editar/$1');
$routes->get('/clientes/eliminar/(:any)', 'Clientes::eliminar/$1');
$routes->post('/clientes/actualizar', 'Clientes::actualizar');
$routes->get('/clientes/eliminados', 'Clientes::eliminados');
$routes->get('/clientes/reingresar/(:any)', 'Clientes::reingresar/$1');

$routes->get('/configuracion', 'Configuracion::index');
$routes->get('/configuracion/nuevo', 'Configuracion::nuevo');
$routes->post('/configuracion/insertar', 'Configuracion::insertar');
$routes->get('/configuracion/editar/(:any)', 'Configuracion::editar/$1');
$routes->get('/configuracion/eliminar/(:any)', 'Configuracion::eliminar/$1');
$routes->post('/configuracion/actualizar', 'Configuracion::actualizar');
$routes->get('/configuracion/eliminados', 'Configuracion::eliminados');
$routes->get('/configuracion/reingresar/(:any)', 'Configuracion::reingresar/$1');

$routes->get('/usuarios', 'Usuarios::index');
$routes->get('/usuarios/nuevo', 'Usuarios::nuevo');
$routes->post('/usuarios/insertar', 'Usuarios::insertar');
$routes->get('/usuarios/editar/(:any)', 'Usuarios::editar/$1');
$routes->get('/usuarios/eliminar/(:any)', 'Usuarios::eliminar/$1');
$routes->post('/usuarios/actualizar', 'Usuarios::actualizar');
$routes->get('/usuarios/eliminados', 'Usuarios::eliminados');
$routes->get('/usuarios/reingresar/(:any)', 'Usuarios::reingresar/$1');

$routes->get('/cajas', 'Cajas::index');
$routes->get('/cajas/nuevo', 'Cajas::nuevo');
$routes->post('/cajas/insertar', 'Cajas::insertar');
$routes->get('/cajas/editar/(:any)', 'Cajas::editar/$1');
$routes->get('/cajas/eliminar/(:any)', 'Cajas::eliminar/$1');
$routes->post('/cajas/actualizar', 'Cajas::actualizar');
$routes->get('/cajas/eliminados', 'Cajas::eliminados');
$routes->get('/cajas/reingresar/(:any)', 'Cajas::reingresar/$1');

$routes->get('/roles', 'Roles::index');
$routes->get('/roles/nuevo', 'Roles::nuevo');
$routes->post('/roles/insertar', 'Roles::insertar');
$routes->get('/roles/editar/(:any)', 'Roles::editar/$1');
$routes->get('/roles/eliminar/(:any)', 'Roles::eliminar/$1');
$routes->post('/roles/actualizar', 'Roles::actualizar');
$routes->get('/roles/eliminados', 'Roles::eliminados');
$routes->get('/roles/reingresar/(:any)', 'Roles::reingresar/$1');

$routes->get('/compras', 'Compras::index');
$routes->get('/compras/nuevo', 'Compras::nuevo');
$routes->post('/compras/insertar', 'Compras::insertar');
$routes->get('/compras/editar/(:any)', 'Compras::editar/$1');
$routes->get('/compras/eliminar/(:any)', 'Compras::eliminar/$1');
$routes->post('/compras/actualizar', 'Compras::actualizar');
$routes->get('/compras/eliminados', 'Compras::eliminados');
$routes->get('/compras/reingresar/(:any)', 'Compras::reingresar/$1');





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
