<?php

namespace App\Providers;
use App\Post;
use Illuminate\Support\ServiceProvider;
use Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPostPolicies();

        Gate::define('admin-only', function ($user) {
            if($user->is_admin == 1)
            {
                return true;
            }
            return false;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }


    public function registerPostPolicies()
    {
        // dd('registerPostPolicies');
        Gate::define('create-post', function ($user) {
            return $user->hasAccess(['create-post']);
        });
        Gate::define('update-post', function ($user, Post $post) {
            // dd($user);
            // dd($post);
            // dd($user->hasAccess(['update-post']));
            // dd($user->id == $post->user_id);
            return $user->hasAccess(['update-post']) or $user->id == $post->user_id;
        });
        Gate::define('publish-post', function ($user) {
            return $user->hasAccess(['publish-post']);
        });
        Gate::define('see-all-drafts', function ($user) {
            return $user->inRole('editor');
        });



    }


}
