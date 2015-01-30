<?php

class UploadController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

    protected $access = array(
        'customers'         => array('Super Admin'),
        'uploadCustomers'   => array('Super Admin'),
        'insertCustomers'   => array('Super Admin')
    );
    /**
     * Constructor
     */
    public function __construct()
    {
        // Establish Filters
        $this->beforeFilter('auth');
        parent::checkPermissions($this->access);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function customers()
    {
        return View::make('upload.customers');
    }

    public function uploadCustomers()
    {
        ini_set('max_execution_time', 120);
        $file = Input::file('file'); // your file upload input field in the form should be named 'file'

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Customer::truncate();

        $folder = 'uploads/';
        $random = str_random(8);
        $destinationPath = $folder . $random;
        $filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension(); //if you need extension of the file
        $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
        if ($uploadSuccess)
        {
            $file = "public/" . $destinationPath . "/" . $filename;
            $this->insertCustomers($random, $filename);

            return Response::json(array('success' => 200, 'folder' => $random, 'filename' => $filename)); // or do a redirect with some message that file was uploaded
        } else
        {
            return Response::json('error', 400);
        }
    }

    public function insertCustomers($folder, $file)
    {
        ini_set('max_execution_time', 120);
        Excel::load("public/uploads/" . $folder . "/" . $file, function ($reader)
        {
            $reader->each(function ($row)
            {
                $row = $row->toArray();
                $company = new Customer($row);
                $company->save();
            });
        });

    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function users()
    {
        return View::make('upload.users');
    }

    public function uploadUsers()
    {
        ini_set('max_execution_time', 120);
        $file = Input::file('file'); // your file upload input field in the form should be named 'file'

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Customer::truncate();

        $folder = 'uploads/';
        $random = str_random(8);
        $destinationPath = $folder . $random;
        $filename = $file->getClientOriginalName();
        //$extension =$file->getClientOriginalExtension(); //if you need extension of the file
        $uploadSuccess = Input::file('file')->move($destinationPath, $filename);
        if ($uploadSuccess)
        {
            $file = "public/" . $destinationPath . "/" . $filename;
            $this->insertUsers($random, $filename);

            return Response::json(array('success' => 200, 'folder' => $random, 'filename' => $filename)); // or do a redirect with some message that file was uploaded
        } else
        {
            return Response::json('error', 400);
        }
    }

    public function insertUsers($folder, $file)
    {
        ini_set('max_execution_time', 120);
        Excel::load("public/uploads/" . $folder . "/" . $file, function ($reader)
        {
            $reader->each(function ($row)
            {
                $user = User::where('email', '=', $row['email'])->get();
                if (count($user) > 0){
                    $user = User::where('email', '=', $row['email'])->first();
                    $user->password = $row['password'];
                }else{
                    $user = Sentry::register(array('email' => $row['email'], 'password' => $row['password']));
                }
                $user->groups()->detach();
                $user->groups()->attach(Group::where('name', '=', $row['group'])->first()->id);
                $user->colour = $row['colour'];
                $user->first_name = $row['first_name'];
                $user->last_name = $row['last_name'];
                $user->title = $row['title'];
                $user->phone = $row['phone'];
                $user->ext = $row['ext'];
                $user->fax = $row['fax'];
                $user->activated = 1;
                $user->save();
            });
        });

    }

}