<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Mail\VerifyAccount;
use App\Models\Customer;
use App\Models\CustomerResetToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AccountController extends Controller
{
    public function login()
    {
        return view('account.login');
    }

    public function favorite()
    {
        $favorites = auth('cus')->user()->favorites;
        return view('account.favorite', compact('favorites'));
    }

    public function logout()
    {
        auth('cus')->logout();
        return redirect()->route('account.login')->with('success', 'Logout successfully.');
    }

    public function check_login(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:customers,email',
            'password' => 'required',
        ], []);

        $data = $req->only('email', 'password');

        $check = auth('cus')->attempt($data);

        if ($check) {
            if (auth('cus')->user()->email_verified_at == NULL) {
                auth('cus')->logout();
                return redirect()->route('account.login')->with('error', 'Account not verified.');
            }
            return redirect()->route('home.index')->with('success', 'Login successfully.');
        }
        return redirect()->back()->with('error', 'Login failed.');
    }

    public function register()
    {
        return view('account.register');
    }

    public function check_register(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|min:6|max:255|unique:customers,email',
            'phone' => 'required|numeric',
            'address' => 'required',
            'gender' => 'required',
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ], [
            'name.required' => 'Please enter your name',
            'name.min' => 'Name must be at least 6 characters',
            'name.max' => 'Name must be at most 255 characters',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'email.min' => 'Email must be at least 6 characters',
            'email.max' => 'Email must be at most 255 characters',
            'email.unique' => 'Email already exists',
            'phone.required' => 'Please enter your phone',
            'phone.numeric' => 'Phone must be a number',
            'address.required' => 'Please enter your address',
            'gender.required' => 'Please select your gender',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 255 characters',
            'confirm_password.required' => 'Please enter your confirm password',
            'confirm_password.same' => 'Confirm password does not match',
        ]);

        $data = $req->only('name', 'email', 'phone', 'address', 'gender');
        $data['password'] = bcrypt($req->password);
        if ($acc = Customer::create($data)) {
            Mail::to($acc->email)->send(new VerifyAccount($acc));
            return redirect()->route('account.login')->with('success', 'Register successfully. Please check your email to verify account.');
        }
        return redirect()->back()->with('error', 'Register failed.');
    }

    public function verify($email)
    {
        $acc = Customer::where('email', $email)->whereNULL('email_verified_at')->firstOrFail();
        Customer::where('email', $email)->update(['email_verified_at' => now()]);
        return redirect()->route('account.login')->with('success', 'Verify successfully.');
    }

    public function change_password()
    {
        return view('account.change_password');
    }

    public function check_change_password(Request $req)
    {
        $auth = auth('cus')->user();
        $req->validate([
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) use ($auth) {
                    if (!Hash::check($value, $auth->password)) {
                        $fail('Old password is incorrect.');
                    }
                },
            ],
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $data['password'] = bcrypt($req->password);
        $check = $auth->update($data);
        if ($check) {
            auth('cus')->logout();
            return redirect()->route('account.change_password')->with('success', 'Change password successfully.');
        }
        return redirect()->back()->with('error', 'Change password failed.');
    }

    public function forgot_password()
    {
        return view('account.forgot_password');
    }

    public function check_forgot_password(Request $req)
    {
        $req->validate([
            'email' => 'required|exists:customers,email',
        ]);

        $customer = Customer::where('email', $req->email)->first();

        $token = Str::random(60);
        $tokenData = [
            'email' => $req->email,
            'token' => $token,
        ];

        if (CustomerResetToken::create($tokenData)) {
            Mail::to($req->email)->send(new ForgotPassword($customer, $token));
            return redirect()->back()->with('success', 'Reset password successfully. Please check your email.');
        }
        return redirect()->back()->with('error', 'Reset password failed.');
    }

    public function profile()
    {
        $auth = auth('cus')->user();
        return view('account.profile', compact('auth'));
    }

    public function check_profile(Request $req)
    {
        $auth = auth('cus')->user();
        $req->validate([
            'name' => 'required',
            'email' => 'required|email|min:6|max:255|unique:customers,email,' . $auth->id,
            'password' => [
                'required',
                'min:6',
                'max:255',
                function ($attribute, $value, $fail) use ($auth) {
                    if (!Hash::check($value, $auth->password)) {
                        $fail('Password is incorrect.');
                    }
                },
            ],
        ], [
            'name.required' => 'Please enter your name',
            'email.required' => 'Please enter your email',
            'email.email' => 'Please enter a valid email',
            'email.min' => 'Email must be at least 6 characters',
            'email.max' => 'Email must be at most 255 characters',
            'email.unique' => 'Email already exists',
            'password.required' => 'Please enter your password',
            'password.min' => 'Password must be at least 6 characters',
            'password.max' => 'Password must be at most 255 characters',
        ]);

        $data = $req->only('name', 'email', 'password');

        $check = $auth->update($data);
        if ($check) {
            return redirect()->route('account.profile')->with('success', 'Update profile successfully.');
        }
        return redirect()->back()->with('error', 'Update profile failed.');
    }

    public function reset_password($token)
    {
        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        return view('account.reset_password');
    }

    public function check_reset_password($token)
    {
        request()->validate([
            'password' => 'required|min:6|max:255',
            'confirm_password' => 'required|same:password',
        ]);

        $tokenData = CustomerResetToken::where('token', $token)->firstOrFail();
        $customer = Customer::where('email', $tokenData->email)->firstOrFail();

        $data = [
            'password' => bcrypt(request()->password),
        ];

        $check = $customer->update($data);
        if ($check) {
            return redirect()->route('account.login')->with('success', 'Reset password successfully.');
        }
        return redirect()->back()->with('error', 'Reset password failed.');
    }
}
