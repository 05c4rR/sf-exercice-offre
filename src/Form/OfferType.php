<?php

namespace App\Form;

use App\Entity\Location;
use App\Entity\Offer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title',TextType::class, [
                'label' => 'Libellé du poste'
            ])
            ->add('description',TextareaType::class, [
                'label' => 'Descriptif'
            ])
            ->add('postDate', DateType::class, [
                'label'  => 'Date de mise en ligne',
                'widget' => 'single_text',
            ])
            ->add('visible',CheckboxType::class, [
                'label' => 'Rendre le poste disponible',
                'required' => false,
            ])
            ->add('location', EntityType::class, [
                'label'  => 'Ville de prise de poste',
                'class' => Location::class,
                'choice_label' => 'name',
            ])
            ->add('enregistrer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Offer::class,
        ]);
    }
}
