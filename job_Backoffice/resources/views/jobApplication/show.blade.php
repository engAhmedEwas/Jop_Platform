<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $jobApplications->user->name }} Apply To {{ $jobApplications->jobVacancy->title }}
        </h2>
    </x-slot>

    <div class="p-3 mt-6 overflow-x-auto">
        <x-notification />

        <div class="mb-6">
            <a href="{{ route('job-applications.index') }}" class="px-4 py-3 text-gray-800 bg-gray-200 rounded-lg shadow hover:bg-gray-800 hover:text-white"> ⬅️ Back</a>
        </div>


        <div class="w-full p-6 mx-auto bg-white rounded-lg shadow">
            <div>
                <h3 class="text-xl font-bold">Application Information</h3>
                <br>
                <p><strong>Applicant: </strong>{{ $jobApplications->user->name }}</p>
                <p><strong>Job Vacancy: </strong>{{ $jobApplications->jobVacancy->title }}</p>
                <p><strong>Company: </strong>{{ $jobApplications->jobVacancy->company->name }}</p>
                <p><strong>Status: </strong> <span class="@if($jobApplications->status == 'accepted') text-green-500 @elseif($jobApplications->status == 'rejected') text-red-500 @else ($jobApplications->status == 'pending') text-purple-500 @endif">{{ $jobApplications->status }}</span></p>
                <p><strong>Resume: </strong><a class="text-blue-500 underline hover:text-blue-800" href="{{ $jobApplications->resume->fileUri }}"  target="_blank">{{ $jobApplications->resume->fileUri }}</a></p>
            </div>

            <div class="flex justify-end mb-6 space-x-3">
                <a href="{{ route('job-applications.edit', ['job_application' => $jobApplications->id, 'redirectToList' => 'false']) }}"
                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                        ✍️ Edit</a>
                <form action=" {{route('job-applications.destroy', $jobApplications->id)}} " method="post" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-2 text-white bg-red-500 border border-red-500 rounded hover:bg-red-700 by-2">
                            🗃️ Archive</button>
                </form>
            </div>

            <div class="mb-6">
                <ul class="flex space-x-3">
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplications->id, 'tab' => 'resumes']) }}" class="{{ request('tab') == 'resumes' ? 'text-gray-500 hover:text-gray-800 border-b-4 border-blue-500 transition pb-1' : 'text-gray-500 hover:text-gray-800' }}">Resumes</a>
                    </li>
                    <li>
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplications->id, 'tab' => 'AIFeedback']) }}" class="{{ request('tab') == 'AIFeedback' ? 'text-gray-500 hover:text-gray-800 border-b-4 border-blue-500 pb-1': ' text-gray-500 hover:text-gray-800 transition' }}">AI Feedback</a>
                    </li>
                </ul>
            </div>
            <div>
                <div id="resumes" class="{{ request('tab') == 'resumes' || request('tab') == '' ? 'block' : 'hidden'}}">
                    <table class="min-w-full rounded-lg shadow bg-gray-50">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tl-lg">Summary</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Skills</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Experience</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Education</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="px-4 py-2"> {{ $jobApplications->resume->summary }} </td>
                                    <td class="px-4 py-2"> {{ $jobApplications->resume->skills }} </td>
                                    <td class="px-4 py-2"> {{ $jobApplications->resume->experience }} </td>
                                    <td class="px-4 py-2"> {{ $jobApplications->resume->education }} </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <div id="AIFeedback" class="{{ request('tab') == 'AIFeedback' ? 'block' : 'hidden'}}">
                    <table class="min-w-full rounded-lg shadow bg-gray-50">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tl-lg">AI Score</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">AIFeedback</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td class="px-4 py-2"> {{ $jobApplications->aiGeneratedScore }} </td>
                                    <td class="px-4 py-2"> {{ $jobApplications->aiGeneratedFeedback }} </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
