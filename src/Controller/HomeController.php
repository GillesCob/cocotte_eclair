<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;




class HomeController extends AbstractController
{

    #[Route('/accueil', name: 'home_page')]
    public function home(): Response
    {
        return $this->render('home_page.html.twig');
    }

    #[Route('/vos_recettes', name: 'recipes')]
    public function recipes(): Response
    {
        return $this->render('recipes.html.twig');
    }

    #[Route('/recettes_publiques', name: 'public_recipes')]
    public function public_recipes(): Response
    {
        return $this->render('public_recipes.html.twig');
    }

    #[Route('/courses', name: 'shopping')]
    public function shopping(): Response
    {
        return $this->render('shopping.html.twig');
    }

    #[Route('/semaine', name: 'week')]
    public function week(): Response
    {
        return $this->render('week.html.twig');
    }

    #[Route('/recherche', name: 'search')]
    public function search(): Response
    {
        return $this->render('search.html.twig');
    }

    #[Route('/ajouter', name: 'add_recipe')]
    public function add_recipe(): Response
    {
        return $this->render('add_recipe.html.twig');
    }

    #[Route('/voir_recette', name: 'see_recipe')]
    public function see_recipe(): Response
    {
        return $this->render('recipe.html.twig');
    }

    #[Route('/connexion', name: 'login')]
    public function login(): Response
    {
        return $this->render('login.html.twig');
    }

    #[Route('/inscription', name: 'register')]
    public function register(): Response
    {
        return $this->render('register.html.twig');
    }


    



}
