<?php namespace Beacon\Api\Core\Providers;

use Beacon\Api\Authentication\Services\OAuth2\Server\Verifier\PasswordGrant;
use Beacon\Api\Core\Repositories\PersonRepository;
use Beacon\Api\Core\Repositories\PersonRepositoryInterface;
use Beacon\Api\Core\Services\Fractal\Serializer;
use Illuminate\Support\ServiceProvider;
use League\Fractal\Manager as FractalManager;

class CoreServiceProvider extends ServiceProvider
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
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = base_path('resources/lang/modules/core');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'core');
        } else {
            $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'core');
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
            __DIR__ . '/../Config/config.php' => config_path('core.php'),
        ]);
        $this->mergeConfigFrom(
            __DIR__ . '/../Config/config.php', 'core'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FractalManager::class, function () {
            $manager = new FractalManager();
            $manager->setSerializer(new Serializer);
            $manager->parseIncludes($this->app['request']->get('includes', []));
            return $manager;
        });
        
        $this->app->bind(PersonRepositoryInterface::class, function () {
            return new PersonRepository($this->app['hash']);
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
