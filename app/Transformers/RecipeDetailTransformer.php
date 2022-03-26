<?php

namespace App\Transformers;

use App\Models\Recipe;
use App\Models\RecipeIngredient;
use League\Fractal\TransformerAbstract;

class RecipeDetailTransformer extends TransformerAbstract
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
    public function transform(RecipeIngredient $recipeIngredient)
    {
        return [
            'ingredient' => $recipeIngredient->ingredient->name,
            'amount' => $recipeIngredient->amount,
        ];
    }
}
