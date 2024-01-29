<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:authenticate.user.index')->only('index');
        $this->middleware('can:authenticate.user.create')->only('create');
        $this->middleware('can:authenticate.user.store')->only('store');
        $this->middleware('can:authenticate.user.edit')->only('edit');
        $this->middleware('can:authenticate.user.update')->only('update');
        $this->middleware('can:authenticate.user.disable')->only('disable');
        $this->middleware('can:authenticate.user.setpass')->only('setpass');
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::where('status', true)->get();
        return view('authenticate.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('authenticate.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ]);

        $user = new User();
        $user->name =$request->name;
        $user->email =$request->email;
        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->route('authenticate.user.index')->with('info','El usuario se creó con éxito');
    }

    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('authenticate.user.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', "unique:users,email,$user->id"],
        ]);
        $user->roles()->sync($request->roles);
        $user->update($request->all());

        return redirect()->route('authenticate.user.index')->with('info','El usuario se actualizó con éxito');
    }

    public function disable(User $user){
        $user->status = false;
        $user->update();

        return redirect()->route('authenticate.user.index')->with('info','El usuario se eliminó con éxito');
    }

    public function setpass(User $user){
        $user->password = Hash::make('cuajone19');
        $user->update();

        return redirect()->route('authenticate.user.index')->with('info','Se reestablecio la contraseña del usuario con éxito');
    }

    public function profile()
    {
        return view('authenticate.user.profile');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return redirect()->route('authenticate.partner.index')->with('info','Esta función no está habilitada');
        
    }
}
