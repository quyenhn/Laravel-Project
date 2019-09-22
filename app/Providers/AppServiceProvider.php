<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $repositories = [
            'backend\Admin\AdminRepositoryInterface'    => 'backend\Admin\AdminRepository',
            
          
        ];
        foreach ($repositories as $key=>$val){
            $this->app->bind("App\\Repositories\\$key", "App\\Repositories\\$val");
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      Schema::defaultStringLength(191);
      // Enable pagination
    if (!Collection::hasMacro('paginate')) 
    {

        Collection::macro('paginate', 
            function ($perPage = 15, $page = null, $options = []) 
            {
                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
                return (new LengthAwarePaginator(
                    $this->forPage($page, $perPage)->values()->all(), $this->count(), $perPage, $page, $options))
                ->withPath('');
            });
    }
    }

}
