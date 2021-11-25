<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\FacilityProfile;
use App\Models\User;
use App\Models\State;
use App\Models\Media;
use App\Models\Company;
use App\Models\Region;

class FacilityController extends Controller
{
    public function index (Company $company)
    {  
        $facilities = Facility::where('company_id', $company->id)->get();

        return view('facility.index', compact('facilities', 'company'));
    }

    public function create (Company $company)
    {   
        $regions = Region::all();
        $states = State::all();
        return view('facility.create', compact('company', 'states', 'regions'));
    }

    public function store(Request $request, Company $company)
    {
        request()->validate([
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'zip'           => 'required',
            'state'         => 'required',
            'phone'         => 'required',
            'region'        => 'required',
            'color'         => 'required',
            'logo'          => 'required'
        ]);

        $logo = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('/CompanyLogo'), $logo);
        
        $facility = new Facility();
        $facility->name = $request->name;
        $facility->company_id = $company->id;
        $facility->save();

        $media = new Media();
        $media->url = $logo;
        $media->save();

        $companyProfile = new FacilityProfile();
        $companyProfile->facility_id    = $facility->id;
        $companyProfile->address        = $request->input('address');
        $companyProfile->city           = $request->input('city');
        $companyProfile->zip            = $request->input('zip');
        $companyProfile->state_id       = $request->input('state');
        $companyProfile->region_id      = $request->input('region');
        $companyProfile->phone          = $request->input('phone');
        $companyProfile->color          = $request->input('color');
        $companyProfile->logo           = $media->id;
        $companyProfile->save();
        
        return redirect('/')->with('message', 'Facility created!');
    }


    public function edit(Facility $facility)
    {   
        $states = State::all();
        $regions = Region::all();
        return view('facility.edit', compact('facility', 'states', 'regions'));
    }

    public function update(Request $request, Facility $facility)
    {   
        $this->validate($request, [
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'zip'           => 'required',
            'state'         => 'required',
            'region'        => 'required',
            'phone'         => 'required',
            'color'         => 'required',
            'logo'          => 'required'
        ]);  

        $logo = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('/CompanyLogo'), $logo);
        
        $media = new Media();
        $media->url = $logo;
        $media->save();

        $FacilityProfile = FacilityProfile::where('facility_id', $facility->id)->update([
            'address'       => $request->input('address'),
            'city'          => $request->input('city'),
            'zip'           => $request->input('zip'),
            'state_id'      => $request->input('state'),
            'region_id'     => $request->input('region'),
            'phone'         => $request->input('phone'),
            'color'         => $request->input('color'),
            'logo'          => $media->id
        ]);
        
        $Facility = Facility::where('id', $facility->id)->update([
            'name' => $request->input('name')
        ]);

        return redirect('/')->with('message', 'Facility details updated');
    }


    public function destroy(Facility $facility)
    {   
        $facilityProfile = FacilityProfile::find($facility->id);
        $facilityProfile->delete();
        $facility->delete();
        return redirect('/')->with('message', 'Facility deleted!');
    }
    
}

