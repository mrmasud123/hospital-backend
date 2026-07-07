<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';
    protected $description = 'Create a new module structure';

    public function handle()
    {
        $module = $this->argument('name');

        $basePath = app_path("Modules/{$module}");

        $folders = [
            'Controllers',
            'Services',
            'Repositories',
            'Interfaces',
            'Models',
            'DTO',
            'Requests'
        ];

        foreach ($folders as $folder) {
            File::makeDirectory("{$basePath}/{$folder}", 0755, true, true);
        }

        // Create routes file
        File::put("{$basePath}/routes.php", "<?php\n\nuse Illuminate\Support\Facades\Route;\n\nRoute::prefix('" . strtolower($module) . "')->group(function () {\n    // routes here\n});");

        $this->info("Module {$module} created successfully.");
    }
}
