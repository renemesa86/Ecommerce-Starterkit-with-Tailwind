<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('search')) {

            $search = $request->input('search'); 

            $tags = Tag::categories()->where('name', 'LIKE', '%' . $search . '%')
                ->paginate(20);

        } else {
            $tags = Tag::categories()->paginate(20);
        }

        return view('categorias.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbbiden');

        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'string|required'
        ]);

        $category = Tag::create($validatedData);

        return redirect()->route('categorias.index')->with('success', 'La etiqueta fue creada satisfactoriamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $category)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('categorias.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $category)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //dd($category);
        return view('categorias.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $category)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'string|required'
            ]);

            $category->update([
                'name' => $validatedData['name']
            ]);

            //$tag->save();

            return redirect()->route('categorias.index')->with('success', "La etiqueta fue actualizada satisfactoriamente");
        } catch (ValidationException $e) {
            $errors = $e->validator->errors();
            return redirect()->back()->withErrors($errors)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error inesperado: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $category)
    {
        abort_if(Gate::denies('tags_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $category->delete();

        return redirect()->route('categorias.index');
    }
}
