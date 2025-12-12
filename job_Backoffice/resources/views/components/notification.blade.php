<div class="absolute inset-x-0 bottom-0 z-50">
    @if (session()->has('success'))
        <div x-data="{ show: true }" x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration 500ms x-init="setTimeout(() => show = false, 3000)" class="fixed z-50 top-4 right-4">
            <div role="alert" class="max-w-sm p-4 text-green-700 bg-green-100 border-l-4 border-green-500 rounded-lg shadow-lg">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2l4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>

                    <button @click="show = false" class="ml-auto text-green-600 hover:text-green-800">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
