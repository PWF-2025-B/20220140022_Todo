@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-10">
    <div class="bg-gray-900 text-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">Todo Category</h1>

        <!-- Tombol CREATE -->
        <div class="mb-4">
            <a href="{{ route('categories.create') }}"
               class="bg-white text-black font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                CREATE
            </a>
        </div>

        <!-- Tabel -->
        <div class="overflow-x-auto">
            <table class="w-full bg-gray-800 rounded-lg text-sm">
                <thead class="bg-gray-700 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Name</th>
                        <th class="px-6 py-3 text-left">Todos</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-gray-700">
                            <td class="px-6 py-4">{{ $category->name }}</td>
                            <td class="px-6 py-4">{{ $category->todos_count }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-4">
                                    <a href="{{ route('categories.edit', $category) }}" class="text-blue-400 hover:text-blue-600">
                                        Edit
                                    </a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-600">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="px-6 py-4 text-center text-gray-400">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
