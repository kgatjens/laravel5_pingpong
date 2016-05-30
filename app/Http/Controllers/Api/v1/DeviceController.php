<?php

namespace HepC\Http\Controllers\Api\v1;

use Illuminate\Http\Request;

use HepC\Http\Requests;
use HepC\Http\Controllers\Controller;
use HepC\Models\Devices;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // 1) validation
        $validator = $this->validateCreateDeviceParameter($request);

        try {
            if($validator->fails()){
                // fails
                return \Response::json(array(
                        'error'             => 'Bad Request ',
                        'error_description' => $validator->errors()->all())
                    , 400);
            }else{
                // save device 
                $device     =  Devices::processDevice($request->get('onesignal_id'));
                if ($device instanceof QueryException){
                    return $this->proccessQueryException($device);
                }
                return \Response::json(json_decode($device, true), 200);
            }
        }
        catch (Exception $e){
            return \Response::json(array('error'=>$e->getCode(), 'error_description' => $e->getMessage()), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return \Response::json('Not Implemented', 501);
    }

    /**
     * Create the validator for a new device.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Validation\Validator $validator
     */
    public function validateCreateDeviceParameter(Request $request){
        $validator = \Validator::make($request->isJson() ? $request->json()->all() : $request->all() , [
            'onesignal_id'      => 'required|max:255',
        ]);
        return $validator;
    }
}
