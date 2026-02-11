<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CompanyAddress;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:company-list|company-view|company-create|company-edit|company-delete', ['only' => ['index','store']]);
         $this->middleware('permission:company-view', ['only' => ['show']]);
         $this->middleware('permission:company-create', ['only' => ['create','store']]);
         $this->middleware('permission:company-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:company-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $companies = Company::orderBy('created_at','ASC')->get();
        return view('pages.companies.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:companies',

        ]);
        
        $company = Company::create($request->all());
        if(!empty($request->input('company_addresses')))
        {
            $company->addresses()->createMany($request->input('company_addresses'));
        }
        return redirect('companies')->with('status', 'Company Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $inventories = \App\Models\Inventory::where('company_id',$company->id)->get();
        $local_contracts = \App\Models\LocalContract::where('buyer_id',$company->id)->get();
        return view('pages.companies.view',compact('company','inventories','local_contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $inventories = \App\Models\Inventory::where('company_id',$company->id)->get();
        $local_contracts = \App\Models\LocalContract::where('buyer_id',$company->id)->get();
        return view('pages.companies.edit', compact('company','inventories','local_contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:companies,code,'.$company->id
        ]);
        if (isset($request->local)) {
            $request['local'] = 1;
        }
        else {
            $request['local'] = 0;
        }

        if (isset($request->international)) {
            $request['international'] = 1;
        }
        else {
            $request['international'] = 0;
        }

        if (isset($request->buyer)) {
            $request['buyer'] = 1;
        }
        else {
            $request['buyer'] = 0;
        }

        if (isset($request->seller)) {
            $request['seller'] = 1;
        }
        else {
            $request['seller'] = 0;
        }
        $company->update($request->all());
        if(!empty($request->input('company_addresses')))
        {
            $company->addresses()->createMany($request->input('company_addresses'));
        }
        return redirect('companies')->with('status', 'Company Updated.');;
    }

    public function update_address(Request $request, $id)
    {
        $company_address = CompanyAddress::findOrFail($id);
        $company_address->update($request->all());
        return redirect('companies/'.$company_address->company_id.'/edit')->with('status', 'Address Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $company = Company::find($id);
        $company->delete();
        return back();
    }

    public function delete_address(Request $request)
    {
        CompanyAddress::destroy($request->id);
        return back();
        //$company_address->destroy();
        //return redirect('companies/'.$company_id.'/edit/');
    }
}
