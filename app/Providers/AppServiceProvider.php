<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\Blogcategory;
use App\Models\Category;
use App\Models\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();

        Password::defaults(function () {
            $rule = Password::min(8);

            return $this->app->isProduction()
                ? $rule->letters()->mixedCase()->numbers()->symbols()->uncompromised()
                : $rule;
        });

        Relation::enforceMorphMap([
            'category' => Category::class,
            'menu' => Menu::class,
            'user' => User::class,
            'blogcategory' => Blogcategory::class,
            'blog' => Blog::class,
        ]);
    }
}
