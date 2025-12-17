<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $jobVacancy->title }}
        </h2>
    </x-slot>

    <div class="p-3 mt-6 overflow-x-auto">
        <x-notification />

        <div class="mb-6">
            <a href="{{ route('job-vacancies.index') }}" class="px-4 py-3 text-gray-800 bg-gray-200 rounded-lg shadow hover:bg-gray-800 hover:text-white"> ⬅️ Back</a>
        </div>


        <div class="w-full p-6 mx-auto bg-white rounded-lg shadow">
            <div>
                <h3 class="text-xl font-bold">Job Vacancy Information</h3>
                <br>
                <p class="font-bold"><strong>Company Name: </strong>{{ $jobVacancy->company->name }}</p>
                <p><strong>Location: </strong>{{ $jobVacancy->location }}</p>
                <p><strong>Description: </strong>{{ $jobVacancy->description }}</p>
                <p><strong>Type: </strong>{{ $jobVacancy->type }}</p>
                <p><strong>Salary: </strong>{{ number_format($jobVacancy->salary, 2) }}</p>
                <div>
                    <p class="px-2 py-2 mt-2 mb-2 border rounded-lg w-fit bg-sky-600">
                        {{ $jobVacancy->jobCategory->name }}</p>
                </div>
            </div>

            <div class="flex justify-end mb-6 space-x-3">
                <a href="{{ route('job-vacancies.edit', ['job_vacancy' => $jobVacancy->id, 'redirectToList' => 'false']) }}"
                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                        ✍️ Edit</a>
                <form action=" {{route('job-vacancies.destroy', $jobVacancy->id)}} " method="post" class="inline-block">
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
                        <a href="{{ route('job-vacancies.show', ['job_vacancy' => $jobVacancy->id, 'tab' => 'applications']) }}" class="{{ request('tab') == 'application' ? 'text-gray-500 hover:text-gray-800 border-b-4 border-blue-500 pb-1': ' text-gray-500 hover:text-gray-800 transition' }}">Applications</a>
                    </li>
                </ul>
            </div>
            <div>
                <div id="applications" class="{{ request('tab') == 'applications' ? 'block' : ''}}">
                    <table class="min-w-full rounded-lg shadow bg-gray-50">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tl-lg">ApplicantName</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Job Title</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Status</th>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($jobVacancy->jobApplications as $application)
                                <tr>
                                    <td class="px-4 py-2"> {{ $application->user->name }} </td>
                                    <td class="px-4 py-2"> {{ $application->jobVacancy->title }} </td>
                                    <td class="px-4 py-2"> {{ $application->status }} </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('job-applications.show', $application->id) }}" class="text-blue-500 underline hover:text-blue-800">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-800"> No Job Application Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
