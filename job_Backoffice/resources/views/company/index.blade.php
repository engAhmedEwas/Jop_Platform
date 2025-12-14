<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Companies {{ request()->input("archived") == 'true' ? "(Archived)" : "" }}
        </h2>
    </x-slot>

    <div class="p-3 overflow-x-auto">

        <x-notification />

        <div class="flex items-center justify-end space-x-4">

            @if(request()->input("archived") == 'true')
                    <!-- Active Company -->
                    <a href="{{ route('companies.index') }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Active Companies
                    </a>

            @else
                    <!-- Archived Company -->
                    <a href="{{ route('companies.index', ['archived' => 'true']) }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Archived Companies
                    </a>

            @endif
                <!-- Create New company -->
                <a href="{{ route('companies.create') }}"
                    class="px-2 py-4 mt-3 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">
                    Create New Company
                </a>

        </div>


        <table class="min-w-full mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Name</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Address</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Industry</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Website</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800">
                            @if(request()->input("archived") == 'true')
                            <p class="text-gray-500" href="{{ route('companies.show', $company->id) }}"> {{ $company->name }} </p>
                            @else
                            <a class="text-blue-500 underline hover:text-blue-800" href="{{ route('companies.show', $company->id) }}"> {{ $company->name }} </a>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $company->address }} </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $company->industry }} </td>
                        <td class="px-6 py-4 text-gray-800"> {{ $company->website }} </td>
                        <td>
                            <div class="flex space-x-4">

                            @if(request()->input("archived") == 'true')
                                <form action=" {{route('companies.restore', $company->id)}} " method="post" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-2 text-blue-500 rounded hover:text-blue-700 by-2">
                                        🔄 Restore </button>
                                </form>
                            @else
                                <a href="{{ route('companies.edit', $company->id) }}"
                                    class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                                        ✍️ Edit</a>
                                <form action=" {{route('companies.destroy', $company->id)}} " method="post" class="inline-block">
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
                        <td colspan="2" class="px-6 py-4 text-gray-800"> No Companies Found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
