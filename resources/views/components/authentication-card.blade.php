<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gree-100 dark:bg-gray-900">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-green dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
