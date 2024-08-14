<?php

namespace PHPMaker2021\import_ppei;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // data_master
    $app->any('/datamasterlist[/{id}]', DataMasterController::class . ':list')->add(PermissionMiddleware::class)->setName('datamasterlist-data_master-list'); // list
    $app->any('/datamasteradd[/{id}]', DataMasterController::class . ':add')->add(PermissionMiddleware::class)->setName('datamasteradd-data_master-add'); // add
    $app->any('/datamasterview[/{id}]', DataMasterController::class . ':view')->add(PermissionMiddleware::class)->setName('datamasterview-data_master-view'); // view
    $app->group(
        '/data_master',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id}]', DataMasterController::class . ':list')->add(PermissionMiddleware::class)->setName('data_master/list-data_master-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id}]', DataMasterController::class . ':add')->add(PermissionMiddleware::class)->setName('data_master/add-data_master-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id}]', DataMasterController::class . ':view')->add(PermissionMiddleware::class)->setName('data_master/view-data_master-view-2'); // view
        }
    );

    // Perusahaan
    $app->any('/perusahaanlist', PerusahaanController::class . ':list')->add(PermissionMiddleware::class)->setName('perusahaanlist-Perusahaan-list'); // list
    $app->group(
        '/perusahaan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PerusahaanController::class . ':list')->add(PermissionMiddleware::class)->setName('perusahaan/list-Perusahaan-list-2'); // list
        }
    );

    // Peserta
    $app->any('/pesertalist', PesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('pesertalist-Peserta-list'); // list
    $app->group(
        '/peserta',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PesertaController::class . ':list')->add(PermissionMiddleware::class)->setName('peserta/list-Peserta-list-2'); // list
        }
    );

    // pelpes
    $app->any('/pelpeslist', PelpesController::class . ':list')->add(PermissionMiddleware::class)->setName('pelpeslist-pelpes-list'); // list
    $app->group(
        '/pelpes',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', PelpesController::class . ':list')->add(PermissionMiddleware::class)->setName('pelpes/list-pelpes-list-2'); // list
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

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
