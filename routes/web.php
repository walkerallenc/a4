<?php
######################################################################################################
#                                DWA15-Dynamic Web Applications Assignment #4.                       #          
######################################################################################################
###################################################################################################### 
###The code within the routes file establishes the main route, a logs route and a debugging route.   #
###################################################################################################### 


Route::get('/security/new', 'Login2Controller@createNewEmployee');

Route::get('/', 'Login2Controller@index');

##Route::get('/security','Login2Controller@access');

Route::get('/security/{id?}/{edit_delete?}','Login2Controller@edit');
###Route::get('/security/{submitaction?}', 'LoginController@confirmDeletion');

#Route::get('/mgrportal','Login2Controller@access');
##Route::get('employees/edit/{id}','Login2Controller@edit');

Route::post('/save/new', 'Login2Controller@saveNewEmployee');

Route::post('/save', 'Login2Controller@saveEdits');

Route::get('/initdelete/{id?}', 'Login2Controller@confirmDeletion');

Route::post('/delete', 'Login2Controller@delete');

Route::get('/show/{id?}', 'Login2Controller@show');




if(config('app.env') == 'local') {
    Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    Route::get('/debugbar', function() {

        $data = Array('scrabbleword' => 'value');
        Debugbar::info($data);
        Debugbar::info('Current environment: '.App::environment());
        Debugbar::error('Error!');
        Debugbar::warning('Watch out…');
        Debugbar::addMessage('Another message', 'mylabel');

        return 'Debugbar features';
    });
}

Route::get('/debug', function() {

	echo '<pre>';

	echo '<h1>Environment</h1>';
	echo App::environment().'</h1>';

	echo '<h1>Debugging?</h1>';
	if(config('app.debug')) echo "Yes"; else echo "No";

	echo '<h1>Database Config</h1>';
    	echo 'DB defaultStringLength: '.Illuminate\Database\Schema\Builder::$defaultStringLength;
    	/*
	The following commented out line will print your MySQL credentials.
	Uncomment this line only if you're facing difficulties connecting to the database and you
        need to confirm your credentials.
        When you're done debugging, comment it back out so you don't accidentally leave it
        running on your production server, making your credentials public.
        */
	//print_r(config('database.connections.mysql'));

	echo '<h1>Test Database Connection</h1>';
	try {
		$results = DB::select('SHOW DATABASES;');
		echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
		echo "<br><br>Your Databases:<br><br>";
		print_r($results);
	}
	catch (Exception $e) {
		echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
	}

	echo '</pre>';

});

if(App::environment('local')) {

    Route::get('/drop', function() {

        DB::statement('DROP database foobooks');
        DB::statement('CREATE database foobooks');

        return 'Dropped foobooks; created foobooks.';
    });

};


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
