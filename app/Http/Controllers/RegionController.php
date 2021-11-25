<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\RegionProfile;

class RegionController extends Controller
{
    public function index ()
    {
        $regions = Region::all();
        $regionProfiles = RegionProfile::all();
        return view('Region.index', compact('regions', 'regionProfiles'));

    }
    
    
    public function create ()
    {

        return view('Region.create');
        
    }


    public function store (Request $request)
    {
   
        request()->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $region = new Region();
        $region->name = $request->input('name');
        $region->guard_name = "web";
        $region->save();

        $regionProfile = new RegionProfile();
        $regionProfile->description = $request->input('description');
        $regionProfile->region_id   = $region->id;
        $regionProfile->save();

        return redirect()->route('region.index')->with('message', 'Region Created!');
    
    }


    public function edit (Region $region)
    {

        return view('Region.edit', compact('region'));
        
    }

    
    public function update (Request $request, Region $region)
    {
  
        request()->validate([
            'name'        => 'required',
            'description' => 'required'
        ]);

        $regionProfile = RegionProfile::where('id', $region->id)->update([
            'description' => $request->input('description'),
        ]);

        $region = Region::where('id', $region->id)->update([
            'name' => $request->input('name')
        ]);

        return redirect()->route('region.index')->with('message', 'Region Updated!');
        
    }


    public function destroy (Region $region)
    {

        $regionProfile = RegionProfile::find($region->id);
        $regionProfile->delete();
        $region->delete();
        return redirect()->route('region.index')->with('message', 'Region Deleted!');
        
    }
}
