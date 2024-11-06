<?php

namespace App\Policies;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class RecipePolicy
{

    public function update(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }

    public function delete(User $user, Recipe $recipe)
    {
        return $user->id === $recipe->user_id;
    }

}
