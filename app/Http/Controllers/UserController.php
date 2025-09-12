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
        $roles = Role::pluck('name', 'id')->all();

        $lastUser = User::latest('id')->first();
        $nextEmployeeNumber = $lastUser ? $lastUser->id + 1 : 1;

        return view('users.create', compact('roles', 'nextEmployeeNumber'));
    }

    // public function store(Request $request): RedirectResponse
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'username' => 'required|string|max:50|unique:users,username',
    //         'email' => 'required|email|unique:users,email',
    //         'contact_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
    //         'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'birthdate' => 'nullable|date|before:today',
    //         'password' => 'required|same:confirm-password',
    //         'roles' => 'required'
    //     ]);

    //     $input = $request->all();
    //     $input['password'] = Hash::make($input['password']);

    //     if ($request->hasFile('user_photo'))
    //     {
    //         $image = $request->file('user_photo');
    //         $image_name = uniqid().".".$image->getClientOriginalExtension();
    //         $destination_path = public_path('uploads/users');
    //         if (!file_exists($destination_path))
    //         {
    //             mkdir($destination_path, 0755, true);
    //         }
    //         if (file_exists($destination_path))
    //         {
    //             $image->move($destination_path, $image_name);
    //         }
    //     }
    //     $input['user_photo'] = $image_name;

    //     $user = User::create($input);
    //     $user->assignRole($request->input('roles'));


    //     return redirect()->route('users.index')
    //         ->with('success', 'User created successfully');
    // }
    public function store(Request $request)
    {
        // -------------------- Validation --------------------
        $request->validate([
            // Basic info
            'username' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'contact_number_1' => 'nullable|string|max:15',
            'contact_number_2' => 'nullable|string|max:15',
            'joining_date' => 'required|date',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_photo_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_address_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employee_gender' => 'required|in:1,2',

            // ============ INSURANCE ============
            'insurance' => 'nullable|in:1,2',
            'insurance_name' => 'required_if:insurance,2|nullable|string|max:255',
            'insurance_policy_copy' => 'required_if:insurance,2|file|mimes:pdf,jpg,png',
            'insurance_issue_date' => 'required_if:insurance,2|nullable|date',
            'insurance_valid_date' => 'required_if:insurance,2|nullable|date',

            // ============ NOMINEE ============
            'nominee' => 'nullable|in:1,2',
            'nominee_name' => 'required_if:nominee,2|nullable|string|max:255',
            'nominee_mobile_number' => 'required_if:nominee,2|nullable|string|max:15',
            'nominee_photo_id' => 'required_if:nominee,2|nullable|file|mimes:jpg,png,jpeg',
            'nominee_address_proof' => 'required_if:nominee,2|nullable|file|mimes:jpg,png,jpeg',
            'nominee_gender' => 'required_if:nominee,2|nullable|in:1,2',
            'nominee_birthdate' => 'required_if:nominee,2|nullable|date',

            // ============ USER TYPE / SALARY ============
            'user_type' => 'required|exists:roles,id',
            'salary' => 'nullable|numeric',
            'licence' => 'nullable|file|mimes:pdf,jpg,png,jpeg',

            // ============ BANK ============
            'bank' => 'required|in:1,2',
            'bank_proof' => 'required_if:bank,2|file|mimes:pdf,jpg,png,jpeg',

            // ============ COURT ============
            'court' => 'required|in:1,2',
            'court_case_file.*' => 'required_if:court,2|file|mimes:pdf,jpg,png,jpeg',
            'court_case_close_file.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg', // if needed make this also required_if

            // ============ NOTE ============
            'note' => 'nullable|string|max:1000',
        ]);

        // -------------------- Prepare User Data --------------------
        $data = $request->except([
            'user_photo', 'user_photo_id', 'user_address_proof', 'insurance_policy_copy',
            'nominee_photo_id', 'nominee_address_proof', 'licence', 'bank_proof',
            'court_case_file', 'court_case_close_file'
        ]);

        $data['name'] = $request->input('username');

        if (empty($data['email'])) {
            $data['email'] = strtolower($request->username) . '@gmail.com';
        }

        if (empty($data['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make(\Str::random(10));
        }

        // -------------------- Create User --------------------
        $user = \App\Models\User::create($data);

        // -------------------- Prepare User Folder Structure --------------------
        $userFolder = 'uploads/users/user_' . $user->id;

        // Subfolders mapping
        $subFolders = [
            'bank',
            'nominee',
            'insurance',
            'court_case',
            'court_case_close',
        ];

        // Create main folder and subfolders
        if (!file_exists(public_path($userFolder))) {
            mkdir(public_path($userFolder), 0755, true);
            foreach ($subFolders as $sub) {
                mkdir(public_path("$userFolder/$sub"), 0755, true);
            }
        }

        // -------------------- File Upload Handling --------------------
        // Map of files and their target subfolders
        $fileMap = [
            'user_photo' => '', // main folder
            'user_photo_id' => '', // main folder
            'user_address_proof' => '', // main folder
            'insurance_policy_copy' => 'insurance',
            'nominee_photo_id' => 'nominee',
            'nominee_address_proof' => 'nominee',
            'licence' => '', // main folder
            'bank_proof' => 'bank',
        ];

        foreach ($fileMap as $file => $subFolder) {
            if ($request->hasFile($file)) {
                $filename = time() . '_' . $request->file($file)->getClientOriginalName();
                $path = $subFolder ? "$userFolder/$subFolder" : $userFolder;
                $request->file($file)->move(public_path($path), $filename);
                $data[$file] = "$path/$filename";
            }
        }

        // Handle multiple court case files
        $courtFiles = [];
        if ($request->hasFile('court_case_file')) {
            foreach ($request->file('court_case_file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("$userFolder/court_case"), $filename);
                $courtFiles[] = "$userFolder/court_case/$filename";
            }
        }
        $data['court_case_file'] = json_encode($courtFiles);

        $courtCloseFiles = [];
        if ($request->hasFile('court_case_close_file')) {
            foreach ($request->file('court_case_close_file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("$userFolder/court_case_close"), $filename);
                $courtCloseFiles[] = "$userFolder/court_case_close/$filename";
            }
        }
        $data['court_case_close_file'] = json_encode($courtCloseFiles);

        // -------------------- Update User with File Paths --------------------
        $user->update($data);

        // -------------------- Redirect --------------------
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }



    public function show($id): View
    {
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    public function edit($id): View
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'id')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        return view('users.edit', compact('user', 'roles', 'userRole'));
    }

    // public function update(Request $request, $id): RedirectResponse
    // {
    //     $this->validate($request, [
    //         'name' => 'required',
    //         'username' => 'required|string|max:50|unique:users,username,' . $id,
    //         'email' => 'required|email|unique:users,email,' . $id,
    //         'contact_number' => 'nullable|string|max:20|regex:/^(?:\+91[-\s]?)?[6-9]\d{9}$/',
    //         'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'birthdate' => 'nullable|date|before:today',
    //         'password' => 'same:confirm-password',
    //         'roles' => 'required'
    //     ]);
    
    //     $input = $request->all();
    
    //     if (!empty($input['password'])) {
    //         $input['password'] = Hash::make($input['password']);
    //     } else {
    //         $input = Arr::except($input, ['password']);
    //     }
        
    //     $user = User::findOrFail($id);

    //     if($request->hasFile('user_photo'))
    //     {
    //         if (isset($user->user_photo))
    //         {
    //             $destination_path = public_path('uploads/users/'.$user->user_photo);
    //             unlink($destination_path);
    //         }
            
    //         $image = $request->file('user_photo');
    //         $image_name = uniqid().".".$image->getClientOriginalExtension();
    //         $destination_path = public_path('uploads/users/');
    //         if (!file_exists($destination_path))
    //         {
    //             mkdir($destination_path, 0755, true);
    //         }
    //         if (file_exists($destination_path))
    //         {
    //             $image->move($destination_path, $image_name);
    //         }
    //         $input['user_photo'] = $image_name;
    //     }                

    //     $user->update($input);
    
    //     // Sync roles
    //     DB::table('model_has_roles')->where('model_id', $id)->delete();
    //     $user->assignRole($request->input('roles'));


    //     return redirect()->route('users.index')
    //         ->with('success', 'User updated successfully');
    // }
    public function update(Request $request, $id)
    {
        $user = \App\Models\User::findOrFail($id);

        // -------------------- Validation --------------------
        $request->validate([
            'username' => 'required|string|max:255',
            'birthdate' => 'required|date',
            'contact_number_1' => 'nullable|string|max:15',
            'contact_number_2' => 'nullable|string|max:15',
            'joining_date' => 'required|date',
            'user_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_photo_id' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'user_address_proof' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'employee_gender' => 'required|in:1,2',
            'insurance' => 'required|in:1,2',
            'insurance_name' => 'nullable|string|max:255',
            'insurance_policy_copy' => 'nullable|file|mimes:pdf,jpg,png',
            'insurance_issue_date' => 'nullable|date',
            'insurance_valid_date' => 'nullable|date',
            'nominee' => 'required|in:1,2',
            'nominee_name' => 'nullable|string|max:255',
            'nominee_mobile_number' => 'nullable|string|max:15',
            'nominee_photo_id' => 'nullable|file|mimes:jpg,png,jpeg',
            'nominee_address_proof' => 'nullable|file|mimes:jpg,png,jpeg',
            'nominee_gender' => 'nullable|in:1,2',
            'nominee_birthdate' => 'nullable|date',
            'insurance_note' => 'nullable|string|max:500',
            'user_type' => 'required|exists:roles,id',
            'salary' => 'nullable|numeric',
            'licence' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'bank' => 'required|in:1,2',
            'bank_proof' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'court' => 'required|in:1,2',
            'court_case_file.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'court_case_close_file.*' => 'nullable|file|mimes:pdf,jpg,png,jpeg',
            'note' => 'nullable|string|max:1000',
        ]);

        // -------------------- Prepare user folder --------------------
        $userFolder = 'uploads/users/user_' . $user->id;
        $subFolders = ['bank', 'nominee', 'insurance', 'court_case', 'court_case_close'];

        if (!file_exists(public_path($userFolder))) {
            mkdir(public_path($userFolder), 0755, true);
            foreach ($subFolders as $sub) {
                mkdir(public_path("$userFolder/$sub"), 0755, true);
            }
        }

        $data = $request->except([
            'user_photo', 'user_photo_id', 'user_address_proof', 'insurance_policy_copy',
            'nominee_photo_id', 'nominee_address_proof', 'licence', 'bank_proof',
            'court_case_file', 'court_case_close_file'
        ]);

        // -------------------- Main files --------------------
        $mainFolderFiles = ['user_photo', 'user_photo_id'];
        foreach ($mainFolderFiles as $file) {
            if ($request->hasFile($file)) {
                // Delete old file if exists
                if (!empty($user->$file) && file_exists(public_path($user->$file))) {
                    unlink(public_path($user->$file));
                }
                $filename = time() . '_' . $request->file($file)->getClientOriginalName();
                $request->file($file)->move(public_path($userFolder), $filename);
                $data[$file] = "$userFolder/$filename";
            }
        }

        // -------------------- Subfolder files --------------------
        $fileMap = [
            'user_address_proof' => '',
            'insurance_policy_copy' => 'insurance',
            'nominee_photo_id' => 'nominee',
            'nominee_address_proof' => 'nominee',
            'licence' => '',
            'bank_proof' => 'bank',
        ];

        foreach ($fileMap as $file => $subFolder) {
            if ($request->hasFile($file)) {
                if (!empty($user->$file) && file_exists(public_path($user->$file))) {
                    unlink(public_path($user->$file));
                }
                $filename = time() . '_' . $request->file($file)->getClientOriginalName();
                $path = $subFolder ? "$userFolder/$subFolder" : $userFolder;
                $request->file($file)->move(public_path($path), $filename);
                $data[$file] = "$path/$filename";
            }
        }

        // -------------------- Court Case Files --------------------
        $courtFiles = json_decode($user->court_case_file, true) ?? [];
        if ($request->hasFile('court_case_file')) {
            foreach ($request->file('court_case_file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("$userFolder/court_case"), $filename);
                $courtFiles[] = "$userFolder/court_case/$filename";
            }
        }
        $data['court_case_file'] = json_encode($courtFiles);

        $courtCloseFiles = json_decode($user->court_case_close_file, true) ?? [];
        if ($request->hasFile('court_case_close_file')) {
            foreach ($request->file('court_case_close_file') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path("$userFolder/court_case_close"), $filename);
                $courtCloseFiles[] = "$userFolder/court_case_close/$filename";
            }
        }
        $data['court_case_close_file'] = json_encode($courtCloseFiles);

        // -------------------- Additional fields --------------------
        $data['name'] = $request->username;
        if (empty($data['email'])) {
            $data['email'] = strtolower($request->username) . '@gmail.com';
        }

        // -------------------- Update User --------------------
        $user->update($data);

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }



    // public function destroy($id): RedirectResponse
    // {
    //     $user = User::find($id);

    //     if ($user->user_photo)
    //     {
    //         $destination_path = public_path('uploads/users/').$user->user_photo;
    //         unlink($destination_path);
    //     }
    //     $user->delete();
        
    //     return redirect()->route('users.index')
    //         ->with('success', 'User deleted successfully');
    // }
    public function destroy($id)
    {
        $user = \App\Models\User::findOrFail($id);

        // -------------------- Delete user files --------------------
        $userFolder = public_path('uploads/users/user_' . $user->id);

        if (file_exists($userFolder)) {
            // Recursive delete function
            $this->deleteFolder($userFolder);
        }

        // -------------------- Delete user from database --------------------
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

    /**
     * Recursive folder delete
     */
    private function deleteFolder($folder)
    {
        $files = array_diff(scandir($folder), ['.', '..']);

        foreach ($files as $file) {
            $path = "$folder/$file";
            if (is_dir($path)) {
                $this->deleteFolder($path);
            } else {
                unlink($path);
            }
        }

        rmdir($folder);
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