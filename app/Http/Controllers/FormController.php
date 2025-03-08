<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\Agent;
use Illuminate\Http\Request;
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
            'clinic_date' => 'nullable|date',
            'deliver_date' => 'nullable|date',
            'contact_person' => 'nullable|string|max:255',
            'prepared_by' => 'required|string|max:255',
            'prepared_signature' => 'required|string',
            'sketch_map' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Handle file upload if available
        if ($request->hasFile('sketch_map')) {
            $fileName = time() . '_' . $request->sketch_map->getClientOriginalName();
            $filePath = $request->file('sketch_map')->storeAs('uploads', $fileName, 'public');
            $validatedData['sketch_map'] = '/storage/' . $filePath;
        }

        // Save the data into the database
        Form::create($validatedData);

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

        // Update the status to approved
        $data->status = 'approved';
        $data->save();

        $email = Agent::where('agent_code', $data->agent_code)->first();
        // Send the email - you can specify the recipient here (or use $data->email if available)
        Mail::to(['sarabiaearlmike14@gmail.com', $email->email])->send(new \App\Mail\ClientDataApproved($data));

        return response()->json(['message' => 'Approved and email sent successfully.'], 200);
    }
}
