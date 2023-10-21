<?php

namespace App\Form;

use App\Entity\Image;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ pour le fichier d'image
            ->add('imageFile', FileType::class, [
                'label' => 'Image',
                'required' => true, // Définissez à true si le champ est obligatoire
            ])
            // Champ pour le nom de l'image
            ->add('name', null, [
                'label' => 'Nom de l\'image',
                'required' => true, // Définissez à true si le champ est obligatoire
            ])
            // Champ pour la description de l'image
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'image',
                'required' => false, // Définissez à true si le champ est obligatoire
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Image::class,
        ]);
    }
}
