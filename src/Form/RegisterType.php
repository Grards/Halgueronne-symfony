<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegisterType extends AbstractType
{
   /**
     * Permet d'avoir la configuration de base d'un champ
     * 
     * @param string $label
     * @param string $placeholder
     * @return array
     */
    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('login', TextType::class, $this->getConfiguration("","Minimum 3 caractères"))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe","Minimum 6 caractères"))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation","veuillez confirmer votre mot de passe"))
            ->add('mail', EmailType::class, $this->getConfiguration("Email","Ex : exemple@mail.com"))
            ->add('avatar', UrlType::class, ['attr'=>['placeholder' => "Ex : http://www.urlavatar.com"], 'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
