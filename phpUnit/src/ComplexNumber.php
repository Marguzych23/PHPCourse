<?php
/**
 * Created by PhpStorm.
 * User: Marguzych
 * Date: 19.05.2018
 * Time: 19:01
 */

class ComplexNumber
{

    private $real;
    private $imaginary;

    /**
     * ComplexNumber constructor.
     * @param float $real
     * @param float $imaginary
     */
    public function __construct(float $real, float $imaginary)
    {
        $this->real = $real;
        $this->imaginary = $imaginary;
    }

    /**
     * @param ComplexNumber $number
     * @return ComplexNumber|null
     */
    public function add(ComplexNumber $number)
    {
        if ($number instanceof ComplexNumber) {
            $real = $this->real + $number->getReal();
            $imaginary = $this->imaginary + $number->getImaginary();
            return new ComplexNumber($real, $imaginary);
        }
        return null;
    }

    /**
     * @param ComplexNumber $number
     * @return ComplexNumber|null
     */
    public function sub(ComplexNumber $number)
    {
        if ($number instanceof ComplexNumber) {
            $real = $this->real - $number->getReal();
            $imaginary = $this->imaginary - $number->getImaginary();
            return new ComplexNumber($real, $imaginary);
        }
        return null;
    }

    /**
     * @param ComplexNumber $number
     * @return ComplexNumber|null
     */
    public function mult(ComplexNumber $number)
    {
        if ($number instanceof ComplexNumber) {
            $real = ($this->real * $number->getReal()) - ($number->getImaginary() * $this->imaginary);
            $imaginary = ($this->real * $number->getImaginary()) + ($number->getReal() * $this->imaginary);
            return new ComplexNumber($real, $imaginary);
        }
        return null;
    }

    /**
     * @param ComplexNumber $number
     * @return ComplexNumber|null
     */
    public function div(ComplexNumber $number)
    {
        if ($number instanceof ComplexNumber) {
            $real = ($this->real * $number->getReal()) + ($number->getImaginary() * $this->imaginary);
            $imaginary = ($number->getReal() * $this->imaginary) - ($this->real * $number->getImaginary());
            $denominator = ($this->imaginary * $this->imaginary) + ($number->getImaginary() * $number->getImaginary());
            if ($real == $imaginary) {
                return new ComplexNumber(1, 1);
            }
            return new ComplexNumber($real / $denominator, $imaginary / $denominator);
        }
        return null;
    }

    /**
     * @return ComplexNumber
     */
    public function abs()
    {
        $real = sqrt(($this->real * $this->real) + ($this->imaginary * $this->imaginary));
        return new ComplexNumber($real, 0);
    }

    /**
     * @return float
     */
    public function getReal(): float
    {
        return $this->real;
    }

    /**
     * @param float $real
     */
    public function setReal(float $real): void
    {
        $this->real = $real;
    }

    /**
     * @return float
     */
    public function getImaginary(): float
    {
        return $this->imaginary;
    }

    /**
     * @param float $imaginary
     */
    public function setImaginary(float $imaginary): void
    {
        $this->imaginary = $imaginary;
    }


    /**
     * @return string
     */
    public function __toString()
    {
        $number = $this->real;
        if ($this->imaginary > 0) {
            $number .= "+" . $this->imaginary . "i";
        } elseif ($this->imaginary < 0) {
            $number .= $this->imaginary . "i";
        }
        return $number;
    }


}