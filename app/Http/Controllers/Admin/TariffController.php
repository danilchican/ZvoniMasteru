<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\TariffRequest;
use App\Models\Price;
use App\Models\Service;
use App\Models\Tariff;

class TariffController extends AdminController
{
    /**
     * Attrributes for setting.
     *
     * @var array
     */
    private $attributes = [
        'title', 'whom', 'additional_service', 'top', 'published',
    ];

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TariffRequest $request)
    {
        $prices = $request->input('prices');
        $ranges = $request->input('ranges');
        $services = (array) $request->input('services');

        $services_objects = [];
        $prices_objects = [];

        if ($services) {
            foreach ($services as $service) {
                $service_obj = new Service();
                $service_obj->setTitle($service);
                $services_objects[] = $service_obj;
            }
        }

        if (count($prices) === count($ranges)) {
            for ($i = 0, $max = count($prices); $i < $max; $i++) {
                $price = new Price();
                $price->setPrice($prices[$i]);
                $price->setRange($ranges[$i]);
                $price->save();

                if ($price->id) {
                    $prices_objects[] = $price->id;
                }
            }
        }

        $tariff = new Tariff($request->only($this->attributes));
        $tariff->save();

        $tariff->services()->attach($services);
        $tariff->prices()->attach($prices_objects);

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
        $titlePage = 'Edit Tariff';
        $tariff = Tariff::find($id);
        $services = Service::all();

        $tariff_services = $tariff->services()->get()->pluck('id')->toArray();

        if (!$tariff) {
            return redirect()->back()
                ->with(['error' => 'Tariff has not been found.']);
        }

        return view('admin.tariffs.edit')->with(compact([
            'titlePage', 'tariff', 'services', 'tariff_services',
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TariffRequest $request, $id)
    {
        $prices = $request->input('prices');
        $ranges = $request->input('ranges');
        $services = (array) $request->input('services');

        $services_objects = [];
        $prices_objects = [];

        if ($services) {
            foreach ($services as $service) {
                $service_obj = new Service();
                $service_obj->setTitle($service);
                $services_objects[] = $service_obj;
            }
        }

        if (count($prices) === count($ranges)) {
            for ($i = 0, $max = count($prices); $i < $max; $i++) {
                $price = new Price();
                $price->setPrice($prices[$i]);
                $price->setRange($ranges[$i]);
                $price->save();

                if ($price->id) {
                    $prices_objects[] = $price->id;
                }
            }
        }

        $tariff = Tariff::find($id);
        $tariff->update($request->only($this->attributes));

        $tariff->services()->sync($services);
        $tariff->prices()->detach();
        $tariff->prices()->sync($prices_objects);

        return redirect()->route('admin.tariffs.index')
            ->with(['success' => 'Tariff has been updated.']);
    }

    /**
     * Remove the tariff from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tariff = Tariff::find($id);

        if (!$tariff) {
            return redirect()->back()
                ->with(['error' => 'Tariff has not been found.']);
        }

        $tariff->delete();

        return redirect()->back()
            ->with(['success' => 'Tariff successfully deleted.']);
    }
}
