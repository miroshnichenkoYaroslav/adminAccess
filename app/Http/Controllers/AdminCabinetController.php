<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class AdminCabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
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
     * @param User $user
     *
     * @return array
     *
     * @throws Exception
     */
    public function getAllowedControllersAndPermissions(User $user): array
    {
        $forbiddenControllers = $this->getForbiddenControllers();

        $allowedControllers = [];
        $controllers = $this->getAllControllersInSystem();
        $controllersFromPermissions = $this->getAllPermissionsForUser($user);

        foreach ($controllers as $controller) {
            $controllerNameAndMethod = explode('@', $controller);
            $numberLastBackslash = strripos($controllerNameAndMethod[0], '\\');
            $controllerName = substr($controllerNameAndMethod[0], $numberLastBackslash + 1);

            if (!in_array($controllerName, $forbiddenControllers)) {
                $allowedControllers[$controllerName] = in_array($controllerName, $controllersFromPermissions);
            }
        }

        return $allowedControllers;
    }

    /**
     * Gets all controllers to which access is allowed from the selected user.
     *
     * @param User $user
     *
     * @return array
     *
     * @throws Exception
     */
    public function getAllPermissionsForUser(User $user): array
    {
        $permissions = $user->getAllPermissions()->pluck('name');
        $controllers = [];
        foreach ($permissions as $permission) {
            $controllerName = explode(' ', $permission);
            $controllers[] = $controllerName[1];
        }

        return $controllers;

    }

    /**
     * Gets all the controllers that are in the system.
     *
     * @return array
     */
    public function getAllControllersInSystem(): array
    {
        $controllers = [];
        foreach (Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            if (array_key_exists('controller', $action)) {
                $controllers[] = $action['controller'];
            }
        }

        return $controllers;
    }

    /**
     * Controllers to which access cannot be changed.
     *
     * @return array
     */
    public function getForbiddenControllers(): array
    {
        return [
            'LoginController',
            'RegisterController',
            'ForgotPasswordController',
            'ResetPasswordController',
            'VerificationController',
            'HomeController',
            'Controller'
        ];
    }

    /**
     * Change permission for user.
     *
     * @return void
     */
    public function changeAccessStatusForController (): void
    {
        $id = request()->id;
        $controller = request()->controller;
        $accessStatus = request()->accessStatus;

        $user = User::find($id);

        if ($accessStatus) {
            $user->givePermissionTo('view ' . $controller);
        } else {
            $user->revokePermissionTo('view ' . $controller);
        }
    }
}
