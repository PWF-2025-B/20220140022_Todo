<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">

                {{-- Bagian tombol create dan notifikasi --}}
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}" />
                        </div>
                    </div>

                    @if (session('success'))
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-green-600 dark:text-green-400">
                            {{ session('success') }}
                        </p>
                    @endif

                    @if (session('danger'))
                        <p x-data="{ show: true }" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 5000)"
                            class="text-sm text-red-600 dark:text-red-400">
                            {{ session('danger') }}
                        </p>
                    @endif
                </div>

                {{-- Bagian tabel --}}
                <div class="relative overflow-x-auto">
                    <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Title</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                            {{ $todo->title }}
                                        </a>
                                    </td>
                                    <td class="hidden px-6 py-4 md:block">
                                        @if (!$todo->is_complete==false)
                                            <span class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                Ongoing
                                            </span>
                                        @else
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                Completed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            <!-- Tambahkan tombol edit/delete di sini jika diperlukan -->
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white" colspan="3">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
