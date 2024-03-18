<?php

namespace App\Controller\Admin;

use App\Entity\Candidats;
use App\Entity\Candidatures;
use App\Entity\Category;
use App\Entity\Company;
use App\Entity\ContractType;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobOffer;
use App\Entity\Media;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
         return $this->render('/admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('My Project Directory');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Manage company', 'fa-solid fa-building', Company::class);
        yield MenuItem::linkToCrud('Manage joboffer', 'fa-brands fa-creative-commons-nd', JobOffer::class);
        yield MenuItem::linkToCrud('Manage candidats', 'fa-solid fa-person', Candidats::class);
        yield MenuItem::linkToCrud('Manage candidatures', 'fas fa-list', Candidatures::class);
        yield MenuItem::linkToCrud('Manage user', 'fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Manage category', 'fa-solid fa-list', Category::class);
        yield MenuItem::linkToCrud('Manage contracttype', 'fa-solid fa-file-contract', ContractType::class);
        yield MenuItem::linkToCrud('Manage experience', 'fas fa-list', Experience::class);
        yield MenuItem::linkToCrud('Manage gender', 'fa-solid fa-venus-mars', Gender::class);
        yield MenuItem::linkToCrud('Manage media', 'fa-solid fa-photo-film', Media::class);

        

    }
}
