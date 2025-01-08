<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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

$route['default_controller'] = 'auth';
$route['404_override'] = 'auth/notfound';
$route['translate_uri_dashes'] = FALSE;

$route['dashboard-admin'] = 'dashboard/admin';
$route['dashboard-pelanggan'] = 'dashboard/pelanggan';

$route['data-pengaduan'] = 'menu/index';
$route['tutorial_pembayaran'] = 'admin/tutorial_pembayaran';

$route['data-pelanggan'] = 'admin/data_pelanggan';
$route['tambah-pelanggan'] = 'admin/tambah_pelanggan';
$route['edit-pelanggan/(:num)'] = 'admin/edit_pelanggan/$1';

$route['data-langganan'] = 'langganan/data_langganan';
$route['tambah-langganan'] = 'langganan/tambah_langganan';
$route['edit-langganan/(:num)'] = 'langganan/edit_langganan/$1';
$route['hapus-langganan/(:num)'] = 'langganan/hapus_langganan/$1';

$route['data-invoice'] = 'invoice/data_invoice';
$route['edit-invoice/(:num)'] = 'invoice/edit_invoice/$1';
$route['hapus-invoice/(:num)'] = 'invoice/hapus_invoice/$1';

$route['data-tagihan'] = 'invoice/data_tagihan';
$route['detail-tagihan/(:num)'] = 'invoice/detail_tagihan/$1';
$route['ubah-password'] = 'user/ubah_password';

$route['cetak-invoice/(:num)'] = 'Report/invoiceById/$1';
$route['laporan-pengaduan'] = 'menu/laporan';

$route['daftar-pengaduan'] = 'user/read_data_pelanggan';
$route['tambah-pengaduan'] = 'user/tambah_data';

$route['notfound'] = 'auth/notfound';
