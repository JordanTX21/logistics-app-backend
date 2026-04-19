<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ModuleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadModuleRoutes();
    }

    private function loadModuleRoutes(): void
    {
        $modules = [
            base_path('src/Auth/routes.php'),
            base_path('src/Organization/routes.php'),
            base_path('src/Customer/routes.php'),
            base_path('src/Logistics/Order/routes.php'),
            base_path('src/Logistics/Payment/routes.php'),
        ];

        foreach ($modules as $routeFile) {
            if (file_exists($routeFile)) {
                $this->loadRoutesFrom($routeFile);
            }
        }
    }
}
