<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('/register', 'AuthController@register');
$router->post('/login', 'AuthController@login');
$router->get('/users', 'UserController@showAll');
$router->get('/user/{id}', 'UserController@show');

// checklists
$router->get('/checklists', 'ChecklistController@showAll');
$router->get('/checklists/{id}', 'ChecklistController@show');
$router->post('/checklists', 'ChecklistController@create');
$router->patch('/checklists/{id}', 'ChecklistController@update');
$router->delete('/checklists/{id}', 'ChecklistController@delete');

// checklists template
$router->get('/checklists-templates', 'ChecklistTemplateController@showAll');
$router->get('/checklists-templates/{id}', 'ChecklistTemplateController@show');
$router->post('/checklists-templates', 'ChecklistTemplateController@create');
$router->patch('/checklists-templates/{id}', 'ChecklistTemplateController@update');
$router->delete('/checklists-templates/{id}', 'ChecklistTemplateController@delete');

// checklists item
$router->get('/checklists-items/{checklistId}/items', 'ChecklistItemsController@showAll');
$router->get('/checklists-items/{checklistId}/items/{itemId}', 'ChecklistItemsController@show');
$router->post('/checklists-items/{checklistId}/items', 'ChecklistItemsController@create');
$router->patch('/checklists-items/{checklistId}/items/{itemId}', 'ChecklistItemsController@update');
$router->delete('/checklists-items/{checklistId}/items/{itemId}', 'ChecklistItemsController@delete');
$router->patch('/checklists-items/complete', 'ChecklistItemsController@complete');
$router->patch('/checklists-items/incomplete', 'ChecklistItemsController@incomplete');