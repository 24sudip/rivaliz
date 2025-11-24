<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Category;
use App\Models\CompanyInfo;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrapFour();
        $company = CompanyInfo::find(1);
        view()->share('company', $company);

        $categories = Category::where(['status' => 1])->get();
        view()->share('categories', $categories);

        $app_banner  = Advertisement::where('adcategory_id', 4)->first();
        view()->share('app_banner', $app_banner);

        $blogs = Blog::where('status', 1)->orderBy('id', 'DESC')->limit(5)->get();
        view()->share('blogs', $blogs);

        // Company Info
        // View::composer(['backend.layouts.master'], function($view){
        //     $view->with('companyinfo', CompanyInfo::latest()->first());
        // });
    }
}
