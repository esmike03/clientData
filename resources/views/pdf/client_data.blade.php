<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Client Data Details</title>
    <style>
        /* Add your custom styles for the PDF here */
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .detail {
            margin-bottom: 10px;
        }
        .detail strong {
            display: inline-block;
            width: 150px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>Client Data Details</h2>
    </div>
    <div class="details">
        <div class="detail"><strong>ID:</strong> {{ $clientData->id }}</div>
        <div class="detail"><strong>Date:</strong> {{ $clientData->date }}</div>
        <div class="detail"><strong>Agent Code:</strong> {{ $clientData->agent_code }}</div>
        <div class="detail"><strong>Client Name:</strong> {{ $clientData->client_name }}</div>
        <div class="detail"><strong>Complete Address:</strong> {{ $clientData->address_name }}</div>
        <div class="detail"><strong>Contact:</strong> {{ $clientData->contact }}</div>
        <div class="detail"><strong>Payment Term:</strong> {{ $clientData->payment_term }}</div>
        <div class="detail"><strong>Payment Type:</strong> {{ $clientData->payment_type }}</div>
        <div class="detail"><strong>Discount/Deals:</strong> {{ $clientData->discount_deals }}</div>
        <div class="detail"><strong>Tie-up Pharmacy/Doctors:</strong> {{ $clientData->tie_up_pharmacy }}</div>
        <div class="detail"><strong>Rebates Given:</strong> {{ $clientData->rebates_given }}</div>
        <div class="detail"><strong>Clinic Date:</strong> {{ $clientData->clinic_date }}</div>
        <div class="detail"><strong>Delivery Date:</strong> {{ $clientData->deliver_date }}</div>
        <div class="detail"><strong>Contact Person:</strong> {{ $clientData->contact_person }}</div>
        <div class="detail"><strong>Prepared By:</strong> {{ $clientData->prepared_by }}</div>
    </div>
</body>
</html>
