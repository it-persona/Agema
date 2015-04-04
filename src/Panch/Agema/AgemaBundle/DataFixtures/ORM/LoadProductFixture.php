<?php

namespace Panch\Agema\AgemaBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Panch\Agema\AgemaBundle\Entity\Product;
use Panch\Agema\AgemaBundle\Entity\Category;

class LoadProductFixture extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load fixtures data for Category and Product.
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $category = new Category();
        $category->setCategoryName('Refractors');

        $product = new Product();

        $product
            ->setTitle('Agema SD-180')
            ->setShortDescription('This is short description about current product')
            ->setClearAperture('180 mm /7.1 inch')
            ->setColorCorrection('Focus color variations are less than 0.006% focal length from 420 to 706 nm (for high pupil zone), melt controlled optics.')
            ->setFieldCorrector('Tree lens constructions, 62mm front lens, 84X1 (ID) mm connecting thread. All lenses are with broad-band antireflection coating (420-700nm). Linear field is 40 mm @ F9.2 Black anodizing finish.')
            ->setFocalLength('620 mm, f/9 ratio')
            ->setFocuser('86 mm /3.4 inch OD Draw Tube with M84X1 (OD) connecting thread, 145 mm focusing travel. All metal constructions (excluding bearing pads). Two speed with ~1:10 Fine/Coarse ratio and direct to pinion shaft drum-type brake that keeps about 10 lbs load. Rack has very fine (80) diametral pitch for smooth, backlash free movement. Black anodizing exterior. Focuser is capable to be turned to any required observing position.')
            ->setLimitVisualMagnitude(13.8)
            ->setMagnificationRange('from 30X to 450X')
            ->setResolution(0.63)
            ->setTube('Aluminum, 200 mm OD, Light grey color, powder coating, baffled, flat black interior, special  design fine adjustment cell.')
            ->setCategory($category);

        $manager->persist($category);
        $manager->persist($product);
        $manager->flush();
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return 1;
    }
}
