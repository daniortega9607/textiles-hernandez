<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::select('*');
        if (isset($request->search)) {
            $query->where('name','like','%'.$request->search.'%')
            ->orWhere('email','like','%'.$request->search.'%');
        }
        $query->orderBy('name');
        if (isset($request->paginate)) {
            $paginate = $request->paginate;
            return response()->json($query->paginate($paginate),200);
        }
        return response()->json($query->get(),200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
            'user_type' => 'required',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        
        $data = $request->only(['name', 'email', 'password','user_type']);
        $data['password'] = bcrypt($data['password']);

        $res = User::create($data);

        $permissions = $request->permissions;
        if(count($permissions) ) {
            foreach ($permissions as $key => $value) {
                $permissions[$key]['editor_id'] = $res->id;
            }
            $res->user_permissions()->createMany($permissions);
        }

        return response()->json([
            'status' => (bool) $res,
            'data' => $res,
            'message' => $res ? 'Item Created!' : 'Error Creating Item',
        ]);
    }
    
    public function login(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];

        if (Auth::attempt($request->only(['email', 'password']))) {
            $user = User::with(['user_permissions.permission'])->find(Auth::user()->id);
            $scopes = [];
            foreach ($user->user_permissions as $permission) {
                $scopes[] = $permission->permission->permission;
            }
            $status = 200;
            $response = [
                'user' => $user,
                'token' => Auth::user()->createToken('app', $scopes)->accessToken,
            ];
        }

        return response()->json($response, $status);
    }

    public function update(Request $request, User $user)
    {
        $status = $user->update(
            $request->only(['name','email','user_type','customer_id'])
        );

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Item Updated!' : 'Error Updating Item'
        ]);
    }
    
    public function settings(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }
        
        $data = $request->only(['name','email']);

        if (isset($request->n_password)){
            $validator = Validator::make($request->all(), [
                'password' => 'required',
                'n_password' => 'required|min:6',
                'c_password' => 'required|same:n_password',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            $status = 401;
            $response = ['error' => ['password'=>[['La contraseña no coincide']]]];
            if (Auth::guard('web')->attempt($request->only(['email', 'password']))) {
                $data['password'] = bcrypt($request->n_password);
            }
            else return response()->json($response, $status);
        }
        
        $status = $user->update($data);

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Item Updated!' : 'Error Updating Item'
        ]);
    }

    public function show(User $user)
    {
        return response()->json(User::with(['user_permissions','customer'])->find($user->id));
    }
    
    public function destroy(User $user)
    {
        $status = $user->delete();

        return response()->json([
            'status' => $status,
            'message' => $status ? 'Item Deleted!' : 'Error Deleting Item'
        ]);
    }
}
