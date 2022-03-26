<?php

namespace App\Transformers;

use App\Models\Recipe;
use League\Fractal\TransformerAbstract;

class RecipeTransformer extends TransformerAbstract
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
        'ingredients'
    ];
    
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Recipe $recipe)
    {
        return [
            'name' => $recipe->name,
            'slug' => $recipe->slug,
            'category' => $recipe->category->name,
            'description' => $recipe->description,
        ];
    }

    public function includeIngredients($recipe)
    {
        return $this->collection($recipe->details, new RecipeDetailTransformer());
    }
}
