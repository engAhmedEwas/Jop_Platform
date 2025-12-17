<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Job Vacancies') }} {{ request()->input("archived") == 'true' ? "(Archived)" : "" }}
        </h2>
    </x-slot>

    <div class="p-3 overflow-x-auto">

        <x-notification />

        <div class="flex items-center justify-end space-x-4">

            @if(request()->input("archived") == 'true')
                    <!-- Active Company -->
                    <a href="{{ route('job-vacancies.index') }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Active job Vacancy
                    </a>

            @else
                    <!-- Archived Company -->
                    <a href="{{ route('job-vacancies.index', ['archived' => 'true']) }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Archived job Vacancy
                    </a>

            @endif
                <!-- Create New company -->
                <a href="{{ route('job-vacancies.create') }}"
                    class="px-2 py-4 mt-3 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">
                    Create New job Vacancy
                </a>

        </div>


        <table class="min-w-full mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Title</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Company</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Location</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">type</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">salary</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobVacancies as $jobVacancy)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800">
                            @if(request()->input("archived") == 'true')
                            <p class="text-gray-500" href="{{ route('job-vacancies.show', $jobVacancy->id) }}"> {{ $jobVacancy->title }} </p>
                            @else
                            <a class="text-blue-500 underline hover:text-blue-800" href="{{ route('job-vacancies.show', $jobVacancy->id) }}"> {{ $jobVacancy->title }} </a>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $jobVacancy->company->name }} </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $jobVacancy->location }} </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $jobVacancy->type }} </td>
                        <td class="px-6 py-4 text-gray-800"> $ {{number_format($jobVacancy->salary, 2) }}</td>
                        <td>
                            <div class="flex space-x-4">

                            @if(request()->input("archived") == 'true')
                                <form action=" {{route('job-vacancies.restore', $jobVacancy->id)}} " method="post" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-2 text-blue-500 rounded hover:text-blue-700 by-2">
                                        🔄 Restore </button>
                                </form>
                            @else
                                <a href="{{ route('job-vacancies.edit', $jobVacancy->id) }}"
                                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                                        ✍️ Edit</a>
                                <form action=" {{route('job-vacancies.destroy', $jobVacancy->id)}} " method="post" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="px-2 text-white bg-red-500 border border-red-500 rounded hover:bg-red-700 by-2">
                                            🗃️ Archive</button>
                                </form>
                            @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-gray-800"> No Job Vacancies Found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $jobVacancies->links() }}
        </div>
    </div>
</x-app-layout>
