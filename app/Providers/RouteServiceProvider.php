<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    //protected $namespace = 'App\\Http\\Controllers';
    protected $namespace_admission = 'App\\Http\\Controllers\\Admission';
    protected $namespace_api = 'App\\Http\\Controllers\\Api';
    protected $namespace_exam = 'App\\Http\\Controllers\\Exam';
    protected $namespace_graduate = 'App\\Http\\Controllers\\Graduate';
    protected $namespace_portal = 'App\\Http\\Controllers\\Portal';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace_api)
                ->group(base_path('routes/api.php'));

            Route::prefix('ppdb')
                ->middleware('web')
                ->namespace($this->namespace_admission)
                ->group(base_path('routes/admission.php'));

            Route::prefix('ujian')
                ->middleware('web')
                ->namespace($this->namespace_exam)
                ->group(base_path('routes/exam.php'));

            Route::prefix('kelulusan')
                ->middleware('web')
                ->namespace($this->namespace_graduate)
                ->group(base_path('routes/graduate.php'));

            Route::middleware('web')
                ->namespace($this->namespace_portal)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}
