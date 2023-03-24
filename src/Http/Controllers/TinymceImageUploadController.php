<?php

namespace Ndeblauw\BlueAdmin\Http\Controllers;

use Illuminate\Http\Request;

class TinymceImageUploadController extends Controller
{
    public function __invoke(Request $request)
    {
        $filename = $request->file('file')->getClientOriginalName();

        $path = $request->file('file')->storeAs('uploads', $filename, 'public');

        return response()->json(['location'=>"/storage/$path"]);
    }
}
