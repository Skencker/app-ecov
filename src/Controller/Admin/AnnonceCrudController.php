<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class AnnonceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Annonce::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name','Nom')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            SlugField::new('slug')->setTargetFieldName('name')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            AssociationField::new('user', 'Vendeur')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            AssociationField::new('category','Catégorie')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            AssociationField::new('deal','Type de vente')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            IntegerField::new('price','Prix')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            TextareaField::new('description','Description')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            DateField::new('create_at', 'Date de publication')->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
            ImageField::new('image')
                ->setUploadDir('public/uploads/images')
                ->setBasePath('uploads/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false)
                ->setColumns('col-sm-12 col-lg-7 col-xxl-6'),
        ];
    }
}
