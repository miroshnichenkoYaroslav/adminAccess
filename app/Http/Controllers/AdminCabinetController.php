<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

class AdminCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.index');
    }

    public function usersList()
    {
        return DB::table('users')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Get allowed controllers on edit access.
     *
     * @return array
     */
    public function getAllowedControllers(): array
    {
        // Controllers to which access cannot be changed
        $forbiddenControllers = [
            'LoginController',
            'RegisterController',
            'ForgotPasswordController',
            'ResetPasswordController',
            'VerificationController',
            'HomeController',
            'Controller'
        ];

        $controllers = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $controllers[] = $action['controller'];
            }
        }

        $allowedControllers = [];
        foreach ($controllers as $controller) {
            $controllerNameAndMethod = explode('@', $controller);
            $numberLastBackslash = strripos($controllerNameAndMethod[0], '\\');
            $controllerName = substr($controllerNameAndMethod[0], $numberLastBackslash + 1);
            if (!in_array($controllerName, $forbiddenControllers)) {
                $allowedControllers['name'] = $controllerName;
            }
        }

        $uniqueAllowedControllers = array_unique($allowedControllers);

        return $uniqueAllowedControllers;
    }
}
