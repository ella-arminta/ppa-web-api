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

function createPublicRoutes() {
    $routes = [];

    $routes['pendidikans'] = 'App\Http\Controllers\PendidikansController';
    $routes['kategoris'] = 'App\Http\Controllers\KategorisController';
    $routes['kelurahans'] = 'App\Http\Controllers\KelurahansController';
    $routes['kecamatans'] = 'App\Http\Controllers\KecamatansController';

    return $routes;
}

function createRouteNoAdmin() {
    $routes = [];

    $routes['users'] = 'App\Http\Controllers\API\UserController';
    // dd($routes);
    return $routes;
}


function getModels()
{
    $path = app_path() . "/Models";
    $out = [];
    $results = scandir($path);

    $forbidden = ["ModelUtils"];
    // $forbidden = ["Roles", "Statuses", "Pendidikans", "ModelUtils", "User"];

    foreach ($results as $result) {
        if ($result === '.' or $result === '..' or in_array(substr($result, 0, -4), $forbidden)) continue;
        $out[] = substr($result, 0, -4);
    }

    return $out;
}
