<?php

namespace App\Form;

use App\Entity\Address;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number',TextType::class, ["label" => "Numero"])
            ->add('type',TextType::class, ["label" => "Type de voie"])
            ->add('name',TextType::class, ["label" => "Nom de la rue"])
            ->add('zipcode',TextType::class, ["label" => "Code postal"])
            ->add('city',TextType::class, ["label" => "Ville"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
