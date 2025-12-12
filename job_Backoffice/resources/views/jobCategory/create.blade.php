<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add Job Category') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <form action=" {{route('job-categories.store')}} " method="post">
            @csrf
            <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">
                <div class="mb-3">
                    <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('name') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('name')}}">

                    @error('name')
                        <p class="text-sm text-red-600 ">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-2 py-4 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">Add New Category</button>

                    <a href="{{route('job-categories.index')}}" class="px-2 py-4 text-gray-500 hover:text-gray-700 rounded-xl">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
