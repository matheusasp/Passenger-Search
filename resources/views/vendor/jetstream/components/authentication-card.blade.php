<div class="min-h-screen flex flex-col sm:justify-center items-center pt-0 sm:pt-0 bg-gray-100">
    <div>
        <img src="{{ asset('images/logo.png') }}" />
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
