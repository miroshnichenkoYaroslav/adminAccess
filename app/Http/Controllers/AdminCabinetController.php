<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

class AdminCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response()->view('admin.index');
    }

    /**
     * Get all users.
     *
     * @return User[]|Builder[]|Collection
     */
    public function usersList()
    {
        return User::with('role')->get();
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
                $allowedControllers[] = $controllerName;
            }
        }

        $uniqueAllowedControllers = array_unique($allowedControllers);

        return $this->prepareControllers($uniqueAllowedControllers);
    }

    /**
     * Аdd key a name to the controller.
     *
     * @param array $uniqueAllowedControllers
     * @param array $controllers
     *
     * @return array
     */
    public function prepareControllers(array $uniqueAllowedControllers, $controllers = []): array
    {
        foreach ($uniqueAllowedControllers as $controller) {
            $controllers[]['name'] = $controller;
        }

        return $controllers;
    }
}
