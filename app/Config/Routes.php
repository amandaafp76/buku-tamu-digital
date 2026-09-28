<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index', ['filter' => 'auth']);

$routes->get('bukutamu-masuk', 'AuthController::index');
$routes->post('bukutamu-masuk', 'AuthController::authenticate');
$routes->get('bukutamu-keluar', 'AuthController::logout');

$routes->get(
    'admin/bukutamu-dashboard',
    'DashboardController::index',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-pegawai',
    'EmployeeController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pegawai/tambah',
    'EmployeeController::create',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pegawai/tambah',
    'EmployeeController::store',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pegawai/edit/(:num)',
    'EmployeeController::edit/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pegawai/edit/(:num)',
    'EmployeeController::update/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pegawai/hapus/(:num)',
    'EmployeeController::confirmDelete/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pegawai/hapus/(:num)',
    'EmployeeController::delete/$1',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-departemen',
    'DepartmentController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-departemen/tambah',
    'DepartmentController::create',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-departemen/tambah',
    'DepartmentController::store',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-departemen/edit/(:num)',
    'DepartmentController::edit/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-departemen/edit/(:num)',
    'DepartmentController::update/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-departemen/hapus/(:num)',
    'DepartmentController::confirmDelete/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-departemen/hapus/(:num)',
    'DepartmentController::delete/$1',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-tujuan',
    'VisitPurposeController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-tujuan/tambah',
    'VisitPurposeController::create',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-tujuan/tambah',
    'VisitPurposeController::store',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-tujuan/edit/(:num)',
    'VisitPurposeController::edit/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-tujuan/edit/(:num)',
    'VisitPurposeController::update/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-tujuan/hapus/(:num)',
    'VisitPurposeController::confirmDelete/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-tujuan/hapus/(:num)',
    'VisitPurposeController::delete/$1',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-pengguna',
    'UserController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pengguna/tambah',
    'UserController::create',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pengguna/tambah',
    'UserController::store',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pengguna/edit/(:num)',
    'UserController::edit/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pengguna/edit/(:num)',
    'UserController::update/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pengguna/reset-password/(:num)',
    'UserController::resetPassword/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pengguna/reset-password/(:num)',
    'UserController::updatePassword/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pengguna/status/(:num)',
    'UserController::toggleStatus/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-pengguna/hapus/(:num)',
    'UserController::confirmDelete/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-pengguna/hapus/(:num)',
    'UserController::delete/$1',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-identitas-institusi',
    'InstitutionController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-identitas-institusi/edit',
    'InstitutionController::edit',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-identitas-institusi/update',
    'InstitutionController::update',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-konfigurasi',
    'SettingController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-konfigurasi/edit',
    'SettingController::edit',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-konfigurasi/update',
    'SettingController::update',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-wakita',
    'WakitaController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-wakita/edit',
    'WakitaController::edit',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-wakita/update',
    'WakitaController::update',
    ['filter' => ['auth', 'role:administrator']]
);


$routes->get(
    'admin/bukutamu-template-pesan',
    'NotificationTemplateController::index',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-template-pesan/tambah',
    'NotificationTemplateController::create',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-template-pesan/tambah',
    'NotificationTemplateController::store',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->get(
    'admin/bukutamu-template-pesan/edit/(:num)',
    'NotificationTemplateController::edit/$1',
    ['filter' => ['auth', 'role:administrator']]
);
$routes->post(
    'admin/bukutamu-template-pesan/edit/(:num)',
    'NotificationTemplateController::update/$1',
    ['filter' => ['auth', 'role:administrator']]
);
