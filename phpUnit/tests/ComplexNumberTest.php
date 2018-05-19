<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 20:39
 */

require_once __DIR__ . '/../src/ComplexNumber.php';

use PHPUnit\Framework\TestCase;

class ComplexNumberTest extends TestCase
{

    public function testAdd()
    {
        $firstNumber = new ComplexNumber(1, 3);
        $secondNumber = new ComplexNumber(4, -5);
        $result = new ComplexNumber(5, -2);
        $this->assertEquals($firstNumber->add($secondNumber)->__toString(), $result->__toString());
    }

    public function testSub()
    {
        $firstNumber = new ComplexNumber(1, 1);
        $secondNumber = new ComplexNumber(1, 1);
        $result = new ComplexNumber(0, 0);
        $this->assertEquals($firstNumber->sub($secondNumber)->__toString(), $result->__toString());
    }

    public function testMult()
    {
        $firstNumber = new ComplexNumber(1, -1);
        $secondNumber = new ComplexNumber(3, 6);
        $result = new ComplexNumber(9, 3);
        $this->assertEquals($firstNumber->mult($secondNumber)->__toString(), $result->__toString());
    }

    public function testDiv()
    {
        $firstNumber = new ComplexNumber(13, 1);
        $secondNumber = new ComplexNumber(7, -6);
        $result = new ComplexNumber(1, 1);
        $this->assertEquals($firstNumber->div($secondNumber)->__toString(), $result->__toString());
    }

    public function testAbs()
    {
        $number = new ComplexNumber(3, 4);
        $this->assertEquals($number->abs()->__toString(), 5);
    }
}
