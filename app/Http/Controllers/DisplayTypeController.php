<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DisplayType;


class DisplayTypeController extends Controller
{
    public function index ()
    {   

        $displayTypes = DisplayType::all();
        return view('DisplayType.index', compact('displayTypes'));

    }

    public function create ()
    {
        
        return view('DisplayType.create');

    }

    public function store (Request $request)
    {
        
        request()->validate([
            'name' => 'required'
        ]);

        $displayType = new DisplayType();
        $displayType->name = $request->input('name');
        $displayType->save();

        return redirect()->route('display.index')->with('message', 'Display Type Created!');

    }

    public function edit (DisplayType $displayType)
    {   
        
        return view('DisplayType.edit', compact('displayType'));

    }

    public function update (Request $request, DisplayType $displayType)
    {
        
        request()->validate([
            'name' => 'required'
        ]);

        $displayType = DisplayType::where('id', $displayType->id)->update([
            'name' => $request->input('name')
        ]);


        return redirect()->route('display.index')->with('message', 'Display Type Updated!');
    }

    public function destroy (DisplayType $displayType)
    {
        
        $displayType->delete();

        return redirect()->route('display.index')->with('message', 'Display Type Deleted!');

    }
}
