<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Job Categories') }}
        </h2>
    </x-slot>



    <div class="p-3 overflow-x-auto">

    <x-notification />

    <div class="flex items-center justify-end">
        <a href="{{ route('job-categories.create') }}" class="px-2 py-4 mt-3 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">Create New Category</a>
    </div>


        <table class="min-w-full mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Category</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800"> {{ $category->name }} </td>
                        <td>
                            <div class="flex space-x-4">
                            <a href="{{ route('job-categories.edit', $category->id) }}" class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">✍️ Edit</a>

                            <form action=" {{route('job-categories.destroy', $category->id)}} " method="post" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-2 text-white bg-red-500 border border-red-500 rounded hover:bg-red-700 by-2">🗃️ Archive</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-5">
            {{ $categories->links() }}
        </div>
    </div>
</x-app-layout>
