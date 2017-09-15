<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'welcome';

// LR->controlador principal, por default
$route['default_controller'] = 'menu';

/* otros parametros que trae el framework */
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// LR->controladores de la aplicación
$route['login'] = 'general/login'; //aqui es el controlador y el metodo
$route['entrar'] = 'general/entrar'; //aqui es el controlador y el metodo
$route['cambio'] = 'general/cambio'; //aqui es el controlador y el metodo
$route['passchange'] = 'general/passchange'; //aqui es el controlador y el metodo
$route['recuperar'] = 'general/recuperar'; //aqui es el controlador y el metodo
$route['pregunta'] = 'general/pregunta'; //aqui es el controlador y el metodo
$route['respuesta'] = 'general/respuesta'; //aqui es el controlador y el metodo
$route['passretrieve'] = 'general/passretrieve'; //aqui es el controlador y el metodo
$route['hint'] = 'general/hint'; //aqui es el controlador y el metodo
$route['reset'] = 'general/reset'; //aqui es el controlador y el metodo
$route['reinicio'] = 'general/reinicio'; //aqui es el controlador y el metodo
$route['logout'] = 'general/logout'; //aqui es el controlador y el metodo

$route['contacto'] = 'cont/contacto'; //aqui es el controlador y el metodo
$route['email_contacto'] = 'cont/email_contacto'; //aqui es el controlador y el metodo

$route['opcion'] = 'aliados/opcion'; //aqui es el controlador y el metodo
$route['registro'] = 'aliados/registro'; //aqui es el controlador y el metodo
$route['crea_user'] = 'aliados/crea_user'; //aqui es el controlador y el metodo
$route['contrato'] = 'aliados/contrato'; //aqui es el controlador y el metodo
$route['upgrade'] = 'aliados/upgrade'; //aqui es el controlador y el metodo
$route['cambionivel'] = 'aliados/cambionivel'; //aqui es el controlador y el metodo


$route['medico'] = 'especialistas/medico'; //aqui es el controlador y el metodo
$route['regmedico'] = 'especialistas/regmedico'; //aqui es el controlador y el metodo
$route['crea_medico'] = 'especialistas/crea_medico'; //aqui es el controlador y el metodo
$route['contmedico'] = 'especialistas/contmedico'; //aqui es el controlador y el metodo


$route['cliente_pref'] = 'cliente/cliente_pref'; //aqui es el controlador y el metodo
$route['reg_cliente'] = 'cliente/reg_cliente'; //aqui es el controlador y el metodo
$route['crea_user'] = 'aliados/crea_user'; //aqui es el controlador y el metodo
$route['contrato'] = 'aliados/contrato'; //aqui es el controlador y el metodo

/*
$route['crea_organizacion'] = 'registrodatos/crea_organizacion'; //aqui es el controlador y el metodo

$route['validanumero'] = 'validaciones/validanumero'; //aqui es el controlador y el metodo
$route['codigocero'] = 'validaciones/codigocero'; //aqui es el controlador y el metodo
$route['validacodigo'] = 'validaciones/validacodigo'; //aqui es el controlador y el metodo
$route['existecodigo'] = 'validaciones/existecodigo'; //aqui es el controlador y el metodo
$route['validarif'] = 'validaciones/validarif'; //aqui es el controlador y el metodo
$route['asignacodigo'] = 'validaciones/asignacodigo'; //aqui es el controlador y el metodo
*/
//$route['reg_pdf'] = 'file_pdf/reg_pdf'; //aqui es el controlador y el metodo
