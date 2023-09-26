<?php

use Illuminate\Support\Str;


function createRoutes()
{
    //get all of the model list in the models folder (app\Models)
    $listModels = getModels();
    $routes = [];

    foreach ($listModels as $c) {
        $class = "App\Models\\" . $c;
        $model = new $class();

        //get the model name and split it to kebab case (for example : ProgressReports -> progress-reports)
        $modelName = Str::kebab(class_basename($model));

        $modelNameLower = strtolower($modelName);

        //change the string to plural context (for example : user -> users)
        $modelName = Str::plural($modelNameLower);

        /* 
        adding the routes name, for example : 
        $routes['kecamatans'] = 'App\Http\Controllers\API\KecamatansController';
        
        in api.php, it will be used like this :
        
        Route::apiResources([
            'kecamatans' => 'App\Http\Controllers\KecamatansController',
            ...
        ]);
            */

        $routes[$modelName] = $model->controller();
    }

    return $routes;
}


function getModels()
{
    $path = app_path() . "/Models";
    $out = [];
    $results = scandir($path);

    foreach ($results as $result) {
        if ($result === '.' or $result === '..' or str_contains($result, 'ModelUtils')) continue;
        $out[] = substr($result, 0, -4);
    }

    return $out;
}
