<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ $company->name }}
        </h2>
    </x-slot>

    <div class="p-3 mt-6 overflow-x-auto">
        <x-notification />

        <div class="mb-6">
            <a href="{{ route('companies.index') }}" class="px-4 py-3 text-gray-800 bg-gray-200 rounded-lg shadow hover:bg-gray-800 hover:text-white"> ⬅️ Back</a>
        </div>


        <div class="w-full p-6 mx-auto bg-white rounded-lg shadow">
            <div>
                <h3 class="text-xl font-bold">Company Information</h3>
                <br>
                <p><strong>Owner: </strong>{{ $company->owner->name }}</p>
                <p><strong>Address: </strong>{{ $company->address }}</p>
                <p><strong>Industry: </strong>{{ $company->industry }}</p>
                <p><strong>Website: </strong><a class="text-blue-500 underline hover:text-blue-800" href="{{ $company->website }}">{{ $company->website }}</a></p>
            </div>

            <div class="flex justify-end mb-6 space-x-3">
                <a href="{{ route('companies.edit', ['company' => $company->id, 'redirectToList' => 'false']) }}"
                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                        ✍️ Edit</a>
                <form action=" {{route('companies.destroy', $company->id)}} " method="post" class="inline-block">
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
                        <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'jobs']) }}" class="{{ request('tab') == 'jobs' ? 'text-gray-500 hover:text-gray-800 border-b-4 border-blue-500 transition pb-1' : 'text-gray-500 hover:text-gray-800' }}">Jobs</a>
                    </li>
                    <li>
                        <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'application']) }}" class="{{ request('tab') == 'application' ? 'text-gray-500 hover:text-gray-800 border-b-4 border-blue-500 pb-1': ' text-gray-500 hover:text-gray-800 transition' }}">Applications</a>
                    </li>
                </ul>
            </div>
            <div>
                <div id="jobs" class="{{ request('tab') == 'jobs' || request('tab') == '' ? 'block' : 'hidden'}}">
                    <table class="min-w-full rounded-lg shadow bg-gray-50">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tl-lg">Title</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Type</th>
                                <th class="px-4 py-2 text-left bg-gray-100 ">Location</th>
                                <th class="px-4 py-2 text-left bg-gray-100 rounded-tr-lg">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($company->jobVacancies as $job)
                                <tr>
                                    <td class="px-4 py-2"> {{ $job->title }} </td>
                                    <td class="px-4 py-2"> {{ $job->type }} </td>
                                    <td class="px-4 py-2"> {{ $job->location }} </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('job-vacancies.show', $job->id) }}" class="text-blue-500 underline hover:text-blue-800">View</a>
                                    </td>
                                </tr>
                                @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="application" class="{{ request('tab') == 'application' ? 'block' : 'hidden'}}">
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
                            @forelse($company->jobApplications as $application)
                                <tr>
                                    <td class="px-4 py-2"> {{ $application->user?->name }} </td>
                                    <td class="px-4 py-2"> {{ $application->jobVacancy?->title }} </td>
                                    <td class="px-4 py-2"> {{ $application->status }} </td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('job-vacancies.show', $job->id) }}" class="text-blue-500 underline hover:text-blue-800">View</a>
                                    </td>
                                </tr>
                                @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
