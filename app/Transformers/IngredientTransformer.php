<?php

namespace App\Transformers;

use App\Models\Ingredient;
use League\Fractal\TransformerAbstract;

class IngredientTransformer extends TransformerAbstract
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        //
    ];
    
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = [
        //
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ingredient $ingredient)
    {
        return [
            'name' => $ingredient->name,
            'slug' => $ingredient->slug,
            'description' => $ingredient->description,
        ];
    }
}
