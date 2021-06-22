<?php

namespace PHPMaker2021\simtrial;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // departemen
    $app->any('/DepartemenList[/{id}]', DepartemenController::class . ':list')->add(PermissionMiddleware::class)->setName('DepartemenList-departemen-list'); // list
    $app->any('/DepartemenAdd[/{id}]', DepartemenController::class . ':add')->add(PermissionMiddleware::class)->setName('DepartemenAdd-departemen-add'); // add
    $app->any('/DepartemenView[/{id}]', DepartemenController::class . ':view')->add(PermissionMiddleware::class)->setName('DepartemenView-departemen-view'); // view
    $app->any('/DepartemenEdit[/{id}]', DepartemenController::class . ':edit')->add(PermissionMiddleware::class)->setName('DepartemenEdit-departemen-edit'); // edit
    $app->any('/DepartemenDelete[/{id}]', DepartemenController::class . ':delete')->add(PermissionMiddleware::class)->setName('DepartemenDelete-departemen-delete'); // delete
    $app->group(
        '/departemen',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DepartemenController::class . ':list')->add(PermissionMiddleware::class)->setName('departemen/list-departemen-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DepartemenController::class . ':add')->add(PermissionMiddleware::class)->setName('departemen/add-departemen-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DepartemenController::class . ':view')->add(PermissionMiddleware::class)->setName('departemen/view-departemen-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', DepartemenController::class . ':edit')->add(PermissionMiddleware::class)->setName('departemen/edit-departemen-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', DepartemenController::class . ':delete')->add(PermissionMiddleware::class)->setName('departemen/delete-departemen-delete-2'); // delete
        }
    );

    // kode_tabel
    $app->any('/KodeTabelList[/{id}]', KodeTabelController::class . ':list')->add(PermissionMiddleware::class)->setName('KodeTabelList-kode_tabel-list'); // list
    $app->any('/KodeTabelAdd[/{id}]', KodeTabelController::class . ':add')->add(PermissionMiddleware::class)->setName('KodeTabelAdd-kode_tabel-add'); // add
    $app->any('/KodeTabelView[/{id}]', KodeTabelController::class . ':view')->add(PermissionMiddleware::class)->setName('KodeTabelView-kode_tabel-view'); // view
    $app->any('/KodeTabelEdit[/{id}]', KodeTabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('KodeTabelEdit-kode_tabel-edit'); // edit
    $app->any('/KodeTabelDelete[/{id}]', KodeTabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('KodeTabelDelete-kode_tabel-delete'); // delete
    $app->group(
        '/kode_tabel',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', KodeTabelController::class . ':list')->add(PermissionMiddleware::class)->setName('kode_tabel/list-kode_tabel-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', KodeTabelController::class . ':add')->add(PermissionMiddleware::class)->setName('kode_tabel/add-kode_tabel-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', KodeTabelController::class . ':view')->add(PermissionMiddleware::class)->setName('kode_tabel/view-kode_tabel-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', KodeTabelController::class . ':edit')->add(PermissionMiddleware::class)->setName('kode_tabel/edit-kode_tabel-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', KodeTabelController::class . ':delete')->add(PermissionMiddleware::class)->setName('kode_tabel/delete-kode_tabel-delete-2'); // delete
        }
    );

    // penjualan
    $app->any('/PenjualanList[/{id}]', PenjualanController::class . ':list')->add(PermissionMiddleware::class)->setName('PenjualanList-penjualan-list'); // list
    $app->any('/PenjualanAdd[/{id}]', PenjualanController::class . ':add')->add(PermissionMiddleware::class)->setName('PenjualanAdd-penjualan-add'); // add
    $app->any('/PenjualanView[/{id}]', PenjualanController::class . ':view')->add(PermissionMiddleware::class)->setName('PenjualanView-penjualan-view'); // view
    $app->any('/PenjualanEdit[/{id}]', PenjualanController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenjualanEdit-penjualan-edit'); // edit
    $app->any('/PenjualanDelete[/{id}]', PenjualanController::class . ':delete')->add(PermissionMiddleware::class)->setName('PenjualanDelete-penjualan-delete'); // delete
    $app->group(
        '/penjualan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PenjualanController::class . ':list')->add(PermissionMiddleware::class)->setName('penjualan/list-penjualan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PenjualanController::class . ':add')->add(PermissionMiddleware::class)->setName('penjualan/add-penjualan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PenjualanController::class . ':view')->add(PermissionMiddleware::class)->setName('penjualan/view-penjualan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PenjualanController::class . ':edit')->add(PermissionMiddleware::class)->setName('penjualan/edit-penjualan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PenjualanController::class . ':delete')->add(PermissionMiddleware::class)->setName('penjualan/delete-penjualan-delete-2'); // delete
        }
    );

    // penjualan_detail
    $app->any('/PenjualanDetailList[/{id}]', PenjualanDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('PenjualanDetailList-penjualan_detail-list'); // list
    $app->any('/PenjualanDetailAdd[/{id}]', PenjualanDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('PenjualanDetailAdd-penjualan_detail-add'); // add
    $app->any('/PenjualanDetailView[/{id}]', PenjualanDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('PenjualanDetailView-penjualan_detail-view'); // view
    $app->any('/PenjualanDetailEdit[/{id}]', PenjualanDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('PenjualanDetailEdit-penjualan_detail-edit'); // edit
    $app->any('/PenjualanDetailDelete[/{id}]', PenjualanDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('PenjualanDetailDelete-penjualan_detail-delete'); // delete
    $app->group(
        '/penjualan_detail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', PenjualanDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('penjualan_detail/list-penjualan_detail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', PenjualanDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('penjualan_detail/add-penjualan_detail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', PenjualanDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('penjualan_detail/view-penjualan_detail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', PenjualanDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('penjualan_detail/edit-penjualan_detail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', PenjualanDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('penjualan_detail/delete-penjualan_detail-delete-2'); // delete
        }
    );

    // produk
    $app->any('/ProdukList[/{id}]', ProdukController::class . ':list')->add(PermissionMiddleware::class)->setName('ProdukList-produk-list'); // list
    $app->any('/ProdukAdd[/{id}]', ProdukController::class . ':add')->add(PermissionMiddleware::class)->setName('ProdukAdd-produk-add'); // add
    $app->any('/ProdukView[/{id}]', ProdukController::class . ':view')->add(PermissionMiddleware::class)->setName('ProdukView-produk-view'); // view
    $app->any('/ProdukEdit[/{id}]', ProdukController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProdukEdit-produk-edit'); // edit
    $app->any('/ProdukDelete[/{id}]', ProdukController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProdukDelete-produk-delete'); // delete
    $app->group(
        '/produk',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ProdukController::class . ':list')->add(PermissionMiddleware::class)->setName('produk/list-produk-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ProdukController::class . ':add')->add(PermissionMiddleware::class)->setName('produk/add-produk-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ProdukController::class . ':view')->add(PermissionMiddleware::class)->setName('produk/view-produk-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ProdukController::class . ':edit')->add(PermissionMiddleware::class)->setName('produk/edit-produk-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ProdukController::class . ':delete')->add(PermissionMiddleware::class)->setName('produk/delete-produk-delete-2'); // delete
        }
    );

    // produksi
    $app->any('/ProduksiList[/{id}]', ProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('ProduksiList-produksi-list'); // list
    $app->any('/ProduksiAdd[/{id}]', ProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('ProduksiAdd-produksi-add'); // add
    $app->any('/ProduksiView[/{id}]', ProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('ProduksiView-produksi-view'); // view
    $app->any('/ProduksiEdit[/{id}]', ProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProduksiEdit-produksi-edit'); // edit
    $app->any('/ProduksiDelete[/{id}]', ProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProduksiDelete-produksi-delete'); // delete
    $app->group(
        '/produksi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('produksi/list-produksi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('produksi/add-produksi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('produksi/view-produksi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('produksi/edit-produksi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('produksi/delete-produksi-delete-2'); // delete
        }
    );

    // produksi_detail
    $app->any('/ProduksiDetailList[/{id}]', ProduksiDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('ProduksiDetailList-produksi_detail-list'); // list
    $app->any('/ProduksiDetailAdd[/{id}]', ProduksiDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('ProduksiDetailAdd-produksi_detail-add'); // add
    $app->any('/ProduksiDetailView[/{id}]', ProduksiDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('ProduksiDetailView-produksi_detail-view'); // view
    $app->any('/ProduksiDetailEdit[/{id}]', ProduksiDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('ProduksiDetailEdit-produksi_detail-edit'); // edit
    $app->any('/ProduksiDetailDelete[/{id}]', ProduksiDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('ProduksiDetailDelete-produksi_detail-delete'); // delete
    $app->group(
        '/produksi_detail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', ProduksiDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('produksi_detail/list-produksi_detail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', ProduksiDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('produksi_detail/add-produksi_detail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', ProduksiDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('produksi_detail/view-produksi_detail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', ProduksiDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('produksi_detail/edit-produksi_detail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', ProduksiDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('produksi_detail/delete-produksi_detail-delete-2'); // delete
        }
    );

    // tiket
    $app->any('/TiketList[/{id}]', TiketController::class . ':list')->add(PermissionMiddleware::class)->setName('TiketList-tiket-list'); // list
    $app->any('/TiketAdd[/{id}]', TiketController::class . ':add')->add(PermissionMiddleware::class)->setName('TiketAdd-tiket-add'); // add
    $app->any('/TiketView[/{id}]', TiketController::class . ':view')->add(PermissionMiddleware::class)->setName('TiketView-tiket-view'); // view
    $app->any('/TiketEdit[/{id}]', TiketController::class . ':edit')->add(PermissionMiddleware::class)->setName('TiketEdit-tiket-edit'); // edit
    $app->any('/TiketDelete[/{id}]', TiketController::class . ':delete')->add(PermissionMiddleware::class)->setName('TiketDelete-tiket-delete'); // delete
    $app->group(
        '/tiket',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', TiketController::class . ':list')->add(PermissionMiddleware::class)->setName('tiket/list-tiket-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', TiketController::class . ':add')->add(PermissionMiddleware::class)->setName('tiket/add-tiket-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', TiketController::class . ':view')->add(PermissionMiddleware::class)->setName('tiket/view-tiket-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', TiketController::class . ':edit')->add(PermissionMiddleware::class)->setName('tiket/edit-tiket-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', TiketController::class . ':delete')->add(PermissionMiddleware::class)->setName('tiket/delete-tiket-delete-2'); // delete
        }
    );

    // tiket_detail
    $app->any('/TiketDetailList[/{id}]', TiketDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('TiketDetailList-tiket_detail-list'); // list
    $app->any('/TiketDetailAdd[/{id}]', TiketDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('TiketDetailAdd-tiket_detail-add'); // add
    $app->any('/TiketDetailView[/{id}]', TiketDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('TiketDetailView-tiket_detail-view'); // view
    $app->any('/TiketDetailEdit[/{id}]', TiketDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('TiketDetailEdit-tiket_detail-edit'); // edit
    $app->any('/TiketDetailDelete[/{id}]', TiketDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('TiketDetailDelete-tiket_detail-delete'); // delete
    $app->group(
        '/tiket_detail',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', TiketDetailController::class . ':list')->add(PermissionMiddleware::class)->setName('tiket_detail/list-tiket_detail-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', TiketDetailController::class . ':add')->add(PermissionMiddleware::class)->setName('tiket_detail/add-tiket_detail-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', TiketDetailController::class . ':view')->add(PermissionMiddleware::class)->setName('tiket_detail/view-tiket_detail-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', TiketDetailController::class . ':edit')->add(PermissionMiddleware::class)->setName('tiket_detail/edit-tiket_detail-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', TiketDetailController::class . ':delete')->add(PermissionMiddleware::class)->setName('tiket_detail/delete-tiket_detail-delete-2'); // delete
        }
    );

    // tiket_subjek
    $app->any('/TiketSubjekList[/{id}]', TiketSubjekController::class . ':list')->add(PermissionMiddleware::class)->setName('TiketSubjekList-tiket_subjek-list'); // list
    $app->any('/TiketSubjekAdd[/{id}]', TiketSubjekController::class . ':add')->add(PermissionMiddleware::class)->setName('TiketSubjekAdd-tiket_subjek-add'); // add
    $app->any('/TiketSubjekView[/{id}]', TiketSubjekController::class . ':view')->add(PermissionMiddleware::class)->setName('TiketSubjekView-tiket_subjek-view'); // view
    $app->any('/TiketSubjekEdit[/{id}]', TiketSubjekController::class . ':edit')->add(PermissionMiddleware::class)->setName('TiketSubjekEdit-tiket_subjek-edit'); // edit
    $app->any('/TiketSubjekDelete[/{id}]', TiketSubjekController::class . ':delete')->add(PermissionMiddleware::class)->setName('TiketSubjekDelete-tiket_subjek-delete'); // delete
    $app->group(
        '/tiket_subjek',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', TiketSubjekController::class . ':list')->add(PermissionMiddleware::class)->setName('tiket_subjek/list-tiket_subjek-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', TiketSubjekController::class . ':add')->add(PermissionMiddleware::class)->setName('tiket_subjek/add-tiket_subjek-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', TiketSubjekController::class . ':view')->add(PermissionMiddleware::class)->setName('tiket_subjek/view-tiket_subjek-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', TiketSubjekController::class . ':edit')->add(PermissionMiddleware::class)->setName('tiket_subjek/edit-tiket_subjek-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id}]', TiketSubjekController::class . ':delete')->add(PermissionMiddleware::class)->setName('tiket_subjek/delete-tiket_subjek-delete-2'); // delete
        }
    );

    // userlevelpermissions
    $app->any('/UserlevelpermissionsList[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsList-userlevelpermissions-list'); // list
    $app->any('/UserlevelpermissionsView[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsView-userlevelpermissions-view'); // view
    $app->any('/UserlevelpermissionsEdit[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelpermissionsEdit-userlevelpermissions-edit'); // edit
    $app->group(
        '/userlevelpermissions',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevelpermissions/list-userlevelpermissions-list-2'); // list
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevelpermissions/view-userlevelpermissions-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}/{_tablename}]', UserlevelpermissionsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevelpermissions/edit-userlevelpermissions-edit-2'); // edit
        }
    );

    // userlevels
    $app->any('/UserlevelsList[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('UserlevelsList-userlevels-list'); // list
    $app->any('/UserlevelsAdd[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('UserlevelsAdd-userlevels-add'); // add
    $app->any('/UserlevelsView[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('UserlevelsView-userlevels-view'); // view
    $app->any('/UserlevelsEdit[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('UserlevelsEdit-userlevels-edit'); // edit
    $app->any('/UserlevelsDelete[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('UserlevelsDelete-userlevels-delete'); // delete
    $app->group(
        '/userlevels',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':list')->add(PermissionMiddleware::class)->setName('userlevels/list-userlevels-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':add')->add(PermissionMiddleware::class)->setName('userlevels/add-userlevels-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':view')->add(PermissionMiddleware::class)->setName('userlevels/view-userlevels-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':edit')->add(PermissionMiddleware::class)->setName('userlevels/edit-userlevels-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{userlevelid}]', UserlevelsController::class . ':delete')->add(PermissionMiddleware::class)->setName('userlevels/delete-userlevels-delete-2'); // delete
        }
    );

    // users
    $app->any('/UsersList[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('UsersList-users-list'); // list
    $app->any('/UsersAdd[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('UsersAdd-users-add'); // add
    $app->any('/UsersView[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('UsersView-users-view'); // view
    $app->any('/UsersEdit[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('UsersEdit-users-edit'); // edit
    $app->group(
        '/users',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', UsersController::class . ':list')->add(PermissionMiddleware::class)->setName('users/list-users-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', UsersController::class . ':add')->add(PermissionMiddleware::class)->setName('users/add-users-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', UsersController::class . ':view')->add(PermissionMiddleware::class)->setName('users/view-users-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id}]', UsersController::class . ':edit')->add(PermissionMiddleware::class)->setName('users/edit-users-edit-2'); // edit
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // change_password
    $app->any('/changepassword', OthersController::class . ':changepassword')->add(PermissionMiddleware::class)->setName('changepassword');

    // userpriv
    $app->any('/userpriv', OthersController::class . ':userpriv')->add(PermissionMiddleware::class)->setName('userpriv');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
