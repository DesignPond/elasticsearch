<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/


Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));

Route::get('elastic', function()
{

/*
 * CREATE index
 *
    $indexParams['index']  = 'my_index';
    $result = Es::indices()->create($indexParams);
*/

/*
 * INDEX Document
 *
    $params = array();
    $params['body']  = array('testField' => 'abc');

    $params['index'] = 'my_index';
    $params['type']  = 'my_type';
    $params['id']    = '2A_123/2014';

    $result = Es::index($params);
 */

/*
 *  GET document

    $getParams = array();
    $getParams['index'] = 'my_index';
    $getParams['type']  = 'my_type';
    $getParams['id']    = '2A_123/2014';

    $result = Es::get($getParams);
*/
/*
 *  SEARCH Document

    $searchParams['index'] = 'my_index';
    $searchParams['type']  = 'my_type';
    $searchParams['body']['query']['match']['testField'] = 'abc';

    $result = Es::search($searchParams);
*/
/*
 * DELETE Document

    $deleteParams = array();
    $deleteParams['index'] = 'my_index';
    $deleteParams['type'] = 'my_type';
    $deleteParams['id'] = '2A_123/2014';

    $result = Es::delete($deleteParams);
*/

    print_r($result);

});