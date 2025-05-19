<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::with('category')
                    ->where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        $todosCompleted = $todos->where('is_done', true)->count();

        return view('todo.index', compact('todos', 'todosCompleted'));
    }

    public function create()
    {
        $categories = Category::where('user_id', Auth::id())->get();
        return view('todo.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Todo::create([
            'title'       => ucfirst($request->title),
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'is_done'     => false,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    public function edit(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to edit this todo!');
        }

        $categories = Category::where('user_id', Auth::id())->get();
        return view('todo.edit', compact('todo', 'categories'));
    }

    public function update(Request $request, Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to update this todo!');
        }

        $request->validate([
            'title' => 'required|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update([
            'title'       => ucfirst($request->title),
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully!');
    }

    public function complete(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to complete this todo!');
        }

        $todo->update(['is_done' => true]);
        return redirect()->route('todo.index')->with('success', 'Todo marked as completed!');
    }

    public function uncomplete(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to uncomplete this todo!');
        }

        $todo->update(['is_done' => false]);
        return redirect()->route('todo.index')->with('success', 'Todo marked as not completed.');
    }

    public function destroy(Todo $todo)
    {
        if (Auth::id() !== $todo->user_id) {
            return redirect()->route('todo.index')->with('danger', 'You are not authorized to delete this todo!');
        }

        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully!');
    }

    public function destroyCompleted()
    {
        Todo::where('user_id', Auth::id())
            ->where('is_done', true)
            ->delete();

        return redirect()->route('todo.index')->with('success', 'All completed todos deleted successfully!');
    }
}
