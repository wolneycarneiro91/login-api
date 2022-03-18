<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Artisan;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CrudGeneratorCommand extends Command
{
    protected $signature = 'crud:generator
    {name : Class (singular) for example User} {--fields=*}';

    protected $description = 'Create crud operations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');        
        $fields = $this->option('fields');
        $this->controller($name);
        $this->model($name, $fields);
        $this->request($name);        
        $nameController = $name . "Controller";        
        File::append(base_path('routes/api.php'), "\n \n Route::apiResource('" . Str::plural(strtolower($name)) . "'" . str_replace(".", "", ",App\Http\Controllers\.$nameController.::class)")."->middleware(['auth:sanctum']);");
        Artisan::call(command: 'make:migration create_' . Str::plural(strtolower($name)) . '_table --create=' . Str::plural(strtolower($name)));
    }

    protected function controller($name)
    {
        $controllerTemplate = str_replace(
            [
                '{{modelName}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub('Controller')
        );

        file_put_contents(app_path("/Http/Controllers/{$name}Controller.php"), $controllerTemplate);
    }

    protected function model($name, $fields)
    {
        $modelTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Model')
        );
        $fields = '"' . implode('","', $fields) . '"';
        $modelTemplate = str_replace(
            ['{{fillable}}'],
            [$fields],
            $modelTemplate
        );

        file_put_contents(app_path("/Models/{$name}.php"), $modelTemplate);
    }

    protected function request($name)
    {
        $requestTemplate = str_replace(
            ['{{modelName}}'],
            [$name],
            $this->getStub('Request')
        );

        if (!file_exists($path = app_path('/Http/Requests')))
            mkdir($path, 0777, true);

        file_put_contents(app_path("/Http/Requests/{$name}Request.php"), $requestTemplate);
    }


    protected function getStub($type)
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }
}
