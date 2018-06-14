<?php
/**
 * Created by PhpStorm.
 * User: iPwne
 * Date: 11/06/2018
 * Time: 17:44
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class CommentFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Commentaire', TextareaType::class,[
                    'attr' => [
                        'class' => ''
                    ]
                ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => ''
                ]
            ])

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Comment'
        ));
    }

}