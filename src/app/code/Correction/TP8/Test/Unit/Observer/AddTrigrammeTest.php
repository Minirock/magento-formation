<?php

namespace Correction\TP8\Test\Unit\Observer;

use Magento\Customer\Model\Customer;
use PHPUnit\Framework\TestCase;

class AddTrigrammeTest extends TestCase
{
    /** @var \Correction\TP7\Observer\AddTrigramme */
    protected $observer;

    /** @var string  */
    protected $trigramme = '';

    /**
     * @throws \ReflectionException
     */
    protected function setUp()
    {
        $objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);
        $this->observer = $objectManager->getObject(\Correction\TP7\Observer\AddTrigramme::class);
    }

    /**
     * @throws \ReflectionException
     */
    public function testTrigramme()
    {
        $customerMock = $this->createMock(Customer::class);
        $customerMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('firstname'))->will($this->returnValue('Alex'));
        $customerMock->expects($this->at(1))
            ->method('getData')->with($this->equalTo('lastname'))->will($this->returnValue('Khayrullin'));
        $customerMock->expects($this->at(2))
            ->method('setData')->with(
                $this->equalTo('trigramme'), $this->equalTo('AKH')
            )->will($this->returnValue($customerMock));

        $eventMock = $this->createMock(\Magento\Framework\Event::class);
        $eventMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('customer'))->will($this->returnValue($customerMock));

        $observerMock = $this->createMock(\Magento\Framework\Event\Observer::class);
        $observerMock->expects($this->at(0))
            ->method('getEvent')->will($this->returnValue($eventMock));
        $this->observer->execute($observerMock);
    }

    /**
     *
     */
    public function testSimple()
    {
        $this->assertGreaterThan(1,2 );
    }

    /**
     * @throws \ReflectionException
     */
    public function testADU()
    {
        $customerMock = $this->createMock(Customer::class);
        $customerMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('firstname'))->will($this->returnValue('Alain'));
        $customerMock->expects($this->at(1))
            ->method('getData')->with($this->equalTo('lastname'))->will($this->returnValue('Dupont'));
        $customerMock->expects($this->at(2))
            ->method('setData')->with(
                $this->equalTo('trigramme'), $this->equalTo('ADU')
            )->will($this->returnValue($customerMock));

        $eventMock = $this->createMock(\Magento\Framework\Event::class);
        $eventMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('customer'))->will($this->returnValue($customerMock));

        $observerMock = $this->createMock(\Magento\Framework\Event\Observer::class);
        $observerMock->expects($this->at(0))
            ->method('getEvent')->will($this->returnValue($eventMock));
        $this->observer->execute($observerMock);
    }

    /**
     * @throws \ReflectionException
     */
    public function testNotADL()
    {
        $customerMock = $this->createMock(Customer::class);
        $customerMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('firstname'))->will($this->returnValue('Alain'));
        $customerMock->expects($this->at(1))
            ->method('getData')->with($this->equalTo('lastname'))->will($this->returnValue('Dupont'));
        $customerMock->method('setData')->willReturnCallback(function ($key, $value) {
            $this->trigramme = $value;
        });

        $eventMock = $this->createMock(\Magento\Framework\Event::class);
        $eventMock->expects($this->at(0))
            ->method('getData')->with($this->equalTo('customer'))->will($this->returnValue($customerMock));

        $observerMock = $this->createMock(\Magento\Framework\Event\Observer::class);
        $observerMock->expects($this->at(0))
            ->method('getEvent')->will($this->returnValue($eventMock));

        $this->observer->execute($observerMock);

        $this->assertNotEquals('ADL', $this->trigramme);
    }

}