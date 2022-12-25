<?php

namespace App\Controller\Admin;

use App\Entity\Author;
use App\Entity\Book;
use App\Entity\User;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Tp2symfony');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('HOME', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Books', 'fas fa-book', Book::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-tags', Category::class);
        yield MenuItem::linkToCrud('Authors', 'fas fa-pen', Author::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
