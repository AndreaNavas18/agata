<?php

namespace App\Http\Controllers\Providers;

use App\Exports\Providers\ProvidersExport;
use App\Exports\Shared\Export;
use App\Http\Controllers\Controller;
use App\Models\Customers\Customer;
use App\Models\Customers\CustomerContact;
use App\Models\Customers\CustomerService;
use App\Models\General\City;
use App\Models\General\Department;
use App\Models\General\Service;
use App\Models\General\TypeContact;
use App\Models\General\TypeDocument;
use App\Models\Providers\Provider;
use App\Models\Providers\ProviderContact;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Session;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $providers = Provider::paginate();
        return view('modules.providers.index', compact('providers'));
    }

       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $providers = new Provider();

        $providers= $providers->with(
            'typeDocument',
            'city',
            'city.department',
            'state',
            'contacs',
            'services',
            'services.city',
            'services.city.department',
            'services.service',
            'services.customer',
        );
        if ($request->filled('name')) {
            $providers = $providers->name($request->name);
        }

        if ($request->filled('identification')) {
            $providers = $providers->name($request->identification);
        }

        if ($request->action=='buscar') {
            $providers = $providers->paginate();
            return view('modules.providers.index', compact('providers'));

        } else {
            $providers = $providers->get();
            return $providers;
            return (new ProvidersExport($providers))->download('Proveedores.xlsx');
        }

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $typesContacts= TypeContact::get();
        $typesDocuments = TypeDocument::get();
        $cities=City::get();
        return view('modules.providers.create', compact('typesContacts','typesDocuments','cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $provider= new Provider();
        $provider->type_document_id     = $request->type_document_id;
        $provider->identification       = $request->identification;
        $provider->name                 = $request->name;
        $provider->address              = $request->address;
        $provider->phone                = $request->phone;
        $provider->city_id              = $request->city_id;
        $provider->observations         = $request->observations;
        $provider->state_id             = 1;
        if (!$provider->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al insertar registro.');
            return redirect()->back();
        }

        //guardar contactos
        foreach ($request->type_contact_id as $key => $value) {
            $providerContact= new ProviderContact();
            $providerContact->type_contact_id       = $value;
            $providerContact->city_id               = $request->city_contact_id[$key];
            $providerContact->name                  = $request->name_contact[$key];
            $providerContact->home_phone            = $request->home_phone_contact[$key];
            $providerContact->cell_phone            = $request->cell_phone_contact[$key];
            $providerContact->email                 = $request->email_contact[$key];
            $providerContact->provider_id           = $provider->id;
            if (!$providerContact->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error al insertar registro.');
                return redirect()->back();
            }
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro insertado correctamente');
        return redirect()->route('providers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        session::flash('tab','info');
        $provider= Provider::findOrFail($id);
        $providerContacts= ProviderContact::providerId($id)->paginate();
        $tabPanel='ProviderInfoShowTab';

        return view('modules.providers.show', compact(
            'provider',
            'providerContacts',
            'tabPanel',
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($providerId)
    {
        session::flash('tab','info');
        $provider= Provider::with('contacs','services')->findOrFail($providerId);
        $typesContacts= TypeContact::get();
        $typesDocuments = TypeDocument::get();
        $departments= Department::get();
        $cities=City::get();
        $totalContactos= $provider->contacs->count();
        $tabPanel='providerInfoTabEdit';

        return view('modules.providers.edit', compact(
            'provider',
            'totalContactos',
            'typesContacts',
            'typesDocuments',
            'departments',
            'cities',
            'tabPanel',
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     $customer= Customer::findOrFail($id);
    //     $customer->type_document_id     = $request->type_document_id;
    //     $customer->identification       = $request->identification;
    //     $customer->name                 = $request->name;
    //     $customer->address              = $request->address;
    //     $customer->phone                = $request->phone;
    //     $customer->city_id              = $request->city_id;
    //     $customer->observations         = $request->observations;
    //     $customer->state_id             = 1;
    //     if (!$customer->save()) {
    //         DB::rollBack();
    //         Alert::error('Error', 'Error al actualizar el registro.');
    //         return redirect()->back();
    //     }

    //     CustomerContact::customerId($id)->delete();
    //     //guardar contactos
    //     foreach ($request->type_contact_id as $key => $value) {
    //         $customerContact= new CustomerContact();
    //         $customerContact->type_contact_id       = $value;
    //         $customerContact->city_id               = $request->city_contact_id[$key];
    //         $customerContact->name                  = $request->name_contact[$key];
    //         $customerContact->home_phone            = $request->home_phone_contact[$key];
    //         $customerContact->cell_phone            = $request->cell_phone_contact[$key];
    //         $customerContact->email                 = $request->email_contact[$key];
    //         $customerContact->customer_id           = $customer->id;
    //         if (!$customerContact->save()) {
    //             DB::rollBack();
    //             Alert::error('Error', 'Error al actualizar el registro.');
    //             return redirect()->back();
    //         }
    //     }

    //     DB::commit();
    //     Alert::success('¡Éxito!', 'Registro actualizado correctamente');
    //     return redirect()->route('providers.index');
    // }
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        $provider= Provider::findOrFail($id);
        $provider->type_document_id     = $request->type_document_id;
        $provider->identification       = $request->identification;
        $provider->name                 = $request->name;
        $provider->address              = $request->address;
        $provider->phone                = $request->phone;
        $provider->city_id              = $request->city_id;
        $provider->observations         = $request->observations;
        $provider->state_id             = 1;
        if (!$provider->save()) {
            DB::rollBack();
            Alert::error('Error', 'Error al actualizar el registro.');
            return redirect()->back();
        }

        ProviderContact::providerId($id)->delete();
        //guardar contactos
        foreach ($request->type_contact_id as $key => $value) {
            $providerContact= new ProviderContact();
            $providerContact->type_contact_id       = $value;
            $providerContact->city_id               = $request->city_contact_id[$key];
            $providerContact->name                  = $request->name_contact[$key];
            $providerContact->home_phone            = $request->home_phone_contact[$key];
            $providerContact->cell_phone            = $request->cell_phone_contact[$key];
            $providerContact->email                 = $request->email_contact[$key];
            $providerContact->provider_id           = $provider->id;
            if (!$providerContact->save()) {
                DB::rollBack();
                Alert::error('Error', 'Error al actualizar el registro.');
                return redirect()->back();
            }
        }

        DB::commit();
        Alert::success('¡Éxito!', 'Registro actualizado correctamente');
        return redirect()->route('providers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //karen
        try {
            DB::beginTransaction();
            if (!Provider::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (QueryException $th) {
            if ($th->getCode() === '23000') {
                Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
                return redirect()->back();
            } else {
                Alert::error('Error!', $th->getMessage());
                return redirect()->back();
            }
        }
    }

      /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function contactDestroy($id) {
        try {
            DB::beginTransaction();
            if (!ProviderContact::findOrFail($id)->delete()) {
                Alert::error('Error', 'Error al eliminar registro.');
                return redirect()->back();
            }
            DB::commit();
            Alert::success('¡Éxito!', 'Registro eliminado correctamente');
            return redirect()->back();
        } catch (QueryException $th) {
            if ($th->getCode() === '23000') {
                Alert::error('Error!', 'No se puede eliminar el registro porque está asociado con otro registro.');
                return redirect()->back();
            } else {
                Alert::error('Error!', $th->getMessage());
                return redirect()->back();
            }
        }
    }
}
