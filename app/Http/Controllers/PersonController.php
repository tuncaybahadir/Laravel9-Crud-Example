<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StorePersonRequest;
use App\Http\Requests\Update\UpdatePersonRequest;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\View\View;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View|Model|LengthAwarePaginator
     */
    public function index(): View|Model|LengthAwarePaginator
    {
            $data = Person::orderByDesc('id')
                ->paginate(50);

            return view('person.index', [
                'data' => $data
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('person.create_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return RedirectResponse
     */
    public function store(StorePersonRequest $request): RedirectResponse
    {
        Person::create($request->validated());

        return to_route('person.index')
            ->with('toastr',
                [
                    'success' ,
                    'Yeni kayıt başarılı bir şekilde eklendi.'
                ]
            );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return View
     */
    public function edit(Person $person): View
    {
        return view('person.create_edit', [
            'data'  => $person
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return RedirectResponse
     */
    public function update(UpdatePersonRequest $request, Person $person): RedirectResponse
    {
        $person->update($request->validated());

        return to_route('person.edit', $person->id)
            ->with('toastr',
                [
                    'success' ,
                    'Kayıt başarılı bir şekilde güncellendi.'
                ]
            );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return RedirectResponse
     */
    public function destroy(Person $person): RedirectResponse
    {
        $deleteStatus = $person->delete();

        $responseMessage = [];

        if ($deleteStatus === 1) {
            $responseMessage = [
                'success' ,
                'Kayıt başarılı bir şekilde güncellendi.'
            ];
        } else {
            $responseMessage = [
                'error' ,
                'Kayıt silinirken hata oluştu !'
            ];
        }

        return to_route('person.edit', $person->id)
            ->with('toastr', $responseMessage);
    }
}
