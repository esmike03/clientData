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
<body class="h-full flex justify-center items-center pt-30">
    <form method="POST" action="{{ route('verify.code') }}" class="max-w-sm mx-auto mt-10">
        @csrf
        <h2 class="text-2xl font-semibold mb-6 text-center">Enter Security Code</h2>

        <div class="flex justify-between space-x-3">
            @for ($i = 1; $i <= 4; $i++)
                <input
                    type="text"
                    name="code[]"
                    maxlength="1"
                    class="w-16 h-16 text-center text-2xl border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
                    oninput="handleInput(this, {{ $i - 1 }})"
                    required
                >
            @endfor
        </div>

        @if(session('error'))
            <p class="text-red-500 text-center mt-2">{{ session('error') }}</p>
        @endif

        <button type="submit" class="mt-6 w-full bg-orange-600 text-white py-2 rounded-lg hover:bg-orange-700 transition">
            Verify
        </button>
    </form>

    <script>
        const inputs = document.querySelectorAll('input[name="code[]"]');

        function handleInput(el, index) {
            if (el.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            } else if (el.value.length === 0 && index > 0) {
                inputs[index - 1].focus();
            }
        }

        // Auto-focus first input on page load
        window.onload = () => inputs[0].focus();
    </script>
</body>

</html>
