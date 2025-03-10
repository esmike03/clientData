<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Client Data Details</title>
    <style>
        /* Basic resets and font family (DejaVu Sans supports a wide range of characters) */
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 20px;
        }

        /* Centered header */
        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        /* Two-column table for main details */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }

        .details-table td {
            vertical-align: top;
            padding: 5px 10px;
        }

        /* Label styling */
        .label {
            font-weight: bold;
            color: #333;
            display: inline-block;
            min-width: 120px;
        }

        /* Section titles, like "Sketch Map" */
        .section-title {
            font-weight: bold;
            font-size: 1.1em;
            margin-bottom: 4px;
            text-align: center;
        }


        /* Center container for map and signature */
        .centered {
            text-align: center;
            margin: 4px 0;
        }

        /* Spacing for the prepared-by section */
        .prepared-by {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>

<body>
    <!-- Header Title -->
    <div style="text-align: center; margin-bottom: 2px; width: 100%;">
        <img src="{{ public_path('images/xentra1.png') }}" alt="Logo" style="height: 64px; margin-bottom: 0;">
        <p style="font-size: 6px; line-height: 1.2; text-align: center;">
            WPI Bldg, St. Peter Street, Dona Maria Village 1, <br>
            Punta Princesa, Cebu City, Cebu 6300
        </p>
    </div>

    <div class="header">
        <h3>CLIENT DATA</h3>
    </div>

    <!-- Two-Column Layout -->
    <table class="details-table">
        <tr>
            <!-- Left Column -->
            <td width="50%">
                <p><span class="label">Agent Code:</span> {{ $clientData->agent_code }}</p>
                <p><span class="label">Complete Address:</span> {{ $clientData->address_name }}</p>
                <p><span class="label">Payment Term:</span> {{ $clientData->payment_term }}</p>
                <p><span class="label">Discount/Deals:</span> {{ $clientData->discount_deals }}</p>
                <p><span class="label">Tie-up Pharmacy/ Doctors:</span> {{ $clientData->tie_up_pharmacy }}</p>
                <p><span class="label">Rebates Given:</span> {{ $clientData->rebates_given }}</p>

            </td>

            <!-- Right Column -->
            <td width="50%">
                <p><span class="label">Client Name:</span> {{ $clientData->client_name }}</p>
                <p><span class="label">Contact:</span> {{ $clientData->contact }}</p>
                <p><span class="label">Payment Type:</span> {{ $clientData->payment_type }}</p>
                <p><span class="label">Delivery Date:</span> {{ $clientData->deliver_date }}</p>
                <p><span class="label">Clinic Date:</span> {{ $clientData->clinic_date }}</p>
                <p><span class="label">Contact Person:</span> {{ $clientData->contact_person }}</p>
            </td>
        </tr>
    </table>

    <!-- Sketch Map Section -->
    @if ($clientData->sketch_map)
        <div class="section-title">Sketch Map</div>
        <div class="centered">
            <!-- Adjust width/height as desired -->
            <img src="{{ public_path($clientData->sketch_map) }}" alt="Sketch Map"
                style="max-width: 400px; border: 2px solid #000;">

        </div>
    @endif

    <!-- Prepared By & Signature -->
    <table style="width: 100%; margin-top: 20px; border-collapse: collapse;">
        <tr>
            <!-- Prepared By (Left) -->
            <td style="text-align: center; vertical-align: top; width: 50%;">
                <p style="text-align: center;"><strong>Prepared By:</strong><br>{{ $clientData->prepared_by }}</p>
                @if ($clientData->prepared_signature)
                    <img src="{{ $clientData->prepared_signature }}" alt="Signature" style="max-width: 200px;">
                @endif
            </td>

            <!-- Approved By (Right) -->
            <td style="text-align: center; vertical-align: top; width: 50%;">
                <p><strong>Approved By:</strong><br>Julius Adlaon</p>{{-- <p><strong>Approved By:</strong><br>{{ $clientData->prepared_by ?? 'N/A' }}</p> --}}
                @if ($clientData->approved_by)
                    <img src="{{ $clientData->approved_by }}" alt="Signature" style="max-width: 200px;">
                @endif
            </td>
        </tr>
    </table>


</body>

</html>
