<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::with('user')->latest()->paginate(9);
        return view('recipes.index', compact('recipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $recipe = new Recipe();
        $recipe->title = $request->title;
        $recipe->description = $request->description;
        $recipe->user_id = auth()->id();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('recipes', 'public');
            $recipe->photo = $path;
        }

        $recipe->save();

        return redirect()->back()->with('success', 'Recipe created successfully!');
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif'
        ]);

        $recipe->title = $request->title;
        $recipe->description = $request->description;

        if ($request->hasFile('photo')) {
            if ($recipe->photo) {
                Storage::disk('public')->delete($recipe->photo);
            }
            $path = $request->file('photo')->store('recipes', 'public');
            $recipe->photo = $path;
        } elseif ($request->remove_photo) {
            Storage::disk('public')->delete($recipe->photo);
            $recipe->photo = null;
        }

        $recipe->save();

        return redirect()->back()->with('success', 'Recipe updated successfully!');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->photo) {
            Storage::disk('public')->delete($recipe->photo);
        }

        $recipe->delete();

        return redirect()->back()->with('success', 'Recipe deleted successfully!');
    }

    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }
}
