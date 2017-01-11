<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateServiceRequest;
use App\Models\Service;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ServicesController extends AdminController
{
    /**
     * Variable to limit orders to display.
     */
    const LIMIT_SERVICES_TO_DISPLAY = 5;

    /**
     * Get the services for tariffs.
     *
     * @param Request $request
     * @param null    $count
     *
     * @return mixed
     */
    public function getServices(Request $request, $count = null)
    {
        $_count = $count ? $count : self::LIMIT_SERVICES_TO_DISPLAY;

        return Response::json(
            Service::limit($_count)->orderBy('id', 'desc')->get(), 200
        );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = 'Services';

        return view('admin.tariffs.services.index')->with(compact([
            'titlePage',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateServiceRequest $request
     *
     * @return mixed
     */
    public function store(CreateServiceRequest $request)
    {
        $service = Service::create($request->only('title'));

        if (!$service) {
            return Response::json([
                        'Can\'t create a new service.',
                ], 305);
        }

        return Response::json([
                'success'  => true,
                'service'  => $service,
                'messages' => [
                    'Service created successfully.',
                ],
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->update($request->only('title'));
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                'Service was not found',
            ], 305);
        }

        return Response::json([
            'success'  => true,
            'messages' => [
                'Order successfully updated',
            ],
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $service = Service::findOrFail($id);
            $service->delete();
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                    'Service was not found',
            ], 305);
        }

        return Response::json([
            'success'  => true,
            'messages' => [
                'Order successfully deleted',
            ],
        ], 200);
    }
}
