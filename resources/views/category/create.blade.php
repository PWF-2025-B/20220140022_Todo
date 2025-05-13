@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    <div class="bg-gray-900 text-white rounded-xl shadow-md p-6">
        <h1 class="text-2xl font-semibold mb-6">Create Category</h1>

        <form action="{{ route('categories.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Input Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-1">Category Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}"
                       class="w-full bg-gray-800 border border-gray-700 rounded-md py-2 px-3 text-white focus:outline-none focus:ring focus:ring-blue-500"
                       required>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4">
                <button type="submit"
                        class="bg-white text-black font-semibold px-4 py-2 rounded-md hover:bg-gray-200 transition">
                    SAVE
                </button>
                <a href="{{ route('categories.index') }}"
                   class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-4 py-2 rounded-md transition">
                    CANCEL
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
