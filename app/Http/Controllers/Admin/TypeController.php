<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

    
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    
    public function edit(Type $type)
    {
        //
    }

    
    public function update(Request $request, Type $type)
    {
        //
    }

    
    public function destroy(Type $type)
    {
        //
    }
}
