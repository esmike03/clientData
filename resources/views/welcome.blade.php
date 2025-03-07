<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/png" href="{{ asset('images/xentra6.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <title>Xentra - Client Data Sheet</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-500 font-['Roboto']">
    <div class="max-w-4xl mx-auto bg-gray-100 p-6 rounded-lg shadow-lg">
        <div class="flex flex-col items-center mb-4 w-full">
            <img src="{{ asset('images/xentra1.png') }}" class="h-16 mb-0" />
            <p class="text-center text-[6px] leading-tight">
                WPI Bldg, St. Peter Street, Dona Maria Village 1, <br>
                Punta Princesa, Cebu City, Cebu 6300
            </p>
        </div>

        <h1 class="text-center mb-2 uppercase text-xl font-bold">Client Data Sheet</h1>

        <form id="client-data-form" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if ($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-4">
                    <strong>Whoops! Something went wrong.</strong>
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-4 grid grid-cols-2 gap-4">
                <!-- Date -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Date:</label>
                    <input type="date" name="date" id="date" value="{{ old('date') }}"
                        class="rounded-md border shadow-md border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Agent Code -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Agent Code:</label>
                    <input type="text" name="agent_code" id="agent_code" value="{{ old('agent_code') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Client Name -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Client Name:</label>
                    <input type="text" name="client_name" id="client_name" value="{{ old('client_name') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Complete Address -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Complete Address:</label>
                    <input type="text" name="address_name" id="address_name" value="{{ old('address_name') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Contact Number -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Contact Number:</label>
                    <input type="text" name="contact" id="contact" value="{{ old('contact') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Terms of Payment -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Terms of Payment:</label>
                    <input type="text" name="payment_term" id="payment_term" value="{{ old('payment_term') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>

                <!-- Payment Type -->
                <div>
                    <label class="text-gray-800 text-sm font-semibold">Payment Type:</label>
                    <input type="text" name="payment_type" id="payment_type" value="{{ old('payment_type') }}"
                        class="rounded-md shadow-md border border-gray-200 p-2 w-full bg-white">
                </div>
            </div>

            <div class="mb-4 mt-4">
                <label class="block mb-2"><strong class="text-gray-800 text-sm">Discount or Deals Given (Please
                        Specify):</strong></label>
                <textarea name="discount_deals" id="discount_deals"
                    class="w-full border border-gray-200 bg-white shadow-md rounded p-2 h-20">{{ old('discount_deals') }}</textarea>
            </div>

            <!-- Tie-Up Pharmacy/Doctors -->
            <div class="mb-4">
                <label class="block font-bold mb-2"><strong class="text-gray-800 text-sm">Tie-up Pharmacy/Doctors:
                    </strong></label>
                <textarea name="tie_up_pharmacy" id="tie_up_pharmacy"
                    class="w-full bg-white border border-gray-200 shadow-md rounded p-2 h-14">{{ old('tie_up_pharmacy') }}</textarea>
            </div>

            <!-- Rebates Given -->
            <div class="mb-4">
                <label class="block mb-2"><strong class="text-gray-800 text-sm">Rebates Given (Please Enumerate):
                    </strong></label>
                <textarea name="rebates_given" id="rebates_given"
                    class="w-full bg-white border border-gray-200 shadow-md rounded p-2 h-20">{{ old('rebates_given') }}</textarea>
            </div>

            <!-- Clinic & Delivery Information -->
            <div class="mt-4 grid grid-cols-2 gap-4">
                <div>
                    <strong class="text-gray-800 text-sm">Clinic Schedule:</strong>
                    <input type="date" name="clinic_date" id="clinic_date" value="{{ old('clinic_date') }}"
                        class="rounded-md border-1 shadow-md border-gray-200 p-1 w-full bg-white">
                </div>
                <div>
                    <strong class="text-gray-800 text-sm">Delivery Schedule:</strong>
                    <input type="date" name="deliver_date" id="deliver_date" value="{{ old('deliver_date') }}"
                        class="rounded-md border-1 shadow-md border-gray-200 p-1 w-full bg-white">
                </div>
                <div>
                    <strong class="text-gray-800 text-sm">Contact Person for Delivery:</strong>
                    <input type="text" name="contact_person" id="contact_person"
                        value="{{ old('contact_person') }}"
                        class="rounded-md shadow-md border-1 border-gray-200 p-1 w-full bg-white">
                </div>
            </div>

            <!-- Sketch Map (Image Upload) -->
            <div class="mb-4 mt-4">
                <label class="block font-bold mb-2"><strong class="text-gray-800 text-sm">SKETCH MAP (UPLOAD
                        IMAGE)</strong></label>
                <input type="file" name="sketch_map" id="sketch_map" value="{{ old('sketch_map') }}"
                    class="w-full border border-gray-200 bg-white shadow-md rounded p-2" accept="image/*">
            </div>

            <!-- Prepared By & Approved By -->
            <div class="flex justify-between mt-6">
                <div></div>
                <!-- Prepared By -->
                <div class="w-1/2 pr-4">
                    <label class="block font-bold"><strong class="text-gray-800 text-sm">Prepared By:</strong></label>
                    <input type="text" name="prepared_by" id="prepared_by" value="{{ old('prepared_by') }}"
                        class="bg-white shadow-md rounded-md border border-gray-200 w-full p-2 mb-2"
                        placeholder="Enter name">

                    <!-- Signature Pad -->
                    <canvas id="preparedSignature" class="border border-gray-200 w-full h-24"></canvas>
                    <input type="hidden" name="prepared_signature" id="prepared_signature">
                    <button type="button" onclick="clearSignature('preparedSignature', 'prepared_signature')"
                        class="text-red-500 text-sm mt-1"><i class="fa-solid fa-eraser"></i>
                        Clear Signature</button>

                    <span class="text-sm block mt-2">AGENT NAME & SIGNATURE</span>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="mt-6 text-center">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 text-white w-full rounded-md hover:bg-orange-700">
                    Submit
                </button>
            </div>
        </form>
    </div>

    <script>
        function initSignaturePad(canvasId, inputId) {
            const canvas = document.getElementById(canvasId);
            const signaturePad = new SignaturePad(canvas, {
                backgroundColor: "white",
                penColor: "black"
            });

            signaturePad.addEventListener("endStroke", () => {
                if (!signaturePad.isEmpty()) {
                    document.getElementById(inputId).value = signaturePad.toDataURL();
                }
            });

            return signaturePad;
        }

        document.addEventListener("DOMContentLoaded", function() {
            window.preparedSignaturePad = initSignaturePad("preparedSignature", "prepared_signature");

            // Form validation and confirmation on submit
            document.getElementById('client-data-form').addEventListener('submit', function(e) {
                // Prevent the default submission
                e.preventDefault();

                // List of required fields by their IDs
                const requiredFields = [
                    'date', 'agent_code', 'client_name', 'payment_term', 'rebates_given',
                    'tie_up_pharmacy', 'payment_type', 'discount_deals', 'address_name',
                    'contact', 'prepared_by', 'clinic_date', 'deliver_date', 'contact_person',
                    'sketch_map'
                ];
                let isValid = true;

                // Clear previous red borders and validate each field
                requiredFields.forEach(function(fieldId) {
                    const field = document.getElementById(fieldId);
                    if (field) {
                        field.classList.remove('border-red-500');
                        if (!field.value.trim()) {
                            field.classList.add('border-red-500');
                            isValid = false;
                        }
                    }
                });

                // If form is not valid, show an error alert
                if (!isValid) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incomplete Form',
                        text: 'Please fill in all required fields.',
                    });
                    return;
                }

                // If valid, show a confirmation alert before submitting
                Swal.fire({
                    title: 'Confirm Submission',
                    text: "Are you sure you want to submit this form?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, submit it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, submit the form
                        e.target.submit();
                    }
                });
            });
        });

        function clearSignature(canvasId, inputId) {
            if (canvasId === "preparedSignature") {
                window.preparedSignaturePad.clear();
                document.getElementById(inputId).value = "";
            }
        }
    </script>

    <!-- Display success alert if session contains a success message -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        </script>
    @endif
</body>

</html>
