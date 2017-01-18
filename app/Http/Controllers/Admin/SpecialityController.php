<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateSpecialityRequest;
use App\Models\Speciality;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SpecialityController extends Controller
{
    /**
     * Variable to limit specialities to display.
     */
    const LIMIT_SPECIALITIES_TO_DISPLAY = 5;

    /**
     * Get the services for tariffs.
     *
     * @param Request $request
     * @param null    $count
     *
     * @return mixed
     */
    public function getSpecialities(Request $request, $count = null)
    {
        $_count = $count ? $count : self::LIMIT_SPECIALITIES_TO_DISPLAY;

        return Response::json(
            Speciality::limit($_count)->orderBy('id', 'desc')->get(), 200
        );
    }

    /**
     * Search specialities by keywords.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function search(Request $request)
    {
        $keywords = $request->input('keywords');

        $message = 'Some specialities founded.';
        $code = 200;

        if ($keywords !== null) {
            $specialities = Speciality::searchByKeywords($keywords)->get();

            if ($specialities->isEmpty()) {
                $message = 'Can\'t found any speciality.';
                $code = 305;
            }

            return Response::json([
                'success'      => true,
                'messages'     => [$message],
                'specialities' => $specialities,
            ], $code);
        }

        $specialities = Speciality::limit(self::LIMIT_SPECIALITIES_TO_DISPLAY)
            ->orderBy('id', 'desc')->get();

        if ($specialities->isEmpty()) {
            $message = 'Can\'t found any speciality.';
            $code = 305;
        }

        return Response::json([
            'success'      => true,
            'messages'     => [$message],
            'specialities' => $specialities,
        ], $code);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $titlePage = 'Specialities';

        return view('admin.specialities.index')->with(compact([
            'titlePage',
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\CreateSpecialityRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CreateSpecialityRequest $request)
    {
        $speciality = Speciality::create($request->all());

        if (!$speciality) {
            return Response::json([
                'Can\'t create a new speciality.',
            ], 305);
        }

        return Response::json([
            'success'    => true,
            'speciality' => $speciality,
            'messages'   => [
                'Speciality created successfully.',
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\CreateSpecialityRequest $request
     * @param int                                              $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CreateSpecialityRequest $request, $id)
    {
        try {
            $speciality = Speciality::findOrFail($id);
            $speciality->update($request->all());
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                'Speciality was not found',
            ], 305);
        }

        return Response::json([
            'success'  => true,
            'messages' => [
                'Speciality successfully updated',
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
            $speciality = Speciality::findOrFail($id);
            $speciality->delete();
        } catch (ModelNotFoundException $ex) {
            return Response::json([
                'Speciality was not found',
            ], 305);
        }

        return Response::json([
            'success'  => true,
            'messages' => [
                'Speciality successfully deleted',
            ],
        ], 200);
    }
}
