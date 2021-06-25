<?php

namespace Ndeblauw\BlueAdmin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserLoginAsController extends Controller
{
    public function loginAs($user)
    {
        $current_user_id = auth()->id();
        $user = User::findOrFail($user);

        auth()->login($user);
        session()->put('loginas', $current_user_id);

        return redirect()->back();
    }

    public function stopLoginAs()
    {
        $id = session()->get('loginas');
        $user = User::findOrFail($id);

        auth()->login($user);
        session()->forget('loginas');

        return redirect()->route('admin.users.index'); // TODO - add back route in session as well!
    }
}
