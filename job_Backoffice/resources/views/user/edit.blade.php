<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit User Password') }}
        </h2>
    </x-slot>

    <div class="p-6 overflow-x-auto">
        <form action=" {{route('users.update', ['user' => $users->id, 'redirectToList' => request()->query('redirectToList') ])}} " method="post">
            @csrf
            @method('PUT')
            <div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow-md">

                <div class="p-6 mb-4 border border-gray-100 rounded-lg shadow-sm bg-gray-50">
                    <span class="mt-3 mb-2 text-blue-700">Edit User Password</span>

                    <div class="mt-3 mb-2">
                        <label for="title" class="block text-sm font-medium text-gray-700">User Name</label>
                        <span> {{ $users->name }} </span>
                    </div>

                    <div class="mt-3 mb-2">
                        <label for="salary" class="block text-sm font-medium text-gray-700">Email</label>
                        <span> {{ $users->email }} </span>
                    </div>

                    <div class="mt-3 mb-2">
                        <label for="company_id" class="block text-sm font-medium text-gray-700">Role</label>
                        <span>{{ $users->role }}</span>
                    </div>

                    <!-- Password -->
                    <div class="mt-4 mb-2">

                        <label for="password" class="block text-sm font-medium text-gray-700">User Password</label>
                        <div class="relative" x-data="{ showPassword: false }">

                            <x-text-input id="password" class="block w-full mt-1" x-bind:type="showPassword ? 'text' : 'password'" name="password"
                                autocomplete="current-password" />

                            <button @click="showPassword =!showPassword" type="button" class="absolute inset-y-0 flex items-center text-gray-500 right-2">
                                <svg x-show="!showPassword" class="w-5 h-5" width="800px" height="800px" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>

                                <svg x-show="showPassword" class="w-5 h-5" width="800px" height="800px" viewBox="0 0 24 24"
                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                <div class="flex justify-end space-x-2">
                    <button type="submit" class="px-2 py-4 text-white bg-blue-500 border border-blue-500 hover:bg-blue-700 rounded-xl">Update User Password</button>

                    <a href="{{route('job-applications.index')}}" class="px-2 py-4 text-gray-500 hover:text-gray-700 rounded-xl">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
