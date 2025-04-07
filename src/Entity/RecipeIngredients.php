<?php

namespace App\Entity;

use App\Repository\RecipeIngredientsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeIngredientsRepository::class)]
class RecipeIngredients
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $recipe_id = null;

    #[ORM\Column]
    private ?int $ingredient_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipeId(): ?int
    {
        return $this->recipe_id;
    }

    public function setRecipeId(int $recipe_id): static
    {
        $this->recipe_id = $recipe_id;

        return $this;
    }

    public function getIngredientId(): ?int
    {
        return $this->ingredient_id;
    }

    public function setIngredientId(int $ingredient_id): static
    {
        $this->ingredient_id = $ingredient_id;

        return $this;
    }
}
