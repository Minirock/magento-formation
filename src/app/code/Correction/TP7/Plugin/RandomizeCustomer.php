<?php

namespace Correction\TP7\Plugin;

use Magento\Customer\Model\ResourceModel\Customer as CustomerResource;
use Magento\Eav\Model\Entity\AbstractEntity;
use Magento\Framework\Model\AbstractModel;

/**
 * Class RandomizeCustomer
 * @package Correction\TP7\Plugin
 */
class RandomizeCustomer
{
    /**
     * @param CustomerResource $subject
     * @param \Closure $proceed
     * @param $object
     * @param $entityId
     * @param array $attributes
     */
    public function aroundLoad(CustomerResource $subject, \Closure $proceed, $object, $entityId, $attributes = [])
    {
        if($object->getData('random'))
        {
            /** @var $object \Magento\Customer\Model\Customer */
            $firstname = $this->getRandomElement([
                'Albert', 'Bertrand', 'Charles', 'Damien', 'Etienne', 'Franck', 'Gauthier', 'Hubert',
                'Isidore', 'Jacques', 'Kévin', 'Laurent', 'Marcel', 'Norbert', 'Olivier', 'Pierre',
                'Quentin', 'Romain',  'Steven', 'Thierry', 'Ulrich', 'Vivian', 'William', 'Xavier',
                'Yves', 'Zachary'
            ]);
            $lastname = $this->getRandomElement([
                'Truc', 'Machin', 'Bidule', 'Chose'
            ]);
            $email = strtolower(substr($firstname, 0, 1).$lastname).'+test@clever-age.com';
            $object->setData([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email
            ]);
            return $subject;
        }
        else
        {
            return $proceed($object, $entityId, $attributes);
        }
    }

    protected function getRandomElement($array)
    {
        $key = array_rand($array);
        return $array[$key];
    }
}