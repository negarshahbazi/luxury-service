<?php

namespace App\Form;

use App\Entity\Candidats;
use App\Entity\Category;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\Media;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CandidatsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('address')
            ->add('country')
            ->add('nationalite')
            ->add('birthDate', null, [
                'widget' => 'single_text',
                'label'=>' ',
            ])
            ->add('birthPlace')
            ->add('currentLocation')
            // ->add('disponibilite')
            ->add('description')
            ->add('gender', EntityType::class, [
                'class' => Gender::class,
                'choice_label' => 'gender',
                'label'=>' ',
                'label_attr' => [
                    'class' => 'active',
                ],
            ])
            ->add('photo', FileType::class, [
        // unmapped means that this field is not associated to any entity property
                    'mapped' => false,
                    // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,
                'attr' => [
                    'id' => 'photo',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'photo',
                    'type' => 'file'
                ]
            ])
            ->add('passeport', FileType::class, [
                'mapped' => false, // permet de ne pas hydrater l'entité
                'required' => false,
                'attr' => [
                    'id' => 'passport',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'passport',
                    'type' => 'file'
                ]
            ])
            ->add('cv', FileType::class, [
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'id' => 'cv',
                    'size' => '20000000',
                    'accept' => '.pdf,.jpg,.doc,.docx,.png,.gif',
                    'name' => 'cv',
                    'type' => 'file'
                ]
            ])
            // ->add ('user', UserType::class)
            ->add('experience', EntityType::class, [
                'class' => Experience::class,
                'choice_label' => 'experience',
                'label'=>' '
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'category',
                'label'=>' '
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Candidats::class,
        ]);
    }
}
