<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Agent;
use Illuminate\Http\Request;
use App\Mail\NewDataApproved;
use App\Mail\NewDataRejected;
use Illuminate\Support\Facades\Mail;

class FormController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'agent_code' => 'required|string|max:255',
            'client_name' => 'required|string|max:255',
            'address_name' => 'required|string|max:255',
            'contact' => 'required|string|max:50',
            'payment_term' => 'nullable|string|max:255',
            'payment_type' => 'nullable|string|max:255',
            'discount_deals' => 'nullable|string',
            'tie_up_pharmacy' => 'nullable|string',
            'rebates_given' => 'nullable|string',
            'clinic_date' => 'nullable|string|max:255',
            'deliver_date' => 'nullable|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'prepared_by' => 'required|string|max:255',
            'prepared_signature' => 'required|string',
            'optioner' => 'required|string',
            'sketch_map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Validate additional images as an array with a max of 3 files
            'add_img' => 'nullable|array|max:3',
            'add_img.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle sketch_map file upload
        if ($request->hasFile('sketch_map')) {
            $fileName = time() . '_' . $request->sketch_map->getClientOriginalName();
            $filePath = $request->file('sketch_map')->storeAs('uploads', $fileName, 'public');
            $validatedData['sketch_map'] = '/storage/' . $filePath;
        }

        // Handle additional images upload
        if ($request->hasFile('add_img')) {
            $imagePaths = [];
            foreach ($request->file('add_img') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $imagePaths[] = '/storage/' . $filePath;
            }
            // Store the array of file paths as a JSON string
            $validatedData['add_img'] = json_encode($imagePaths);
        }

        // Save the data into the database (ensure your Form model is configured correctly)
        Form::create($validatedData);

        // Send notification email if needed
        Mail::to('sarabiaearlmike14@gmail.com')->send(new NewDataApproved());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Form Submitted Successfully!');
    }



    public function index()
    {
        $clientData = Form::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('index', compact('clientData'));
    }

    public function clients()
    {
        $clientData = Form::where('status', 'approved')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('clients', compact('clientData'));
    }


    public function approveData(Request $request)
    {
        // Find the client data by ID
        $data = Form::find($request->id);

        if (!$data) {
            return response()->json(['message' => 'Data not found.'], 404);
        }

        // Send the email - you can specify the recipient here (or use $data->email if available)
        Mail::to(['sarabiaearlmike14@gmail.com'])->send(new \App\Mail\ClientDataApproved($data));

        // Update the status to approved
        $data->status = 'approved';
        $data->save();


        return response()->json(['message' => 'Approved and email sent successfully.'], 200);
    }

    public function deleteData(Request $request)
    {
        // Find the client data record by ID
        $clientData = Form::find($request->id);

        if (!$clientData) {
            return response()->json(['error' => 'Client data not found.'], 404);
        }

        // Delete the record
        $clientData->delete();

        // Return a JSON success response
        return response()->json(['success' => 'Client data deleted successfully.']);
    }

    public function deleteDatax(Request $request)
    {
        $client = Form::find($request->id);

        if (!$client) {
            return response()->json(['error' => 'Data not found'], 404);
        }

        // Try to get the agent using the agent_code
        $agent = Agent::where('agent_code', $client->agent_code)->first();

        // Store the agent's email if available
        $email = $agent?->email;

        // Delete the client record regardless of email
        $client->delete();

        // Send rejection email only if an email exists
        if ($email) {
            Mail::to($email)->send(new NewDataRejected());
        }

        return response()->json(['success' => 'Data deleted successfully']);
    }




}
