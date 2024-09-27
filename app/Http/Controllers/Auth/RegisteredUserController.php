<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;
class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
public function changeImage(request $request,int $id)
{
    $user=User::find($id);
    $image_data=$request->file('image');
    if ($image_data == null) {
        $file_path = $user->image;

    } else {
        $file_Name = $image_data->getClientOriginalName();
        $location = public_path() . '/users';
        $image_data->move($location, $file_Name);
        $file_path =  '/users/' . $file_Name;
    }
$user->image=$file_path;
    $user->save();
    return redirect()->back();
    if ($user->image != 'users/fake.jpeg'){
$old_image= public_path().'/'.$user->image;
unlink($old_image);
    }


}


    public function __construct(){
        $this->middleware('auth');

    }

    public function index()
    {
$users = User::all();
return view('auth.users', compact('users'));
    }
    public function create(): View
    {
   $Rule=Rule::all();
        return view('auth.register',compact('Rule'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'image' => ['file', 'mimes:jpeg,jpg,png', 'max:2048'],
            'rule_id' => ['required'],
        ]);

        $image_data=$request->file('image');
        if ($image_data == null) {
            $file_path = '/users/fake.jpeg';

        } else {

            //delete old


            $file_Name = $image_data->getClientOriginalName();
            $location = public_path() . '/users';
            $image_data->move($location, $file_Name);
            $file_path =  '/users/' . $file_Name;
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
'image' => $file_path,
            'rule_id'=>$request->rule_id
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect('dashboard');
    }
}
