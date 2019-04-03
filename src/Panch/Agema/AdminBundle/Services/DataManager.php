<?php

namespace Panch\Agema\AdminBundle\Services;

use Symfony\Component\PropertyAccess\PropertyAccessor;

class DataManager
{
    /**
     * This method remove object by slug
     *
     * @param object $object    Object to remove
     * @param object $manager   Object Relational Mapper (ORM) or Object Document Mapper (ODM)
     * @param string $slug      Criteria to remove
     */
    public function removeObject($object, $manager, $slug)
    {
        if ($object == !null && $object->getSlug() == $slug) {
            $manager->remove($object);
        }
    }

    /**
     * This method update the object properties changes
     *
     * @param object $object     Object created now with changes
     * @param object $oldObj     Old object without changes
     * @return object $oldObj    Old object with updated properties
     * @throws \Exception
     */
    public function updateObject($object, $oldObj)
    {
        if ($oldObj == null) {
            throw new \Exception('Classes must be equals');
        } elseif (get_class($oldObj) != get_class($object)) {
            throw new \Exception('Object should not be empty');
        }

        $accessor = new PropertyAccessor();
        $reflect = new \ReflectionClass($oldObj);

        $properties = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PRIVATE);

        foreach ($properties as $property) {
            $propertyName = $property->getName();
            $value = $accessor->getValue($object, $propertyName);

            if ($value == !null && $value !== $accessor->getValue($oldObj, $propertyName)) {
                $accessor->setValue($oldObj, $propertyName, $value);
            }
        }

        return $oldObj;
    }
}
