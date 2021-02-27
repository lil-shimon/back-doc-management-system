<?php

use App\Http\Controllers\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    ['middleware' => 'auth:api',],
    function () {
        Route::apiResource('user', 'UsersController');

        Route::apiResource('document', 'DocumentController');

        Route::apiResource('product', 'ProductController');

        Route::apiResource('postage', 'PostageController');

        Route::apiResource('company-logo', 'CompanyLogoController');

        Route::apiResource('purchasedproduct', 'PurchasedProductController');

        Route::apiResource('purchasedpostage', 'PurchasedPostageController');

        Route::apiResource('contractedcompany', 'ContractedCompanyController');

        Route::apiResource('order', 'OrderController');

        Route::apiResource('orderitem', 'OrderItemController');

        Route::apiResource('attachment', 'AttachmentController');

        Route::apiResource('maintenance', 'MaintenanceController');

        Route::post('setdocument', 'Progress@setDocument');

        Route::get('get_edit/{orderId}', 'OrderController@getEdit');

        // search order by words
        Route::get('search-order', "OrderController@searchOrder");

        //  get order item information for each order
        Route::get('getorderitem/{id}', "OrderController@getOrderItem");

        // get contracted company information for each order
        Route::get('getcontractedcompany/{id}', "OrderController@getContractedCompany");

        Route::get('getattachment/{id}', 'OrderController@getAttachment');

        // 見積もり一覧から案件を作成
        Route::post('storefromdocument', 'OrderController@storefromdocument');
        Route::post('storeorderitemfromdocument', 'OrderItemController@storeOrderItemFromDocument');

        //受注された見積もりIDを取得
        Route::get("getdocumentidarray", "OrderController@getDocumentIdArray");

        // 書類の絞り込み
        Route::get("get-narrow-down-doc", "DocumentController@narrow_down_doc");
        // ゴミ箱にあるものを取得
        Route::get("get-deleted-doc", "DocumentController@deleted_doc_list");
        // 書類の数を取得
        Route::get("get-document-lenght", "DocumentController@get_document_lenght");

        // pdf用の書類情報取得
        Route::get("get-doc-info", "DocumentController@get_doc_info");
        // base64の画像取得
        Route::get("get-base64-img", "CompanyLogoController@getbase64Image");

        // ステータスの変更
        Route::get("change-status", "DocumentController@change_status");

        // 書類の復元
        Route::get("restore", "DocumentController@restore");

        // 見積部の見積書と請求書を取りだす
        Route::get("orderitemfilefindall/{id}", "OrderItemController@orderItemFileFindAll");

        //product typesごとに取り出す
        Route::get("producttypesidindex/{product_types_id}", "ProductController@productTypesIdIndex");

        //postage with pagenation
        Route::get('postageindex', "PostageController@postageindex");

        //今月のメンテデータを取得
        Route::get('getthismonth', "MaintenanceController@getThisMonth");

        //先月のメンテデータを取得
        Route::get('getlastmonth', 'MaintenanceController@getLastMonth');

        Route::get('gettwomonthago', 'MaintenanceController@getTwoMonthAgo');
    }
);

Route::post('auth/login', 'AuthController@login');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});
