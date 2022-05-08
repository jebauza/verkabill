<?php

return [

    'identification_types' => [
        ['code' => '0', 'name' => 'DOC.TRIB.NO.DOM.SIN.RUC', 'abbreviation' => null],
        ['code' => '1', 'name' => 'DOC. NATIONAL DE IDENTIDAD', 'abbreviation' => null],
        ['code' => '4', 'name' => 'CARNET DE EXTRANJERIA', 'abbreviation' => null],
        ['code' => '6', 'name' => 'REG. UNICO DE CONTRIBUYENTES', 'abbreviation' => null],
        ['code' => '7', 'name' => 'PASAPORTE', 'abbreviation' => null],
        ['code' => 'A', 'name' => 'CED. DIPLOMATICA DE IDENTIDAD', 'abbreviation' => null],
        ['code' => 'B', 'name' => 'DOC.IDENT.PAIS.RESIDENCIA-NO.D', 'abbreviation' => null],
        ['code' => 'C', 'name' => 'Tax Identification Number - TIN - Doc Trib PP.NN', 'abbreviation' => null],
        ['code' => 'D', 'name' => 'IdentificationNumber -IN - Doc Trib PP.JJ', 'abbreviation' => null],
    ],

    'vouchers' => [
        ['code' => '01', 'name' => 'Factura'],
        /* ['code' => '', 'name' => 'Boletas de Venta'],
        ['code' => '', 'name' => 'Nota de Credito'],
        ['code' => '', 'name' => 'Nota de Debito'],
        ['code' => '', 'name' => 'Comunicacion de Baja'], */
    ],

    'permissions' => [
        /* Users */
        ['name' => 'users.index', 'display_name' => 'Navegar Usuarios', 'guard_name' => 'api'],
        ['name' => 'users.store', 'display_name' => 'Crear Usuarios', 'guard_name' => 'api'],
        ['name' => 'users.show', 'display_name' => 'Ver Usuario', 'guard_name' => 'api'],
        ['name' => 'users.update', 'display_name' => 'Modificar Usuario', 'guard_name' => 'api'],
        ['name' => 'users.activate', 'display_name' => 'Activar Usuarios', 'guard_name' => 'api'],
        ['name' => 'users.deactivate', 'display_name' => 'Desactivar Usuarios', 'guard_name' => 'api'],

        /* Roles */
        ['name' => 'roles.index', 'display_name' => 'Navegar Roles', 'guard_name' => 'api'],
        ['name' => 'roles.store', 'display_name' => 'Crear Roles', 'guard_name' => 'api'],
        ['name' => 'roles.show', 'display_name' => 'Ver Rol', 'guard_name' => 'api'],
        ['name' => 'roles.update', 'display_name' => 'Modificar Rol', 'guard_name' => 'api'],
    ]

];
