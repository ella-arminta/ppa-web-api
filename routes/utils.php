<?php

use Illuminate\Support\Str;


function createRoutes()
{
    $listControllers = getModels();
    $routes = [];
    foreach ($listControllers as $c) {
        $class = "App\Models\\" . $c;
        $model = new $class();

        $modelName = Str::kebab(class_basename($model));

        $modelNameLower = strtolower($modelName);

        $modelName = Str::plural($modelNameLower);

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
