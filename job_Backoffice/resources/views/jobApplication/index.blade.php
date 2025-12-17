<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Job Applications') }} {{ request()->input("archived") == 'true' ? "(Archived)" : "" }}
        </h2>
    </x-slot>

    <div class="p-3 overflow-x-auto">

        <x-notification />

        <div class="flex items-center justify-end space-x-4">

            @if(request()->input("archived") == 'true')
                    <!-- Active Applications -->
                    <a href="{{ route('job-applications.index') }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Active job Application
                    </a>

            @else
                    <!-- Archived Company -->
                    <a href="{{ route('job-applications.index', ['archived' => 'true']) }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Archived job Application
                    </a>

            @endif

        </div>


        <table class="min-w-full mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Applicant Name</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Company</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Position (job vacancy)</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Status</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jobApplications as $application)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800">
                            @if(request()->input("archived") == 'true')
                            <p class="text-gray-500" href="{{ route('job-applications.show', $application->id) }}"> {{ $application->user->name }} </p>
                            @else
                            <a class="text-blue-500 underline hover:text-blue-800" href="{{ route('job-applications.show', $application->id) }}"> {{ $application->user->name }} </a>
                            @endif
                        </td>
                        <!-- <td class="px-6 py-4 text-gray-800"> {{ $application->user->name }} </td> -->
                        <td class="px-6 py-4 text-gray-500"> {{ $application?->jobVacancy?->company?->name ?? "N/A"}} </td>
                        <td class="px-6 py-4 text-gray-500"> {{ $application?->jobVacancy?->title ?? "N/A" }} </td>
                        <td class=" @if($application->status == 'accepted') text-green-500 
                                    @elseif($application->status == 'rejected') text-red-500 
                                    @elseif($application->status == 'pending') text-purple-500 @endif"> {{ $application ?->status ?? "N/A" }}</td>
                        <td>
                            <div class="flex space-x-4">

                            @if(request()->input("archived") == 'true')
                                <form action=" {{route('job-applications.restore', $application->id)}} " method="post" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-2 text-blue-500 rounded hover:text-blue-700 by-2">
                                        🔄 Restore </button>
                                </form>
                            @else
                                <a href="{{ route('job-applications.edit', $application->id) }}"
                                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                                        ✍️ Edit</a>
                                <form action=" {{route('job-applications.destroy', $application->id)}} " method="post" class="inline-block">
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
                        <td colspan="2" class="px-6 py-4 text-gray-800"> No Job Application Found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $jobApplications->links() }}
        </div>
    </div>
</x-app-layout>
