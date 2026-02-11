<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\BusinessAddress;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:business-list|business-create|business-edit|business-delete', ['only' => ['index','store']]);
        $this->middleware('permission:business-create', ['only' => ['create','store']]);
        $this->middleware('permission:business-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:business-delete', ['only' => ['destroy']]);
    }
 
    public function index()
    {
        $businesses = Business::orderBy('created_at','ASC')->get();
        return view('pages.businesses.index',compact('businesses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.businesses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->get('business_addresses');
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:businesses',
        ]);
        
        $company = Business::create([
            'name' => $request->name,
            'code' => $request->code,
            'local' => $request->local ?? 0,
            'international' => $request->international ?? 0,
        ]);
        if(!empty($request->input('business_addresses')))
        {
            $company->addresses()->createMany($request->input('business_addresses'));
        }
        return back()->with('status', 'Business Added.');
        // return redirect('businesses')->with('status', 'Business Added.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Business $business)
    {
        $inventories = \App\Models\Inventory::where('buyer_id',$business->id)->get();
        $local_contracts = \App\Models\LocalContract::where('bussiness_id',$business->id)->get();
        return view('pages.businesses.view',compact('business','inventories','local_contracts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Business $business)
    {
        $inventories = \App\Models\Inventory::where('buyer_id',$business->id)->get();
        $local_contracts = \App\Models\LocalContract::where('bussiness_id',$business->id)->get();
        return view('pages.businesses.edit', compact('business','inventories','local_contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Business $business)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:businesses,code,'.$business->id,
        ]);
        
        $business->update([
                        'name' => $request->name,
                        'code' => $request->code,
                        'local' => $request->local ?? 0,
                        'international' => $request->international ?? 0,
                    ]);
        if(!empty($request->input('business_addresses')))
        {
            $business->addresses()->createMany($request->input('business_addresses'));
        }
        return back();
        // return redirect('businesses')->with('status', 'Business Updated.');;
    }

    public function update_address(Request $request, $id)
    {
        $business_address = BusinessAddress::findOrFail($id);
        $business_address->update($request->all());
        return back();
        // return redirect('businesses/'.$business_address->company_id.'/edit')->with('status', 'Address Updated.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $business = Business::find($id);
        $business->delete();
        return back();
    }

    public function delete_address($id)
    {
        BusinessAddress::destroy($id);
        return back();
    }
}
