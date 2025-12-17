<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Applicant Status') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <form action=" {{route('job-applications.update', ['job_application' => $jobApplications->id, 'redirectToList' => request()->query('redirectToList') ])}} " method="post">
            @csrf
            @method('PUT')
            <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">
                <!-- company details -->
                <div class="p-6 mb-4 border border-gray-100 rounded-lg shadow-sm bg-gray-50">
                    <span>Edit The Job Application Details</span>

                    <div class="mt-3 mb-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">Applicant Name</label>
                        <span> {{ $jobApplications->user->name }} </span>
                    </div>

                    <div class="mt-3 mb-2">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Job Vacancy Title</label>
                        <span> {{ $jobApplications->jobVacancy->title }} </span>
                    </div>

                    <div class="mt-3 mb-2">
                        <label for="company_id" class="block text-sm font-medium text-gray-700">Resume Url</label>
                        <span><a class="text-blue-500 underline hover:text-blue-800" href="{{ $jobApplications->resume->fileUri }}"  target="_blank">{{ $jobApplications->resume->fileUri }}</a></span>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="jobCategory_id" class="block text-sm font-medium text-gray-700">File Name</label>
                        <span> {{ $jobApplications->resume->filename }} </span>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="jobCategory_id" class="block text-sm font-medium text-gray-700">Ai Score</label>
                        <span> {{ $jobApplications->aiGeneratedScore }} </span>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="jobCategory_id" class="block text-sm font-medium text-gray-700">Ai Feedback</label>
                        <span> {{ $jobApplications->aiGeneratedFeedback }} </span>
                    </div>
                    <div class="mt-3 mb-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Company Name</label>
                        <span> {{ $jobApplications->jobVacancy->company->name }} </span>

                </div>
                <div class="mt-3 mb-2">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="status" id="status" class="w-full my-2 border-gray-400 rounded-xl {{ $errors->has('status') ? 'outline-red-500 outline outline-1' : '' }} " value="{{old('status')}}">
                            <option value="pending" {{ old('type', $jobApplications->status ) == "pending" ? "selected" : "" }} >Pending</option>
                            <option value="accepted" {{ old('type', $jobApplications->status ) == "accepted" ? "selected" : "" }}>Accepted</option>
                            <option value="rejected" {{ old('type', $jobApplications->status ) == "rejected" ? "selected" : "" }}>Rejected</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600 ">{{ $message }}</p>
                        @enderror
                    </div>
                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-2 py-4 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">Update Job Application</button>

                    <a href="{{route('job-applications.index')}}" class="px-2 py-4 text-gray-500 hover:text-gray-700 rounded-xl">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
