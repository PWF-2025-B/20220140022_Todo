@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-8">
    <div class="bg-gray-900 text-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">Todo</h1>

        <div class="mb-4">
            <a href="{{ route('todo.create') }}"
               class="bg-white text-black font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                CREATE
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full table-auto rounded-lg text-sm">
                <thead class="bg-gray-800 text-white uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Title</th>
                        <th class="px-6 py-3 text-left">Category</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse ($todos as $todo)
                        <tr class="hover:bg-gray-800">
                            <td class="px-6 py-4">{{ $todo->title }}</td>
                            <td class="px-6 py-4">{{ $todo->category->name ?? 'Empty' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $todo->is_complete ? 'bg-green-500 text-white' : 'bg-blue-600 text-white' }}">
                                    {{ $todo->is_complete ? 'Completed' : 'Ongoing' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <form action="{{ route('todo.toggleComplete', $todo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="text-green-400 hover:text-green-600">
                                        {{ $todo->is_complete ? 'Undo' : 'Complete' }}
                                    </button>
                                </form>
                                <a href="{{ route('todo.edit', $todo) }}" class="text-blue-400 hover:text-blue-600">
                                    Edit
                                </a>
                                <form action="{{ route('todo.destroy', $todo) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400">No todos available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
