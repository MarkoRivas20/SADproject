<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Laravel\Jetstream\Jetstream;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('authenticate.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('authenticate.user.edit', compact('user'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return redirect()->route('authenticate.partner.index')->with('info','Esta función no está habilitada');
        
    }
}
