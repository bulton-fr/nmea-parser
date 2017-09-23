<?php

namespace NMEA\Frames\tests\units;

require_once(__DIR__.'/../../../vendor/autoload.php');

use mageekguy\atoum;

/**
 * Unit test class for class \NMEA\Frame
 * 
 * @package NMEA
 * @author Vermeulen Maxime <bulton.fr@gmail.com>
 */
class RMC extends atoum\test
{
    /**
     * @var \NMEA\Frames\RMC $frame The RMC frame instance used by unit test
     */
    protected $frame;
    
    /**
     * Called before each test method
     * 
     * @param string $methodName The name of the test method which be called
     * 
     * @return void
     */
    public function beforeTestMethod($methodName)
    {
        $this->frame = new \NMEA\Frames\RMC(
            '$GPRMC,123519,A,4807.038,N,01131.000,E,022.4,084.4,230394,003.1,W*6A'
        );
    }
    
    /**
     * Test method for \NMEA\Frames\RMC::getFrameType method
     * 
     * @return void
     */
    public function testGetFrameType()
    {
        $this->assert('Frames\RMC::getFrameType()')
            ->string($this->frame->getFrameType())
                ->isEqualTo('RMC');
    }
    
    /**
     * Test method for \NMEA\Frames\RMC::decodeFrame method and call all getters
     * 
     * @return void
     */
    public function testDecodeFrameAndGetters()
    {
        $this->assert('Frames\RMC::decodeFrame()')
            ->variable($this->invoke($this->frame)->readFrame())
                ->isNull()
        ;
        
        $this->testGetUtcTime();
        $this->testGetStatus();
        $this->testGetLatitude();
        $this->testGetLatitudeDirection();
        $this->testGetLongitude();
        $this->testGetLongitudeDirection();
        $this->testGetSpeed();
        $this->testGetAngle();
        $this->testGetUtcDate();
        $this->testGetMagneticVariation();
        $this->testGetMagneticVariationDirection();
    }
    
    /**
     * Test method for \NMEA\Frames\RMC::getUtcTime
     * 
     * @return void
     */
    protected function testGetUtcTime()
    {
        $this->assert('Frames\RMC::getUtcTime()')
            ->object($utcTime = $this->frame->getUtcTime())
                ->isInstanceOf('\DateTime')
            ->string($utcTime->format('H'))
                ->isEqualTo('12')
            ->string($utcTime->format('i'))
                ->isEqualTo('35')
            ->string($utcTime->format('s'))
                ->isEqualTo('19')
            ->object($timezone = $utcTime->getTimeZone())
                ->isInstanceOf('\DateTimeZone')
            ->string($timezone->getName())
                ->isEqualTo('UTC')
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getStatus
     * 
     * @return void
     */
    protected function testGetStatus()
    {
        $this->assert('Frames\RMC::getStatus()')
            ->string($this->frame->getStatus())
                ->isEqualTo('A')
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getLatitude
     * 
     * @return void
     */
    protected function testGetLatitude()
    {
        $this->assert('Frames\RMC::getLatitude()')
            ->float($this->frame->getLatitude())
                ->isEqualTo(4807.038)
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getLatitudeDirection
     * 
     * @return void
     */
    protected function testGetLatitudeDirection()
    {
        $this->assert('Frames\RMC::getLatitudeDirection()')
            ->string($this->frame->getLatitudeDirection())
                ->isEqualTo('N')
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getLongitude
     * 
     * @return void
     */
    protected function testGetLongitude()
    {
        $this->assert('Frames\RMC::getLongitude()')
            ->float($this->frame->getLongitude())
                ->isEqualTo(01131.000)
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getLongitudeDirection
     * 
     * @return void
     */
    protected function testGetLongitudeDirection()
    {
        $this->assert('Frames\RMC::getLongitudeDirection()')
            ->string($this->frame->getLongitudeDirection())
                ->isEqualTo('E')
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getSpeed
     * 
     * @return void
     */
    protected function testGetSpeed()
    {
        $this->assert('Frames\RMC::getSpeed()')
            ->float($this->frame->getSpeed())
                ->isEqualTo(022.4)
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getAngle
     * 
     * @return void
     */
    protected function testGetAngle()
    {
        $this->assert('Frames\RMC::getAngle()')
            ->float($this->frame->getAngle())
                ->isEqualTo(084.4)
        ;
    }
    
    /**
     * Test method for \NMEA\Frames\RMC::getUtcDate
     * 
     * @return void
     */
    protected function testGetUtcDate()
    {
        $this->assert('Frames\RMC::getUtcDate()')
            ->object($utcTime = $this->frame->getUtcDate())
                ->isInstanceOf('\DateTime')
            ->string($utcTime->format('d'))
                ->isEqualTo('23')
            ->string($utcTime->format('m'))
                ->isEqualTo('03')
            ->string($utcTime->format('y'))
                ->isEqualTo('94')
            ->object($timezone = $utcTime->getTimeZone())
                ->isInstanceOf('\DateTimeZone')
            ->string($timezone->getName())
                ->isEqualTo('UTC')
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getMagneticVariation
     * 
     * @return void
     */
    protected function testGetMagneticVariation()
    {
        $this->assert('Frames\RMC::getMagneticVariation()')
            ->float($this->frame->getMagneticVariation())
                ->isEqualTo(003.1)
        ;
    }

    /**
     * Test method for \NMEA\Frames\RMC::getMagneticVariationDirection
     * 
     * @return void
     */
    protected function testGetMagneticVariationDirection()
    {
        $this->assert('Frames\RMC::getMagneticVariationDirection()')
            ->string($this->frame->getMagneticVariationDirection())
                ->isEqualTo('W')
        ;
    }
}