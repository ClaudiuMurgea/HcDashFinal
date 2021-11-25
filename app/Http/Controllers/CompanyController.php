<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyProfile;
use App\Models\User;
use App\Models\State;
use App\Models\Media;


class CompanyController extends Controller
{   
    public function __construct ()
    {
        $this->middleware('auth');
    }


    public function index ()
    {  

        $companies = Company::all();

        return view('company.index', compact('companies'));
    }


    public function create ()
    {   
        $states = State::all();
        return view('company.create', compact('states'));
    }


    public function store(Request $request)
    {
        request()->validate([
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'zip'           => 'required',
            'state'         => 'required',
            'phone'         => 'required',
            'color'         => 'required',
            'logo'          => 'required',
        ]);

       
        $logo = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('/CompanyLogo'), $logo);
        
        $company = new Company();
        $company->name = $request->name;
        $company->save();

        $media = new Media();
        $media->url = $logo;
        $media->save();

        $companyProfile = new CompanyProfile();
        $companyProfile->company_id = $company->id;
        $companyProfile->address    = $request->input('address');
        $companyProfile->city       = $request->input('city');
        $companyProfile->zip        = $request->input('zip');
        $companyProfile->state_id   = $request->input('state');
        $companyProfile->phone      = $request->input('phone');
        $companyProfile->color      = $request->input('color');
        $companyProfile->logo       = $media->id;
        $companyProfile->save();
        
        return redirect('/')->with('message', 'Company created!');
    }


    public function edit(Company $company)
    {   
        $company = Company::find($company->id);
        $states = State::all();
        return view('company.edit', compact('company', 'states'));
    }
    

    public function update(Request $request,Company $company)
    {   
        $v = request()->validate([
            'name'          => 'required',
            'address'       => 'required',
            'city'          => 'required',
            'zip'           => 'required',
            'state'         => 'required',
            'phone'         => 'required',
            'color'         => 'required',
            'logo'          => 'required',
        ]);
        
        $logo = time() . '-' . $request->name . '.' . $request->logo->extension();
        $request->logo->move(public_path('/CompanyLogo'), $logo);

        $media = Media::where('id', $company->id)->update([
            'url' => $logo
        ]);
        $media = Media::find($company->id);
        $media->url = $logo;
        $media->save();

        
        $companyProfile = CompanyProfile::where('company_id', $company->id)->update([
            'address'       => $request->input('address'),
            'city'          => $request->input('city'),
            'zip'           => $request->input('zip'),
            'state_id'      => $request->input('state'),
            'phone'         => $request->input('phone'),
            'color'         => $request->input('color'),
            'logo'          => $media->id
        ]);
        
        $company = Company::where('id', $company->id)->update([
            'name' => $request->input('name')
        ]);
        return redirect('/')->with('message', 'Company details updated!');
    }

    public function destroy (Company $company)
    {
        $companyProfile = CompanyProfile::find($company->id);
        $companyProfile->delete();
        $logo = Media::find($company->id);
        $logo->delete();
        $company->delete();

        return redirect('/')->with('message', 'Company deleted!');
    }
}
