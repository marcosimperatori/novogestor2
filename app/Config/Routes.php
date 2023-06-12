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
$routes->setDefaultController('Home');
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
$routes->get('/', 'Home::index');

$routes->get('usuarios', 'Usuarios::index');
$routes->get('usuarios/recuperausuarios', 'Usuarios::recuperaUsuarios');
$routes->get('usuarios/editar/(:num)', 'Usuarios::editar/$1');
$routes->get('usuarios/imagem/(:any)', 'Usuarios::imagem/$1');
$routes->get('usuarios/criar', 'Usuarios::criar');
$routes->post('usuarios/cadastrar', 'Usuarios::cadastrar');
$routes->post('usuarios/atualizar', 'Usuarios::atualizar');
$routes->post('usuarios/excluir', 'Usuarios::excluir');

$routes->get('pessoal', 'DepPessoal::index');
$routes->get('pessoal/tarefas', 'DepPessoal::tarefas');

$routes->get('fiscal', 'DepFiscal::index');

$routes->get('contabil', 'DepContabil::index');

$routes->get('administracao', 'Administracao::index');


$routes->get('administracao/clientes', 'Clientes::index');
$routes->get('clientes/recuperaclientes', 'Clientes::recuperaClientes');
$routes->get('administracao/clientes/criar', 'Clientes::criar');
$routes->get('administracao/clientes/editar/(:num)', 'Clientes::editar/$1');
$routes->post('administracao/clientes/cadastrar', 'Clientes::cadastrar');
$routes->post('administracao/clientes/atualizar', 'Clientes::atualizar');

$routes->get('administracao/config-responsavel', 'ConfigClientes::index');
$routes->get('administracao/empresasdousuario', 'ConfigClientes::listaEmpresasUsuarioById');
$routes->get('administracao/empresasresumousuario', 'ConfigClientes::empresasSemResponsavel');
$routes->get('administracao/divisaoempresas', 'ConfigClientes::empresasSemResponsavel');
$routes->get('administracao/empresasoutroresponsavel', 'ConfigClientes::empresasOutroResponsavel');
$routes->get('administracao/empresasresponsavel', 'ConfigClientes::empresasResponsavel');

$routes->get('resumocertificados', 'Administracao::graficoResumoCertificadoDigital');
$routes->get('resumotiposclientes', 'Administracao::graficoResumoTipoCliente');

$routes->post('responsavel/excluir', 'ConfigClientes::excluir');
$routes->post('responsavel/vincular', 'ConfigClientes::vincularCliente');

$routes->get('administracao/itemcontrole', 'ItemControle::index');
$routes->get('administracao/itemcontrole/criar', 'ItemControle::criar');
$routes->get('administracao/itemcontrole/editar/(:num)', 'ItemControle::editar/$1');

$routes->get('administracao/controlecliente', 'ControleEmpresa::index');

//rotas ajax
$routes->get('administracao/itens', 'ItemControle::recuperaItensControle');
$routes->post('itens/cadastrar', 'ItemControle::cadastrar');
$routes->post('itens/atualizar', 'ItemControle::atualizar');

$routes->get('clientes/consulta', 'ControleEmpresa::listarClientes');
$routes->get('itens/consulta', 'ControleEmpresa::listarItens');
$routes->get('itens/controlecliente', 'ControleEmpresa::listarItensControlados');
$routes->post('clientes/itens/cadastrar', 'ControleEmpresa::cadastrar');
$routes->post('clientes/item/excluir', 'ControleEmpresa::excluir');
/*
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
