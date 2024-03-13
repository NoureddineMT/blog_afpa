<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstName', TextType::class, [
            'label' => 'Prénom',
            'attr' => [
                'placeholder' => 'Votre prénom'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Votre prénom doit être renseigné']),
                new Length(['min' => 2, 'minMessage' => 'Votre prénom doit faire minimum 2 caractères']),
            ],
            
        ])
        ->add('lastName', TextType::class, [
            'label' => 'Nom',
            'attr' => [
                'placeholder' => 'Votre nom'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Votre nom doit être renseigné']),
                new Length(['min' => 2, 'minMessage' => 'Votre nom doit faire minimum 2 caractères']),
            ],
            
        ])
        ->add('email', EmailType::class, [
            'label' => 'Email',
            'attr' => [
                'placeholder' => 'Votre email'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Votre email doit être renseigné']),
                new Email(['message' => 'Veuillez renseigner un email valide!']),
            ],
            
        ])
        ->add('adresse', TextType::class, [
            'label' => 'Addresse',
            'attr' => [
                'placeholder' => 'Votre Addresse'
            ],
            'constraints' => [
                new NotBlank(['message' => 'Votre adresse doit être renseignée']),
            ],
            
        ])
            ->add('code_postale', TextType::class, [
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 5,
                        'exactMessage' => 'Le code postal doit contenir exactement 5 chiffres.',
                    ]),
                ],
            ])
            ->add('picture')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Entrez un Mot de Passe',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Votre Mot de Passe doit faire au moins {{ limit }} caractères',
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'Nouveau Mot de Passe',
                    'row_attr' => [
                        'class' => 'col-12'
                    ]
                ],
                'second_options' => [
                    'label' => 'Répétez le nouveau mot de passe',
                    'row_attr' => [
                        'class' => 'col-12'
                    ]
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
