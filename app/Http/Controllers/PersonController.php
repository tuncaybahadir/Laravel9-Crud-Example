<?php

namespace App\Http\Controllers;

use App\Http\Requests\Store\StorePersonRequest;
use App\Http\Requests\Update\UpdatePersonRequest;
use App\Models\Address;
use App\Models\Person;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
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
        $data = Person::with('address')
            ->orderByDesc('id')
            ->paginate(50);

        return view('person.index', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePersonRequest $request
     * @return RedirectResponse
     */
    public function store(StorePersonRequest $request): RedirectResponse
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validated();

            $response = Person::create($request->validated());

            Address::updateOrCreate(['person_id' => $response->id])
                ->update($validatedData);

            DB::commit();

            $responseMessage = [
                'success',
                'Kayıt başarılı bir şekilde güncellendi.'
            ];

        } catch (\Exception $e) {

            DB::rollBack();

            $responseMessage = [
                'error',
                'Kayıt eklenirken hata oluştu !'
            ];

        }

        return to_route('person.index')
            ->with('toastr', $responseMessage);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('person.create_edit', [
            'genderStates' => genderStatus()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePersonRequest $request
     * @param Person $person
     * @return RedirectResponse|Model
     */
    public function update(UpdatePersonRequest $request, Person $person): RedirectResponse|Model
    {
        DB::beginTransaction();

        try {

            $validatedData = $request->validated();

            $person->update($validatedData);
            $person->address()
                ->updateOrCreate(['person_id' => $person->id],
                    $request->validated()
                );

            DB::commit();

            $responseMessage = [
                'success',
                'Kayıt başarılı bir şekilde güncellendi.'
            ];

        } catch (\Exception $e) {

            DB::rollBack();

            $responseMessage = [
                'error',
                'Kayıt güncellenirken hata oluştu !'
            ];

        }

        return to_route('person.edit', $person->id)
            ->with('toastr', $responseMessage);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Person $person
     * @return View|Model
     */
    public function edit(Person $person): View|Model
    {
        return view('person.create_edit', [
            'genderStates' => genderStatus(),
            'data' => $person
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Person $person
     * @return RedirectResponse
     */
    public function destroy(Person $person): RedirectResponse
    {

        DB::beginTransaction();

        try {

            $person->address()->delete();

            $person->delete();

            DB::commit();

            $responseMessage = [
                'success',
                'Kayıt başarılı bir şekilde silindi.'
            ];

        } catch (\Exception $e) {

            DB::rollBack();

            $responseMessage = [
                'error',
                'Kayıt silinirken hata oluştu !'
            ];

        }


        return to_route('person.index')
            ->with('toastr', $responseMessage);
    }
}
