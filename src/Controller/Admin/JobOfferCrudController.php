<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
      
            TextField::new('title'),
            TextField::new('closedAt'),
            TextField::new('position'),
            TextField::new('location'),
            IdField::new('salary'),
            TextField::new('ref'),
            TextField::new('description'),
            TextField::new('status'),
            TextField::new('ref'),
            // relations/////////////////////
            AssociationField::new('contractType'),
            AssociationField::new('category'),
            AssociationField::new('company'),
           
        ];
    }
    
}
