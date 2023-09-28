<?php
namespace App\Http\Controllers;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class CompanyCRUDController extends Controller
{

    // To create seprate controller model and migration used seprated command 
    // php artisan make:controller cname
    // php artisan make:model mname
    // php artisan make:migration mname
    // php artisan migrate
    
public function index(Request $request)
{
    $search = $request['search'] ?? "";
    if($search!=""){
        $companies = Company::where('name','LIKE',"%$search%")->orwhere('email','LIKE',"%$search%")->orwhere('address','LIKE',"%$search%")->orderBy('id','desc')->paginate(2);
    }
    else{
        $companies = Company::paginate(10);
    }
    // $data['companies'] = Company::orderBy('id','desc')->paginate(3);
    // $data['companies'] = Company::paginate(3);

    return view('companies.index', compact('companies','search'));
}

public function create()
{
    return view('companies.create');
}

public function store(Request $request)
{
    try {
        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        // Success message using Session facade
        Session::flash('success', 'Company added successfully.');

        //using session helper
        // session()->flash('success', 'Data saved successfully.');
    } catch (\Exception $e) {
        // Error message
        Session::flash('error', 'Failed to add the company. Please try again later.');
        
    }

    // Redirect back to the previous page with flashed messages.
    return redirect()->route('companies.index');
}

public function show(Company $company)
{
    return view('companies.show',compact('company'));
} 

public function edit(Company $company)
{
 
    return view('companies.edit',compact('company'));
}

public function update(Request $request, $id)
{
    $request->validate([
    'name' => 'required',
    'email' => 'required',
    'address' => 'required',
    ]);
    $company = Company::find($id);
    $company->name = $request->name;
    $company->email = $request->email;
    $company->address = $request->address;
    $company->save();
    return redirect()->route('companies.index')
    ->with('success','Company Has Been updated successfully');
}


public function destroy(Company $company)
{
    $company->delete();
    return redirect()->route('companies.index')
    ->with('success','Company has been deleted successfully');
}

public function delete_selected(Request $request)
    {
        try {
            $ids = $request->input('ids');
            Company::whereIn('id', $ids)->delete();
    
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

}