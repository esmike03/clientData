<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Approved Clients List</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" type="image/png" href="{{ asset('images/xentra6.png') }}" />
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body>
    <div class="container mx-auto px-4 py-6">
        <!-- Header Section -->
        <div class="flex justify-between items-center content-center mb-6">
            <h1 class="text-2xl font-bold mb-4">Approved Clients List</h1>
            <a href="/client-data"
                class="text-right bg-orange-500 p-2 rounded-md text-orange-100 cursor-pointer hover:scale-105 transition-transform">Pending
                Clients</a>
        </div>

        @if (session('success'))
            <div class="bg-green-200 text-green-700 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Search Input -->
        <div class="mb-4">
            <input type="text" id="searchInput" class="border p-2 w-full" placeholder="Search clients...">
        </div>

        <!-- Client Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="clientCards">
            @forelse ($clientData as $data)
                <!-- Assign an ID to each card using the data's id -->
                <div id="card-{{ $data->id }}"
                    class="bg-white border-l-2 border-orange-500 hover:scale-110 transition-transform cursor-pointer shadow-md rounded-lg p-4 flex items-center space-x-4"
                    onclick='showModal(@json($data))'>
                    <!-- Icon Section -->
                    <div class="flex justify-center items-center w-20">
                        <i class="fa fa-file text-5xl text-orange-500"></i>
                    </div>

                    <!-- Information Section -->
                    <div class="flex-1">
                        <div class="mb-1">
                            <span
                                class="text-gray-600">{{ \Carbon\Carbon::parse($data->date)->format('F j, Y') }}</span>
                        </div>
                        <div class="mb-1">
                            <i class="fa fa-user-tag text-gray-400"></i>
                            <span class="font-medium text-gray-600">
                                {{ $data->agent_code ?: 'Empty' }}
                            </span>
                        </div>
                        <div>
                            <i class="fa fa-pen text-gray-400"></i>
                            <span class="font-medium text-gray-600">
                                {{ $data->prepared_by ?: 'Empty' }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500">No client data available.</p>
            @endforelse
        </div>
    </div>

    <script>
        // SEARCH FUNCTIONALITY
        document.getElementById('searchInput').addEventListener('input', function() {
            let query = this.value.toLowerCase();
            let cards = document.querySelectorAll('.client-card');
            cards.forEach(card => {
                if (card.innerText.toLowerCase().includes(query)) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // DELETE & MODAL FUNCTIONALITY
        function showModal(data) {
            // Build HTML content for modal
            let html = `
        <div class="text-left space-y-2">
          <div class="grid grid-cols-2 gap-2 text-xs lg:text-sm">
            <p>Agent Code:<strong> ${data.agent_code}</strong></p>
            <p>Client Name:<strong> ${data.client_name}</strong></p>
            <p>Complete Address:<strong> ${data.address_name}</strong></p>
            <p>Contact:<strong> ${data.contact}</strong></p>
            <p>Payment Term:<strong> ${data.payment_term}</strong></p>
            <p>Payment Type:<strong> ${data.payment_type}</strong></p>
          </div>
          <p class="text-xs lg:text-sm">Discount/Deals:<strong> ${data.discount_deals}</strong></p>
          <p class="text-xs lg:text-sm">Tie-up Pharmacy/Doctors:<strong> ${data.tie_up_pharmacy}</strong></p>
          <p class="text-xs lg:text-sm">Rebates Given:<strong> ${data.rebates_given}</strong></p>
          <div class="grid grid-cols-2 gap-2 text-xs lg:text-sm">
            <p>Clinic Date:<strong> ${data.clinic_date}</strong></p>
            <p>Delivery Date:<strong> ${data.deliver_date}</strong></p>
            <p>Contact Person:<strong> ${data.contact_person}</strong></p>
          </div>
        </div>
      `;

            // Append images if available
            if (data.sketch_map) {
                html += `
          <p class="mt-2 text-xs lg:text-lg text-center">
            <strong>Sketch Map</strong><br>
            <img src="${data.sketch_map}" alt="Sketch Map" class="w-full mb-4 border-1 rounded-md mx-auto">
          </p>`;
            }
            if (data.prepared_signature) {
                html += `
          <p class="text-right text-xs lg:text-lg mr-6">
            Prepared By:<br><strong> ${data.prepared_by}</strong>
          </p>
          <p class="mt-0 text-xs lg:text-lg text-right">
            <br><img src="${data.prepared_signature}" alt="Signature" class="w-26 h-auto ml-auto">
          </p>`;
            }

            // Show modal with Delete and Close buttons
            Swal.fire({
                title: 'Client Data Details',
                html: html,
                width: '600px',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Close',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Ask for deletion confirmation
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This will permanently delete the client data.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                            // Get CSRF token from meta tag
                            const token = document.querySelector('meta[name="csrf-token"]').getAttribute(
                                'content');

                            // Show loading spinner during deletion
                            Swal.fire({
                                title: 'Deleting...',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Send AJAX request to delete client data
                            fetch('/delete-data', {
                                    method: 'POST', // Adjust method if needed (or use DELETE)
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': token
                                    },
                                    body: JSON.stringify({
                                        id: data.id
                                    })
                                })
                                .then(response => {
                                    if (response.ok) {
                                        // Remove the deleted card from the DOM
                                        const card = document.getElementById('card-' + data.id);
                                        if (card) {
                                            card.remove();
                                        }
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Deleted!',
                                            text: 'The client data has been deleted.',
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    } else {
                                        throw new Error('Delete failed');
                                    }
                                })
                                .catch(error => {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Error',
                                        text: error.message
                                    });
                                });
                        }
                    });
                }
            });
        }
    </script>
</body>

</html>
