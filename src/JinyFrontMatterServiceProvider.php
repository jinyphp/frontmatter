<?php
namespace Jiny\FrontMatter;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

use Illuminate\Routing\Router;

class JinyFrontMatterServiceProvider extends ServiceProvider
{
    private $package = "jiny-frontmatter";
    public function boot()
    {
        // 모듈: 라우트 설정
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', $this->package);

        // 설정파일 복사
        // php artisan vendor:publish --tag=config
        $this->publishes([
            __DIR__.'/../config/setting.php' => config_path('jiny/frontmatter/setting.php'),
        ],'config');

        // 데이터베이스
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // 커멘드 명령
        if ($this->app->runningInConsole()) {
            $this->commands([
                // \Jiny\Admin\Console\Commands\userAdmin::class,
                // \Jiny\Admin\Console\Commands\userSuper::class
            ]);
        }

        

    }

    public function register()
    {
        /* 라이브와이어 컴포넌트 등록 */
        $this->app->afterResolving(BladeCompiler::class, function () {

            
        });

    }

}
