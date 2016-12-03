<?php

namespace Blog\ModelBundle\Form;

use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('author', EntityType::class, array(
                'label' => 'author.title',
                'class' => Author::class,
                'choice_label' => 'name'
            ))
            ->add('tags', EntityType::class, array(
                'label' => 'tags',
                'class' => Tag::class,
                'choice_label' => 'name',
                'multiple' => true
            ));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Blog\ModelBundle\Entity\Post'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'blog_modelbundle_post';
    }


}
