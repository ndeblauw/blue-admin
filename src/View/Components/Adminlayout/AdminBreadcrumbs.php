<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminlayout;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class AdminBreadcrumbs extends Component
{
    private $segments;

    public function __construct(Request $request)
    {
        $this->segments = $request->segments();
    }

    public function render()
    {
        $trail = [];
        $prepend = '';

        foreach ($this->segments as $key => $segment) {

            // Determine name to display
            $title = ucfirst($segment);

            // When a model item is selected, fetch its title
            if(is_numeric($segment)) {
                $class_name = 'App\\Models\\' . Str::studly(Str::singular($this->segments[$key-1]));

                if(class_exists($class_name)) {
                    $model = $class_name::find($segment);
                    $title = Str::limit($model->title, 10);
                }
            }

            $trail[] = (object) ['title' => $title, 'url' => $prepend.$segment];
            $prepend .= $segment.'/';
        }

        return view('BlueAdminLayout::admin-breadcrumbs')->with('trail', $trail);
    }
}
