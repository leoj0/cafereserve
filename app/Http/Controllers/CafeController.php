<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use Illuminate\Support\Facades\Storage;

class CafeController extends Controller
{

    protected $recommendationService;

    public function index()
    {
        return view('cafe_listings.index', [
            'cafes' => Cafe::latest()
                ->filter(request(['tag', 'search', 'location'])) // Apply filters for tag, search, and location
                ->where('status', 'Approved') // Ensure only approved cafes are shown
                ->paginate(8) // Paginate the results
        ]);
    }

    //show single cafe
    public function show(Cafe $cafe)
    {
        return view('cafe_listings.show', [
            'cafe' => $cafe
        ]);
    }

    //show create form
    public function create()
    {
        return view('cafe_listings.create');
    }

    //edit cafe
    public function edit(Cafe $cafe)
    {
        return view('cafe_listings.edit', ['cafe'=>$cafe]);
    }

    //update cafe
    public function update(Request $request, Cafe $cafe)
    {
        // Validate the request data
        $formfields = $request->validate([
            'cafe_name' => ['required'],
            'phone_number' => 'required|string|max:15',
            'cafe_tags' => 'required|string',
            'location' => 'required',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'opening_time' => 'required|string',
            'closing_time' => 'required|string'
        ]);
    
        // Handle the logo file upload if present
        if ($request->hasFile('logo')) {
            // Delete the old logo if it exists
            if ($cafe->logo) {
                Storage::disk('public')->delete($cafe->logo);
            }
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }
    
        // Update the existing cafe record with the validated data
        $cafe->update($formfields);
    
        return redirect()->route('owners.index')->with('message', 'Cafe updated successfully');
    }
    
    //delete cafe
    public function destroy(Cafe $cafe)
    {
        // Check if the authenticated user is the owner of the cafe
        if ($cafe->user_id !== Auth::id()) {
            return redirect()->route('owners.index')->with('error', 'You do not have permission to delete this cafe.');
        }
    
        // Delete the cafe
        $cafe->delete();
    
        // Redirect to a list of cafes or any other appropriate page
        return redirect()->route('owners.index')->with('message', 'Cafe deleted successfully');
    }

    //store cafe
    public function store(Request $request)
    {
        $formfields = $request->validate([
            'cafe_name' => ['required', Rule::unique('cafes', 'cafe_name')],
            'phone_number' => 'required|string|max:15',
            'cafe_tags' => 'required|string',
            'location' => 'required',
            'email' => 'required|email|max:255',
            'description' => 'required|string',
            'opening_time' => 'required|date_format:H:i',  
            'closing_time' => 'required|date_format:H:i'   
        ]);

        if($request->hasFile('logo'))
        {
            $formfields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formfields['user_id'] = auth()->id();
        
        $cafe = Cafe::create($formfields);

        return redirect()->route('cafes.uploadDocuments', $cafe->cafe_id)
            ->with('success', 'Cafe details saved. Please upload the required documents.');
    }

    public function manage(Cafe $cafe)
    {
        $userId = Auth::id(); // Get the authenticated user's ID
    
        // Check if the cafe belongs to the authenticated user
        if ($cafe->user_id !== $userId) {
            // Redirect to a page showing an error or a list of cafes
            return redirect()->route('owners.index')->with('error', 'You do not have permission to view this cafe.');
        }
    
        // If the cafe is found and belongs to the user, return the view
        return view('/cafe_listings/manage', [
            'cafe' => $cafe
        ]);
    }

    public function showDocumentUploadForm($cafe_id)
    {
        return view('/cafe_listings/upload-documents', ['cafe_id' => $cafe_id]);
    }
    
    public function storeDocuments(Request $request, $cafe_id)
    {
        $request->validate([
            'ssm_certificate' => 'required|file|mimes:pdf,jpg,png|max:2048',
            'business_license' => 'required|file|mimes:pdf,jpg,png|max:2048',
        ]);
    
        $cafe = Cafe::findOrFail($cafe_id);
    
        // Store documents
        if ($request->hasFile('ssm_certificate')) {
            $ssmPath = $request->file('ssm_certificate')->store('documents/ssm_certificates', 'public');
            $cafe->ssm_certificate = $ssmPath;
        }
    
        if ($request->hasFile('business_license')) {
            $licensePath = $request->file('business_license')->store('documents/business_licenses', 'public');
            $cafe->business_license = $licensePath;
        }
    
        $cafe->save();
    
        return redirect()->route('cafes.showDocuments', ['cafe' => $cafe->cafe_id])->with('success', 'Documents uploaded successfully!');

        
    }

    public function showDocuments(Request $request, $cafe_id)
    {
        $cafe = Cafe::findOrFail($cafe_id);
        return view('/cafe_listings/show-document', compact('cafe'));
        
    }

    public function updateDocuments(Request $request, $cafe_id)
    {
        $request->validate([
            'ssm_certificate' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
            'business_license' => 'nullable|file|mimes:pdf,jpg,png|max:2048',
        ]);

        $cafe = Cafe::findOrFail($cafe_id);

        // Update SSM Certificate if provided
        if ($request->hasFile('ssm_certificate')) {
            // Delete the old file if it exists
            if ($cafe->ssm_certificate && Storage::disk('public')->exists($cafe->ssm_certificate)) {
                Storage::disk('public')->delete($cafe->ssm_certificate);
            }

            // Store the new file
            $ssmPath = $request->file('ssm_certificate')->store('documents/ssm_certificates', 'public');
            $cafe->ssm_certificate = $ssmPath;
        }

        // Update Business License if provided
        if ($request->hasFile('business_license')) {
            // Delete the old file if it exists
            if ($cafe->business_license && Storage::disk('public')->exists($cafe->business_license)) {
                Storage::disk('public')->delete($cafe->business_license);
            }

            // Store the new file
            $licensePath = $request->file('business_license')->store('documents/business_licenses', 'public');
            $cafe->business_license = $licensePath;
        }

        $cafe->save();

        return redirect()->route('cafes.showDocuments', ['cafe' => $cafe_id])->with('success', 'Documents updated successfully!');
    }

    public function editDocuments($cafe_id, $document)
    {
        // Retrieve the cafe by ID
        $cafe = Cafe::findOrFail($cafe_id);
    
        // Validate the document type
        if (!in_array($document, ['ssm_certificate', 'business_license'])) {
            abort(404, 'Invalid document type.');
        }
    
        // Pass the cafe and document type to the view
        return view('/cafe_listings/edit-document', compact('cafe', 'document'));
    }

    public function updateStatus(Request $request, $id)
    {
        $cafe = Cafe::find($id);
        $cafe->status = $request->status; // 'Approved' or 'Denied'
        $cafe->save();

        return redirect()->back()->with('message', 'Cafe status updated successfully!');
    }
    

}
