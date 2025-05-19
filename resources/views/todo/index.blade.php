<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    <div class="flex items-center justify-between mb-6">
                        <!-- Tombol Create warna putih -->
                        <a href="{{ route('todo.create') }}"
                           class="bg-white text-gray-800 border border-gray-400 font-semibold text-sm px-5 py-2 rounded shadow hover:bg-gray-100 dark:bg-white dark:text-gray-800 dark:hover:bg-gray-200 transition">
                            CREATE
                        </a>

                        <!-- Notifikasi session -->
                        <div>
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
                    </div>

                    <!-- Tabel Todos -->
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3">Title</th>
                                    <th class="px-6 py-3">Category</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($todos as $todo)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 text-center">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white text-left">
                                            <a href="{{ route('todo.edit', $todo) }}" class="hover:underline">
                                                {{ $todo->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $todo->category->title ?? '-' }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($todo->is_done)
                                                <span class="bg-green-100 text-green-800 text-xs font-medium px-3 py-1 rounded-full">
                                                    Completed
                                                </span>
                                            @else
                                                <span class="bg-red-100 text-red-800 text-xs font-medium px-3 py-1 rounded-full">
                                                    On Going
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 space-x-1">
                                            @if (!$todo->is_done)
                                                <form action="{{ route('todo.complete', $todo) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-green-600 hover:bg-green-700 text-white text-xs px-3 py-1 rounded">
                                                        Done
                                                    </button>
                                                </form>
                                            @else
                                                <form action="{{ route('todo.uncomplete', $todo) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                            class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded">
                                                        Undo
                                                    </button>
                                                </form>
                                            @endif

                                            <form action="{{ route('todo.destroy', $todo) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="bg-red-600 hover:bg-red-700 text-white text-xs px-3 py-1 rounded">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            No todos found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Hapus semua yang sudah selesai -->
                    @if ($todosCompleted > 1)
                        <div class="mt-6 text-right">
                            <form action="{{ route('todo.deleteallcompleted') }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded text-sm">
                                    Delete All Completed Tasks
                                </button>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
