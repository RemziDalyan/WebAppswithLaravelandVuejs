<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TodoItem;


class TodoController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()->todos()->latest()->get();   
    }
    public function toggle(/*$id*/ TodoItem $todo, Request $request)
    {
        //$todo = TodoItem::findOrFail($id);
        if($request->user()->id != $todo->user_id) return abort(403);
        $todo->toggle();
        $todo->save();
        return $todo;
    }
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|min:3|max:250'
        ]);

        $todo = new TodoItem;
        $todo->user_id = $request->user()->id;
        $todo->text = $request->todo;
        $todo->completed_at = null;
        $todo->save();
        return $todo;
    }
}
