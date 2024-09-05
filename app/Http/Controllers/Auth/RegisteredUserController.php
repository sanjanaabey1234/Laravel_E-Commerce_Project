<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailWelcome;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\District;
use App\Models\Driver;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        //get all districts
        $districts = District::all();


        return view('auth.register', ['districts' => $districts]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {


        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|in:Admin,Buyer,Seller,Driver',
            'district' => ['required', 'string', 'max:255'],

        ]);


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'district_id' => $request->district,
        ]);


        event(new Registered($user));
        Mail::to($user->email)->send(new EmailWelcome($user));

        Auth::login($user);

        switch ($user->role) {
            case 'Buyer':
                //find user id
                $userId = $user->id;

                $Buyer = Buyer::create([
                    'user_id' => $userId,
                    'buyer_name' => $request->name,
                    'district_id' => $request->district,

                ]);
                event(new Registered($Buyer));
                break;
            case 'Seller':
                //find user id
                $userId = $user->id;
                $Seller = Seller::create([
                    'user_id' => $userId,
                    'seller_name' => $request->name,
                    'district_id' => $request->district,

                ]);
                event(new Registered($Seller));
                break;
            case 'Driver':
                //find user id
                $userId = $user->id;
                $Driver = Driver::create([
                    'user_id' => $userId,
                    'driver_name' => $request->name,
                    'district_id' => $request->district,

                ]);
                event(new Registered($Driver));
                break;
            default:
                //find user id
                $userId = $user->id;
                Admin::create([
                    'admin_name' => $request->name,
                    'email' => $request->email,

                ]);
        }


        // Redirect based on role
        return $this->redirectBasedOnRole($user->role);
    }

    protected function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'Admin':
                return redirect()->route('admin.dashboard');
            case 'Buyer':
                return redirect()->route('dashboard');
            case 'Seller':
                return redirect()->route('seller.dashboard');
            case 'Driver':
                return redirect()->route('driver.dashboard');
            default:
                return redirect()->route('login');
        }
    }
}