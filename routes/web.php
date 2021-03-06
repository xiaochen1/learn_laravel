<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


//--------------------------------------------------------------------------------------------------------
//----基本路由----------------------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------

// Route::get('/', function () {
//     return view('welcome');
// });

// 请求方法级别：  any > match > 其他（get/post等）

Route::get('/', function () {
    return 'get';
});

Route::post('/', function () {
    return 'post';
});

Route::delete('/', function () {
    return 'delete';
});

Route::put('/', function () {
    return 'put';
});

Route::options('/', function () {
    return 'options';
});

Route::patch('/', function () {
    return 'patch';
});

//
Route::match(['get', 'post'], '/', function () {
    return 'match;   get | post';
});

// 同一url下， any优先级最高， get/post等其他方法的路由会被屏蔽
Route::any('/', function () {
    return 'any';
});

// 同一url下， any优先级最高， get/post等其他方法的路由会被屏蔽

Route::get('/there', function () {
    return 'there';
});

// 重定向到其他路由
Route::redirect('/', '/there');

/**
 *view(参数1, 参数2,  参数3)
 * 参数1： 路由地址
 * 参数2： 要渲染的模板（xxx.blade.php）（resources/views/目录下）
 * 参数3： 数组， 可选的， 用于传递到模板的数据
 */
Route::view('/welcome', 'welcome', ['name' => 'Taylor']);

//--------------------------------------------------------------------------------------------------------
//-----路由传参---------------------------------------------------------------------------------------
//--------------------------------------------------------------------------------------------------------

Route::get('/user/{id}', function($id) {
    echo $id;
});

// 可选参数, 当配置可选参数时， 回调函数中对应的参数需要赋初始值。 否则报错
Route::get('/user/{id?}', function( $id = null ) {
    echo $id;
});

//--------------------------------------------------------------------------------------------------------
//----正则约束的路由---------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

Route::get('/test/{id}/{name}', function ($id, $name) {
    echo $id  . '; ' . $name;
})->where(['id' => '[0-9]+', 'name' => '[a-zA-Z_][a-zA-Z0-9_]+']);

//   /test/1001/xiao    1001; xiao
//   /test/1001/xiao1   1001; xiao1
//   /test/1001/4545    not found
//   /test/1001/3xiao1   not found


//--------------------------------------------------------------------------------------------------------
//----命名路由---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------

// 命名路由方便在重定向时调用
// 通过 name('profile') 方法来为某个路由定义名称，然后在使用时， 需先实例化一个路由对象

Route::get('/user/{id}/profile', function ($id) {
    //为 /user/profile 路由  命名为 user_profile
    return 'id:'.$id;
})->name('user_profile');

//命名路由的使用  (1) 生成url  (2) 生成重定向


Route::get('/testNameRoute', function () {
    // (1) 生成url (从指定路由生成url)
    // $url = route('user_profile', ["id" => 1001]);
    // echo $url ; //  http://learn.laravel.my/user/1001/profile

    // (2)生成重定向
    return redirect()->route('user_profile', ['id'=> 1001]);
    // http://learn.laravel.my/user/1001/profile
});


//--------------------------------------------------------------------------------------------------------
//----路由组---------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------



