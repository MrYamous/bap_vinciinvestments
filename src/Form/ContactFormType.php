<?php
/**
 * Created by PhpStorm.
 * User: iPwne
 * Date: 18/06/2018
 * Time: 17:55
 */

namespace App\Form;


use function PHPSTORM_META\type;
use function Sodium\add;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Button;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'VOTRE NOM'
            ])
            ->add('email', TextType::class, [
                'label' => 'VOTRE EMAIL'

            ])
            ->add('subject', TextType::class, [
                'label' => 'SUJET'

            ])
            ->add('message', TextareaType::class,[
                'label' => 'VOTRE MESSAGE',
                'attr' => [
                    'class' => 'contactText'
                ]
            ])
            /*->add('Envoyer', SubmitType::class, [
                'value' => 'ENVOYER',
                'attr' => [
                    'class' => 'button'
                ]
            ]) */

        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Contact'
        ));
    }
}