<?php

namespace Ndeblauw\BlueAdmin;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BlueAdminServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
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
        $this->loadViewsFrom(__DIR__.'/../resources/views/generic', 'BlueAdminGeneric');

        // Load the auxiliary routes
        $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Basic building blocks for blueadmin backend
        Blade::component('ba-admin-layout', View\Components\Adminlayout\AdminLayout::class);
        Blade::component('ba-admin-sidebar', View\Components\Adminlayout\AdminSidebar::class);
        Blade::component('ba-admin-topbar', View\Components\Adminlayout\AdminTopbar::class);
        Blade::component('ba-admin-breadcrumbs', View\Components\Adminlayout\AdminBreadcrumbs::class);

        // Basic building blocks for blueadmin UI
        Blade::component('ba-admin-button', View\Components\Adminui\AdminButton::class);
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

        // Relationship building blocks
        Blade::component('ba-belongsto', View\Components\Formelements\BelongsTo::class);

        // Miscellaneous building blocks
        Blade::component('ba-divider', View\Components\Formelements\Divider::class);
        Blade::component('ba-info', View\Components\Formelements\Info::class);


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
}
