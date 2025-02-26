<?php

namespace Ndeblauw\BlueAdmin;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Ndeblauw\BlueAdmin\Livewire\RteEditor;

class BlueAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->checkIfConfigSettingsAreCorrect();

        Blade::directive('bind', function ($bind) {
            return '<?php app(Ndeblauw\BlueAdmin\FormDataBinder::class)->bind(' .$bind.'); ?>';
        });

        Blade::directive('endbind', function () {
            return '<?php app(Ndeblauw\BlueAdmin\FormDataBinder::class)->pop(); ?>';
        });

        // Path to the resources
        $this->loadViewsFrom(__DIR__.'/../resources/views/components/formelements', 'BlueAdminFormelements');
        $this->loadViewsFrom(__DIR__.'/../resources/views/components/adminlayout', 'BlueAdminLayout');
        $this->loadViewsFrom(__DIR__.'/../resources/views/components/adminui', 'BlueAdminUi');

        $this->loadViewsFrom(__DIR__.'/../resources/views/layouts', 'BlueAdminLayouts');
        $this->loadViewsFrom(__DIR__.'/../resources/views/generic', 'BlueAdminGeneric');
        $this->loadViewsFrom(__DIR__.'/../resources/views/livewire', 'BlueAdminLivewire');


        // Load the auxiliary routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Basic building blocks for blueadmin backend
        Blade::component('ba-admin-layout', View\Components\Adminlayout\AdminLayout::class);
        Blade::component('ba-admin-sidebar', View\Components\Adminlayout\AdminSidebar::class);
        Blade::component('ba-admin-topbar', View\Components\Adminlayout\AdminTopbar::class);
        Blade::component('ba-admin-breadcrumbs', View\Components\Adminlayout\AdminBreadcrumbs::class);

        // Basic building blocks for blueadmin UI
        Blade::component('ba-admin-button', View\Components\Adminui\AdminButton::class);
        Blade::component('ba-button', View\Components\Adminui\Button::class);
        Blade::component('ba-delete-button', View\Components\Adminui\DeleteButton::class);
        Blade::component('ba-show-info', View\Components\Adminui\ShowInfo::class);

        // Basic building blocks for admin forms
        Blade::component('ba-hidden', View\Components\Formelements\Hidden::class);
        Blade::component('ba-text', View\Components\Formelements\Text::class);
        Blade::component('ba-textarea', View\Components\Formelements\Textarea::class);
        Blade::component('ba-boolean', View\Components\Formelements\Boolean::class);
        Blade::component('ba-datepicker', View\Components\Formelements\Datepicker::class);
        Blade::component('ba-select', View\Components\Formelements\Select::class);
        Blade::component('ba-select-searchbox', View\Components\Formelements\SelectWithSearchBox::class);
        Blade::component('ba-radiobuttons', View\Components\Formelements\Radiobuttons::class);
        Blade::component('ba-checkboxes', View\Components\Formelements\Checkboxes::class);
        Blade::component('ba-mediafile', View\Components\Formelements\FilepondUpload::class);
        Blade::component('ba-tagselect', View\Components\Formelements\TagSelect::class);
        Blade::component('ba-tinymceimage', View\Components\Formelements\Tinymceimage::class);

        // Relationship building blocks
        Blade::component('ba-belongsto', View\Components\Formelements\BelongsTo::class);

        // Miscellaneous building blocks
        Blade::component('ba-divider', View\Components\Formelements\Divider::class);
        Blade::component('ba-info', View\Components\Formelements\Info::class);


        // FluxLayout building blocks
        Blade::component('ba-fluxadmin-header', View\Layouts\FluxAdmin\Header::class);

        // Livewire components
        Livewire::component('rte-editor', RteEditor::class);



        /*
         * Optional methods to load your package assets
         */


        if ($this->app->runningInConsole()) {
            // Publishing the configuration file
            $this->publishes([__DIR__ . '/../config/config.php' => config_path('blue-admin.php'),], 'config');

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/blue-admin'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/blue-admin'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/blue-admin'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->app->singleton(FormDataBinder::class, fn () => new FormDataBinder);


        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'blue-admin');

        // Register the main class to use with the facade
        $this->app->singleton('blue-admin', function () {
            return new BlueAdmin;
        });
    }

    private function checkIfConfigSettingsAreCorrect()
    {
        if(config('blue-admin.flux-layout', false)) {
            if(!config('blue-admin.livewire_v3',false)) {
                abort(400, 'Livewire v3 needs to be supported');
            }
            if(!config('blue-admin.vite',false)) {
                abort(400, 'Vite needs to be supported');
            }
            if(!config('blue-admin.flux',false)) {
                abort(400, 'Flux needs to be supported');
            }
        }

    }
}
