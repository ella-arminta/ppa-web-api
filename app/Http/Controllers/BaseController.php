<?php

namespace App\Http\Controllers;

use App\Utils\HttpResponse;
use App\Utils\HttpResponseCode;
use App\Utils\ValidateRequest;
use App\Utils\ValidateRequestPatch;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class BaseController extends Controller
{
    use HttpResponse, ValidateRequest, ValidateRequestPatch;

    public $model;
    protected $service;


    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->service = $model->service();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->getAll();

        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        // $this->validate($request, $this->model->rules());
        if($request->has('id') && $request->id != null){
            $this->validateRequestPatch($request->all(), $this->model);
            $data = $this->service->update($request->id, $request->all());
        }
        else
        {
            $this->validateRequest($request->all(), $this->model);
    
            // store
            $data = $this->service->create($request->all());
        }

        // return
        return $this->success($data, HttpResponseCode::HTTP_CREATED);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate
        // dd($request->all(),$id);
        $requestData = $request->all();
        $requestData['id'] = $id;

        $this->validateRequestPatch($requestData, $this->model);

        //update
        $data = $this->service->update($id, $request->all());

        //return
        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $this->service->delete($id);

        return $this->success(null, HttpResponseCode::HTTP_NO_CONTENT);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = $this->service->getById($id);

        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

    public function getByLaporanId(string $id){
        $valid = Validator::make(
            ['laporan_id' => $id],
            [
                'laporan_id' => 'required|exists:laporans,id',
            ],
            [
                'laporan_id.required' => 'Laporan id is required!',
                'laporan_id.exists' => 'Laporan id is not exists!',
            ]
        );
        if ($valid->fails()) {
            return $this->error($valid->errors()->first());
        }
        $data = $this->service->getByLaporanId($id);

        return $this->success($data, HttpResponseCode::HTTP_OK);
    }

}
