<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout()
    {
        $auth = auth('cus')->user();
        return view('home.checkout', compact('auth'));
    }

    public function history()
    {
        $auth = auth('cus')->user();
        return view('home.history', compact('auth'));
    }

    public function detail(Order $order)
    {
        $auth = auth('cus')->user();
        return view('home.detail', compact('auth', 'order'));
    }

    public function post_checkout(Request $request)
    {
        $auth = auth('cus')->user();
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'Please enter your name.',
            'email.required' => 'Please enter your email.',
            'email.email' => 'Please enter a valid email.',
            'phone.required' => 'Please enter your phone number.',
            'address.required' => 'Please enter your address.',
        ]);

        $data = $request->only('name', 'email', 'phone', 'address');
        $data['customer_id'] = $auth->id;

        if ($order = Order::create($data)) {
            $token = Str::random(40);
            foreach ($auth->carts as $cart) {
                $data1 = [
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'price' => $cart->price,
                    'quantity' => $cart->quantity,
                ];
                OrderDetail::create($data1);
            }
            $order->token = $token;
            $order->save();
            Mail::to($auth->email)->send(new OrderMail($order, $token));
            return redirect()->route('home.index')->with('success', 'Your order has been placed successfully.');
        };
        return redirect()->back()->with('error', 'Your order has not been placed.');
    }

    public function verify($token)
    {
        $order = Order::where('token', $token)->first();
        if ($order) {
            $order->token = null;
            $order->update(['status' => 1]);
            return redirect()->route('home.index')->with('success', 'Your order has been verify successfully.');
        } else {
            return redirect()->route('home.index')->with('error', 'Your order has not been verify.');
        }
    }
}
