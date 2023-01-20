<?php
namespace App\ServiceController;


use App\Http\Requests\AddUserRequest;
use App\Http\Requests\ChangPasswordUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\PermissionRequest;
use App\Http\Requests\ViewUserRequest;
use App\Services\UserService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserServiceController{
    public function store(AddUserRequest $request)
    {
        $data = $request->except('uniqueId');
        $request->safe()->all();
        $data['password'] =Hash::make($data['password']);
        $data['uniqueId'] = Str::random(32);
        if (!(new UserService())->save($data)) {
            throw new Exception('the user not 2 save');
        }
        $role= Role::findByName('visitor');
        $user= (new UserService())->getFirst(["uniqueId"=>$data['uniqueId']]);
        $user->assignRole($role);
        Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password_confirmation'],
        ]);
    }
    public function login(LoginUserRequest $request){
        $data =$request->safe()->all();
        if (!Auth::attempt([
            'email' => $data['email'],
            'password' => $data['password'],
        ])) {
            throw new Exception('the user not login');
        }
    }
    public function ChangPassword(ChangPasswordUserRequest $request){
        $data =$request->safe()->all();
        $data['password'] = bcrypt($data['password']);
        $user = \auth()->user();
        if (password_verify($data['old_password'], $user['password'])) {
            if (!(new UserService())->update(['password' => $data['password']], ['uniqueId' => $user->uniqueId])) {
                throw new Exception('fild to updat');
            }
        } else {
            throw new Exception('wrong password');
        }
    }
    public function view(ViewUserRequest $request){
        $data =$request->safe()->all();
        $users=(new UserService())->getListQuery();
        if ($request->has('name')){
            $users=$users->where('name',$data['name']);
        }
        if ($request->has('email')){
            $users=$users->where('email',$data['email']);
        }
        if ($request->has('search')){
            $users=(new UserService())->getListQuery(['keyword'=>$data['search']]);
        }
        return $users->get();
    }
    public function addPermission(PermissionRequest $request){
            $data =$request->safe()->all();
            $permissionName=$data['permissionName'];
            if (!($user= (new UserService())->getFirst(["uniqueId"=>$data['uniqueId']]))) {
                throw new \Exception('the user not found');
            }
            Permission::query()->select('name')->where('name',$permissionName)->firstOrFail();
            $user->givePermissionTo($permissionName);
    }
    public function deletePermission(PermissionRequest $request){

            $data =$request->safe()->all();
            $permissionName=$data['permissionName'];
            if (!($user= (new UserService())->getFirst(["uniqueId"=>$data['uniqueId']]))) {
                throw new \Exception('the user not found');
            }
            if (!($user->revokePermissionTo($permissionName))){
                throw new \Exception('the permission is not remove ');
            }
    }
    public function editRole(PermissionRequest $request){

            $data =$request->safe()->all();
            $oldRoleName=$data['oldRoleName'];
            $newRole=$data['newRole'];
            $role=Role::query()->where("name",$newRole)->firstOrFail(['name']);
            if (!($user= (new UserService())->getFirst(["uniqueId"=>$data['uniqueId']]))) {
                throw new \Exception('the user not found');
            }

            if (!($user->removeRole($oldRoleName))){
                throw new \Exception('the Role is not remove ');
            }

            if (!( $user->assignRole($role->name))){
                throw new \Exception('the new role is not assign');
            }
    }
    public function viewPermission(PermissionRequest $request){
            $data =$request->safe()->all();
            $user= (new UserService())->getFirst(["uniqueId"=>$data['uniqueId']]);
            $namePermissions=$user->getAllPermissions();
            $p=[];
            foreach ($namePermissions as $i){
                $p[]= $i->name;
            }
            return $p;
    }
}

?>
