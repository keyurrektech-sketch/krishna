<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $data = User::latest()->paginate(5);
        return view('users.index', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function create(): View
    {
        $roles = Role::pluck('name', 'name')->all();
        
        $lastUser = User::latest('id')->first();
        $nextId = $lastUser ? $lastUser->id + 1 : 1;

        return view('users.create', compact('roles', 'nextId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'contact_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthdate' => 'nullable|date|before:today',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        if ($request->hasFile('user_photo'))
        {
            $image = $request->file('user_photo');
            $image_name = uniqid().".".$image->getClientOriginalExtension();
            $destination_path = public_path('uploads/users');
            if (!file_exists($destination_path))
            {
                mkdir($destination_path, 0755, true);
            }
            if (file_exists($destination_path))
            {
                $image->move($destination_path, $image_name);
            }
        }
        $input['user_photo'] = $image_name;

        $user = User::create($input);
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'User created successfully');
    }

    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'username' => 'required|string|max:50|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'contact_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthdate' => 'nullable|date|before:today',
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
    
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, ['password']);
        }
        
        $user = User::findOrFail($id);

        if($request->hasFile('user_photo'))
        {
            if (isset($user->user_photo))
            {
                $destination_path = public_path('uploads/users/'.$user->user_photo);
                unlink($destination_path);
            }
            
            $image = $request->file('user_photo');
            $image_name = uniqid().".".$image->getClientOriginalExtension();
            $destination_path = public_path('uploads/users/');
            if (!file_exists($destination_path))
            {
                mkdir($destination_path, 0755, true);
            }
            if (file_exists($destination_path))
            {
                $image->move($destination_path, $image_name);
            }
            $input['user_photo'] = $image_name;
        }                

        $user->update($input);
    
        // Sync roles
        DB::table('model_has_roles')->where('model_id', $id)->delete();
        $user->assignRole($request->input('roles'));


        return redirect()->route('users.index')
            ->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $user = User::find($id);

        if ($user->user_photo)
        {
            $destination_path = public_path('uploads/users/').$user->user_photo;
            unlink($destination_path);
        }
        $user->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }

    // public function register(Request $request)
    // {
    //     $this->validate($request, [
    //         'username' => 'required|string|max:50|unique:users,username',
    //     ]);

    //     $username = trim($request->username);
    //     $password = \Illuminate\Support\Str::random(10);

    //     $user = User::create([
    //         'name' => $username,
    //         'username' => $username,
    //         'email' => 'temp_' . uniqid() . '@gmail.com',
    //         'password' => Hash::make($password),
    //     ]);

    //     $cleanUsername = preg_replace('/[^a-z0-9]/i', '', strtolower($username));
    //     $email = $cleanUsername . $user->id . '@gmail.com';
    //     $user->update(['email' => $email]);

    //     $defaultRole = 'admin';
    //     if (Role::where('name', $defaultRole)->exists()) {
    //         $user->assignRole($defaultRole);
    //     }

    //     $pdf = Pdf::loadView('users.pdf', [
    //         'username' => $username,
    //         'email'    => $email,
    //         'password' => $password,
    //         'created_at' => $user->created_at->format('d-m-Y H:i:s'),
    //     ]);

    //     return $pdf->download('User_Credentials.pdf');
    // }
}