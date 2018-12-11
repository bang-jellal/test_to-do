<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Todo::orderBy('created_at', 'asc')->get();

        return view('todo.index', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = Todo::create(['name' => $request->input('todo')]);
        $html = view()->make('todo._template_todo', compact('item'))->render();

        return response()->json($html);
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        $todos_id = $request->input('todos_id', []);
        Todo::destroy($todos_id);

        return redirect()->route('todo.index');
    }
}
