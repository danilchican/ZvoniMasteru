<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CreateTariffRequest;
use App\Models\Service;
use App\Models\Tariff;
use App\Models\Price;
use Illuminate\Http\Request;

class TariffsController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = 'Tariffs';
        $tariffs = Tariff::paginate(5);

        return view('admin.tariffs.index')->with(compact([
            'tariffs', 'titlePage',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $titlePage = 'Create Tariff';
        $services = Service::all();

        return view('admin.tariffs.create')->with(compact([
            'titlePage', 'services',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTariffRequest $request)
    {
        $attributes = ['title', 'whom', 'additional_service', 'top', 'published'];

        $prices = $request->input('prices');
        $ranges = $request->input('ranges');
        $services = (array)$request->input('services');

        $services_objects = [];
        $prices_objects = [];

        if($services) {
            foreach($services as $service) {
                $service_obj = new Service();
                $service_obj->setTitle($service);
                $services_objects[] = $service_obj;
            }
        }

        if(count($prices) === count($ranges)) {
            for($i = 0, $max = count($prices); $i < $max; $i++) {
                $price = new Price();
                $price->setPrice($prices[$i]);
                $price->setRange($ranges[$i]);

                $prices_objects[] = $price;
            }
        }

        $tariff = new Tariff($request->only($attributes));
        $tariff->save();

        $tariff->services()->sync($services);
        $tariff->prices()->saveMany($prices_objects);

        return redirect()->route('admin.tariffs.index')
            ->with(['success' => 'Tariff successfully added']);
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
        //
    }

    /**
     * Remove the tariff from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tariff = Tariff::find($id);

        if(!$tariff) {
            return redirect()->back()
                ->with(['error' => 'Tariff has not been found.']);
        }

        $tariff->delete();

        return redirect()->back()
            ->with(['success' => 'Tariff successfully deleted.']);
    }
}
