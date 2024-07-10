<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Console\ClientCommand;
use Laravel\Passport\Console\InstallCommand;
use Laravel\Passport\Console\KeysCommand;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       /*ADD THIS LINES*/
    $this->commands([
      InstallCommand::class,
      ClientCommand::class,
      KeysCommand::class,
  ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            Schema::defaultStringLength(191);

      $registrar = new \App\Routing\ResourceRegistrar($this->app['router']);

      $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
          return $registrar;
      });
      $this->app->bind(GeneratePdfService::class);
      $this->app->bind(PaymentMethodService::class);
      $this->app->bind(ProccessCodesService::class);
      $this->app->bind(SendingMessagesService::class);
      $this->app->bind(SendingNotificationsService::class);

    }
}
