@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-gray-900 text-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">Todo</h1>

        <form action="{{ route('todo.update', $todo) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Input Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Title</label>
                <input type="text" name="title" id="title"
                       value="{{ old('title', $todo->title) }}"
                       class="w-full bg-gray-800 border border-gray-700 rounded-md py-2 px-3 text-white focus:outline-none focus:ring focus:ring-blue-500"
                       required>
            </div>

            <!-- Select Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-300 mb-1">Category</label>
                <select name="category_id" id="category_id"
                        class="w-full bg-gray-800 border border-gray-700 rounded-md py-2 px-3 text-white focus:outline-none focus:ring focus:ring-blue-500">
                    <option value="">Empty</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id', $todo->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                        class="bg-white text-black font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                    SAVE
                </button>
                <a href="{{ route('todo.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-md transition">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
