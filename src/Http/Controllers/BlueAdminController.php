<?php

namespace Ndeblauw\BlueAdmin\Http\Controllers;

use Ndeblauw\BlueAdmin\Models\Filepond;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// to check below
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlueAdminController extends Controller
{
    public function toggleStatesave($modelname)
    {
        $key = 'blueadmin-'.$modelname . '-index-statesave';

        if (session()->has($key)) {
            session()->forget($key);
        } else {
            session()->put($key, true);
        }

        return redirect()->back();
    }



    public function toggleShowDelete($modelname, Request $request)
    {
        $key = 'blueadmin-'.$modelname . '-index-show-delete';

        if ($request->session()->has($key)) {
            $request->session()->forget($key);
        } else {
            $request->session()->put($key, true);
        }

        return redirect()->back();
    }

    public function toggleOpenNewWindow($modelname, Request $request)
    {
        $key = 'blueadmin-'.$modelname . '-open-new-window';

        if ($request->session()->has($key)) {
            $request->session()->forget($key);
        } else {
            $request->session()->put($key, true);
        }

        return redirect()->back();
    }
}
