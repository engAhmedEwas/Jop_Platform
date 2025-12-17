<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Users') }} {{ request()->input("archived") == 'true' ? "(Archived)" : "" }}
        </h2>
    </x-slot>

    <div class="p-3 overflow-x-auto">

        <x-notification />

        <div class="flex items-center justify-end space-x-4">

            @if(request()->input("archived") == 'true')
                    <!-- Active Applications -->
                    <a href="{{ route('users.index') }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Active Users
                    </a>

            @else
                    <!-- Archived Company -->
                    <a href="{{ route('users.index', ['archived' => 'true']) }}"
                        class="px-2 py-4 mt-3 text-white bg-black border border-black hover:bg-gray-800 rounded-xl">
                        Archived Users
                    </a>

            @endif

        </div>


        <table class="min-w-full mt-4 bg-white divide-y divide-gray-200 rounded-lg shadow">
            <thead>
                <tr>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Name</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Email</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Role</th>
                    <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b">
                        <td class="px-6 py-4 text-gray-800"> {{ $user->name }}</td>
                        <td class="px-6 py-4 text-gray-500"> {{ $user->email }} </td>
                        <td class="px-6 py-4 text-gray-500"> {{ $user->role }} </td>
                        <td>
                            <div class="flex space-x-4">

                            @if(request()->input("archived") == 'true')
                                <form action=" {{route('users.restore', $user->id)}} " method="post" class="inline-block">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="px-2 text-blue-500 rounded hover:text-blue-700 by-2">
                                        🔄 Restore </button>
                                </form>
                            @else
                                @if($user->role != "admin")
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="px-2 text-white bg-blue-500 border border-blue-500 rounded hover:bg-blue-700 by-2">
                                            ✍️ Edit</a>
                                    <form action=" {{route('users.destroy', $user->id)}} " method="post" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2 text-white bg-red-500 border border-red-500 rounded hover:bg-red-700 by-2">
                                                🗃️ Archive</button>
                                    </form>
                                @endif
                            @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="px-6 py-4 text-gray-800"> No Users Found </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-5">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
