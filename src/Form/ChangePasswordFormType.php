<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password',
                        ]),  // Champ de mot de passe

                        new Length([
                            'min' => 12,
                            'minMessage' => 'Your password should be at least {{ limit }} characters',
                            'max' => 4096,
                        ]),  // Contraintes de longueur pour le mot de passe
                    ],
                    'label' => 'New password',  // Étiquette pour le nouveau mot de passe
                ],
                'second_options' => [
                    'label' => 'Repeat Password',  // Étiquette pour la confirmation du mot de passe
                ],
                'invalid_message' => 'The password fields must match.',  // Message en cas de non-correspondance
                'mapped' => false,  // Non lié à l'objet directement, lu et encodé dans le contrôleur
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
