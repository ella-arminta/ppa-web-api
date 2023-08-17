<?php

namespace App\Http\Controllers;

use App\Utils\HttpResponse;
use App\Utils\HttpResponseCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    use HttpResponse;

    protected $model;
    protected $service;


    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->service = $model->service();
    }
    
    public function test() {
        return $this->error([
            'test' => 'test'
        ], HttpResponseCode::HTTP_INTERNAL_SERVER_ERROR);
        /* return $this->success([
            'test' => 'test'
        ], HttpResponseCode::HTTP_OK); */

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    // public function index()
    {
        $u = $this->model->all();

        return response()->json([
            'status' => 'success',
            'message' => 'Model retrieved',
            'data' => $u,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        // $this->validate($request, $this->model->rules());

        // store
        $data = $this->service->create($request->all());

        // return
        return HttpResponse::success($data, HttpResponseCode::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate

        //update
        $data = $this->service->update($id, $request->all());

        //return
        return HttpResponse::success($data, HttpResponseCode::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->service->delete($id);

        return HttpResponse::success(null, HttpResponseCode::HTTP_NO_CONTENT);
    }
}
