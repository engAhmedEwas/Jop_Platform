<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Add Job Vacancy') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <form action=" {{route('job-vacancies.store')}} " method="post">
            @csrf

            <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">
                <!-- company details -->
                <div class="p-6 mb-4 border border-gray-100 rounded-lg shadow-sm bg-gray-50">
                    <h3 class="text-lg font-bold">Job Vacancy Details</h3>
                    <span>Enter The Job Vacancy Details Below</span>

                    <div class="mt-3 mb-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Job Title</label>
                        <input type="text" name="title" id="title"
                            class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('title') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('title')}}">

                        @error('title')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-3 mb-2">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Salary (USD)</label>
                        <input type="number" name="salary" id="salary"
                            class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('salary') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('salary')}}">

                        @error('salary')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="location" class="block text-sm font-medium text-gray-700">Location</label>
                        <input type="text" name="location" id="salary"
                            class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('location') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('location')}}">

                        @error('location')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="type" class="block text-sm font-medium text-gray-700">Job Type</label>
                        <select name="type" id="type" class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('type') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('type')}}">
                            <option value="Full-Time" {{ old('type' ) == "Full-Time" ? "selected" : "" }} >Full Time</option>
                            <option value="Contract" {{ old('type' ) == "Contract" ? "selected" : "" }}>Contract</option>
                            <option value="Remote" {{ old('type' ) == "Remote" ? "selected" : "" }}>Remote</option>
                            <option value="Hybrid" {{ old('type' ) == "Hybrid" ? "selected" : "" }}>Hybrid</option>
                        </select>
                        @error('type')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="company_id" class="block text-sm font-medium text-gray-700">Company Name</label>
                        <select name="company_id" id="company_id" class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('company_id') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('company_id')}}">
                            @forelse($companies as $company)
                                <option value="{{ $company->id }}" {{ old('company_id' ) == $company->id ? "selected" : "" }}> {{ $company->name }} </option>
                            @empty
                            @endforelse
                        </select>
                        @error('company_id')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="jobCategory_id" class="block text-sm font-medium text-gray-700">Job Category</label>
                        <select name="jobCategory_id" id="jobCategory_id" class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('jobCategory_id') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('jobCategory_id')}}">
                            @forelse($categories as $category)
                                <option value="{{ $category->id }}" {{ old('jobCategory_id') == $company->id ? "selected" : ""}}> {{ $category->name }} </option>
                            @empty
                            @endforelse
                        </select>
                        @error('jobCategory_id')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea rows="4" name="description" id="description" class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('description') ? 'outline-red-500 outline outline-1' : '' }} " >{{old('description')}}</textarea>

                        @error('description')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-2 py-4 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">Add New Job Vacancy</button>

                    <a href="{{route('job-vacancies.index')}}" class="px-2 py-4 text-gray-500 hover:text-gray-700 rounded-xl">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
