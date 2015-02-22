<?php

namespace Panch\Agema\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Panch\Agema\AgemaBundle\Entity\Product;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('shortDescription')
            ->add('colorCorrection')
            ->add('clearAperture')
            ->add('focalLength')
            ->add('resolution')
            ->add('magnificationRange')
            ->add('limitVisualMagnitude')
            ->add('tube')
            ->add('focuser')
            ->add('fieldCorrector')
            ->add('thumbnail', 'file')
            ->add('category', 'entity', [
                'mapped' => true,
//                'data'   => $this->getName(),
                'class'  => 'Panch\Agema\AgemaBundle\Entity\Category'
            ])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'      => 'Panch\Agema\AgemaBundle\Entity\Product',
            'intention'       => 'panch_agema_adminbundle_product',
            'csrf_protection' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'panch_agema_adminbundle_product';
    }
}
