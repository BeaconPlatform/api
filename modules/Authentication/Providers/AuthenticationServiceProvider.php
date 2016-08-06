<?php namespace Beacon\Api\Authentication\Providers;

use Beacon\Api\Authentication\Services\OAuth2\Server\Verifier\PasswordGrant;
use Beacon\Api\Core\Repositories\PersonRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/authentication');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'authentication');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'authentication');
        }
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('authentication.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'authentication'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = base_path('resources/views/modules/authentication');

        $sourcePath = __DIR__ . '/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/authentication';
        }, \Config::get('view.paths')), [$sourcePath]), 'authentication');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PasswordGrant::class, function () {
            return new PasswordGrant($this->app['validator'], $this->app[PersonRepositoryInterface::class]);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
