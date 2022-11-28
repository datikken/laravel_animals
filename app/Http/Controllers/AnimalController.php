<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use App\Models\Category;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function killEmAll()
    {
        Animal::truncate();

        return response()->json([
            'error' => false,
            'data' => 'ok'
        ]);
    }

    public function age(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required'
        ]);

        $animal = Animal::where('name', $validated['name'])->first();

        if(is_null($animal))
        {
            return response()->json([
                'error' => true,
                'data'=> 'Animal with given name does not exist'
            ]);
        }

        if($animal->age < $animal->category->max_age)
        {
            $animal->update([
                'age' => ++$animal->age,
            ]);

            if($animal->size < $animal->category->max_size)
            {
                $animal->update([
                    'size' => $animal->size * $animal->category->growth_factor
                ]);
            }
        }

        return response()->json([
            'error' => false,
            'data' => $animal
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'kind' => 'required'
        ]);

        $category = Category::where('kind', $validated['kind'])->first();

        if(is_null($category))
        {
            return response()->json([
                'error' => true,
                'data' => 'Try another kind'
            ]);
        }

        if(!is_null(Animal::where('category_id', $category->id)->first()))
        {
            return response()->json([
               'error'=>true,
               'data'=> 'This kind of animal already created'
            ]);
        }

        Animal::create([
            'name' => $validated['name'],
            'age' => 1,
            'size' => 1,
            'category_id' => $category->id
        ]);

        return response()->json([
            'error' => null,
            'data' => 'ok'
        ]);
    }
}
