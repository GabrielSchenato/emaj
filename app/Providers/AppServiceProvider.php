<?php

namespace Emaj\Providers;

use Emaj\Entities\Cadastro\Usuario;
use Emaj\Observers\Cadastro\UsuarioObserver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Usuario::observe(UsuarioObserver::class);
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (array_wrap($attributes) as $attribute) {
                    $query->when(
                            str_contains($attribute, '.'),
                            function (Builder $query) use ($attribute, $searchTerm) {
                        [$relationName, $relationAttribute] = explode('.', $attribute);

                        $query->orWhereHas($relationName, function (Builder $query) use ($relationAttribute, $searchTerm) {
                            $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                        });
                    },
                            function (Builder $query) use ($attribute, $searchTerm) {                        
                        if($attribute == 'created_at' || $attribute == 'updated_at'){
                            //$searchTerm = '12/05/2019 18:50:55';
                            //$searchTerm = \Carbon\Carbon::createFromFormat('d/m/Y H:i:s', $searchTerm);
                            //dd($searchTerm);
                            //$query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }else{
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                        
                    }
                    );
                }
            });

            return $this;
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);
    }

}
