<?php

namespace Ndeblauw\BlueAdmin\View\Components\Adminlayout;

use Illuminate\Http\Request;
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
        foreach ($this->segments as $segment) {
            switch ($segment) {
                case 'admin': $title = 'Admin'; break;
                case 'locations': $title = 'Locaties'; break;
                case 'seasons': $title = 'Seizoenen'; break;
                case 'activitytypes': $title = 'Activiteitstypes'; break;
                case 'organisers': $title = 'Organisatoren'; break;

                case 'activities': $title = 'Activiteiten'; break;

                case 'schools': $title = 'Scholen'; break;
                case 'users': $title = 'Gebruikers'; break;

                case 'pages': $title = 'Infopagina\'s'; break;

                case 'reservations': $title = 'Reservaties'; break;
                case 'reservations-by-activity': $title = 'Reservaties per activiteit'; break;
                default: $title = 'UNKNOWN'; break;
            }

            if ($title == 'UNKNOWN' && is_numeric($segment)) {
                continue;
            }

            $trail[] = (object) ['title' => $title, 'url' => $prepend.$segment];
            $prepend .= $segment.'/';
        }

        return view('BlueAdminLayout::admin-breadcrumbs')->with('trail', $trail);
    }
}
