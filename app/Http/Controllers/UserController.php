<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ChangPasswordUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\ViewUserRequest;
use App\ServiceController\UserServiceController;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use function Symfony\Component\HttpFoundation\has;


class UserController extends Controller
{
    public function Add(AddUserRequest $request, UserServiceController $controller)
    {
        try {
            $controller->store($request);
            return response()->json([
                'success' => 1,
                'msg' => \auth()->user()->createToken($request->ip())->plainTextToken,
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }

    public function Login(LoginUserRequest $request, UserServiceController $controller)
    {
        try {
            $controller->login($request);
            return response()->json([
                'success' => 0,
                'msg' => \auth()->user()->createToken($request->ip())->plainTextToken,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }

    public function Logout()
    {
        try {
            \auth()->user()->tokens()->delete();
            return response()->json([
                'success' => 1,
                'msg' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }

    public function ChangPassword(ChangPasswordUserRequest $request, UserServiceController $controller)
    {
        try {
            $controller->ChangPassword($request);
            return response()->json([
                'success' => 1,
                'msg' => "successfully",
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }

    public function Profile()
    {
        return response()->json([
            'success' => 1,
            'user' => \auth()->user(),
        ]);
    }

    public function View(ViewUserRequest $request, UserServiceController $controller)
    {
        try {
            $users = $controller->view($request);
            return response()->json([
                'success' => 1,
                'user' => $users,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),
            ]);
        }
    }

    public function addPermission(PermissionRequest $request, UserServiceController $controller)
    {
        try {
            $controller->addPermission($request);
            return response()->json([
                'success' => 1,
                'users' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),]);
        }
    }

    public function deletePermission(PermissionRequest $request, UserServiceController $controller)
    {
        try {
            $controller->deletePermission($request);
            return response()->json([
                'success' => 1,
                'users' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),]);
        }
    }

    public function editRole(PermissionRequest $request, UserServiceController $controller)
    {
        try {
            $controller->editRole($request);
            return response()->json([
                'success' => 1,
                'users' => 'successfully',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),]);
        }
    }

    public function viewPermission(PermissionRequest $request, UserServiceController $controller)
    {
        try {
             $p=$controller->viewPermission($request);
            return response()->json([
                'success' => 1,
                'users' => 'successfully',
                'Permission'=>$p,
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => 0,
                'msg' => $exception->getMessage(),]);
        }

    }

}
