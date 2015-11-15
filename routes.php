<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//chapter-7
/*get('/', function () {
	return redirect('/blog');
});

get('blog', 'BlogController@index');
get('blog/{slug}', 'BlogController@showPost');*///chapter-7


// After the line that reads
get('admin/upload', 'UploadController@index');



// Blog pages
get('/', function () {
	return redirect('/blog');
});


/*Notice Notice*/
/*get('blog', 'BlogController@index');
get('blog/{slug}', 'BlogController@showPost');
get('sitemap.xml', 'BlogController@siteMap');*/


$router->get('contact', 'ContactController@showForm');
Route::post('contact', 'ContactController@sendContactInfo');
get('rss', 'BlogController@rss');

// Admin area
get('admin', function () {
	return redirect('/admin/post');
});
$router->group([
	'namespace' => 'Admin',
	'middleware' => 'auth',
	], function () {
		resource('admin/post', 'PostController');
		resource('admin/tag', 'TagController', ['expect' => 'show']);
		resource('admin/post', 'PostController', ['expect' => 'show']);
		get('admin/upload', 'UploadController@index');
		post('admin/upload/file', 'UploadController@uploadFile');
		delete('admin/upload/file', 'UploadController@deleteFile');
		post('admin/upload/folder', 'UploadController@createFolder');
		delete('admin/upload/folder', 'UploadController@deleteFolder');

	});
// Logging in and out
get('/auth/login', 'Auth\AuthController@getLogin');
post('/auth/login', 'Auth\AuthController@postLogin');
get('/auth/logout', 'Auth\AuthController@getLogout');





// Add the following routes


/*get('/', function () {
	return view('welcome');
});*/


/**For Student**/
/*get('/', function () {
	return redirect('/student');
});*/

get('/student-create', function(){
	return view('student.create');
});
post('/student-create', function(){
	/*Input::get*/
	/*$id = Input::get("id");
	$name = Input::get("name");
	$address = Input::get("address");
	
	echo $id;
	echo $name;
	echo $address;
	*/

	
	$data = Input::except("_token");

	$rules = [
		'id' => 'required',
		'name' => 'required|min:4',
		'address' => 'required',
		'ph-no' => 'required'
	];

	//validation
	$validator = Validator::make($data, $rules);

	if($validator->fails()){

		return redirect()
			->back()
			->withErrors($validator)
			->withInput();
	}
	
	//DB::table("studen")->insert($data);
	return "Hello from post Method";
});




get('/blog-create', function(){
	return view('blog.create');
});

get('welcome/{locale}', function($locale){
	App::setLocale($locale);
});


post('/blog-create', function(){
	/*Input::get
	$title = Input::get("title");
	$body = Input::get("body");
	echo $title;
	echo $body;*/

	$data = Input::except("_token");

	$rules = [
		'title' => 'required|min:4',
		'body' => 'required'
	];

	//validation
	$validator = Validator::make($data, $rules);

	if($validator->fails()){

		return redirect()
			->back()
			->withErrors($validator)
			->withInput();
	}
	
	//DB::table("myblogs")->insert($data);
	return "Hello from Post Method";
});

Route::resource('blog', 'BlogController');
Route::resource('student', "StudentController");