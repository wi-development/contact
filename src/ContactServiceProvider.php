<?php

namespace WI\Contact;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;


#http://kaltencoder.com/2015/07/laravel-5-package-creation-tutorial-part-1/

#https://laracasts.com/discuss/channels/laravel/package-development-5

#composer dump-autoload
#php artisan clear-compiled
class ContactServiceProvider extends ServiceProvider
{
    
	
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    //protected $defer = true;
	
	/**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    //load from package
		//$this->loadViewsFrom(realpath(__DIR__.'/views/admin'), 'contact');

	    //load from package
	    //$this->loadViewsFrom(__DIR__.'/views/admin', 'contact');

	    //load from resource
	    //$this->loadViewsFrom(base_path() . '/resources/views/admin/contact', 'contact');


	    if (is_dir(base_path() . '/resources/views/admin/contact')) {
		    //load from resource
		    $this->loadViewsFrom(base_path() . '/resources/views/admin/contact', 'contact');
	    } else {
		    //load from package
		    $this->loadViewsFrom(__DIR__.'/views/admin', 'contact');
	    }



	    $this->setupRoutes($this->app->router);
		// this  for config
		$this->publishes([
				__DIR__.'/config/contact.php' => config_path('wi/contact.php'),
		],'wi-config');

	    $this->publishes([
		    __DIR__.'/views/admin' => base_path('resources/views/admin/contact')
	    ],'wi-view');


	    //php artisan vendor:publish --tag=wi-config
	    //https://laravel.com/docs/5.0/packages#public-assets
	    //php artisan vendor:publish --provider="Vendor\Providers\PackageServiceProvider" --tag="config"
    }
	
	
	/**
		 * Define the routes for the application.
		 *
		 * @param  \Illuminate\Routing\Router  $router
		 * @return void
		 */
		public function setupRoutes(Router $router)
		{
			//dd("asdf");
			$router->group(['namespace' => 'WI\Contact\Http\Controllers'], function($router)
			{
				require __DIR__.'/Http/routes.php';
			});
		}
	

    /**
     * Register the application services.
     *
	 * As mentioned previously, within the register method, 
	 * you should only bind things into the service container. 
	 * You should never attempt to register any event listeners, routes, 
	 * or any other piece of functionality within the register method. 
	 * Otherwise, you may accidently use a service that is provided by a service provider which has not loaded yet.
     * @return void
     */
    public function register()
    {
		//dd('asdf');
	//dc('asdf');
		$this->registerContact();
				config([
						'wi/config/contact.php',
				]);
    }
	
	private function registerContact()
	{

		$this->app->bind('contact',function($app){
			return new Contact($app);
		});
	}
}
