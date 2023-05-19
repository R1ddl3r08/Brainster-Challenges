<?php

// INTERFACE PRINTABLE
interface Printable
{
    public function print();
    public function sneakpeek();
    public function fullinfo();
}


// CLASS FURNITURE
class Furniture
{
    // PROPERTIES
    private $width;
    private $length;
    private $height;
    private $is_for_seating;
    private $is_for_sleeping;

    // CONSTRUCTOR
    public function __construct(int $width, int $length, int $height)
    {
        $this->width = $width;
        $this->height = $height;
        $this->length = $length;
    }

    // SETTERS
    public function setIsForSeating(bool $is_for_seating)
    {
        $this->is_for_seating = $is_for_seating;
    }

    public function setIsForSleeping(bool $is_for_sleeping)
    {
        $this->is_for_sleeping = $is_for_sleeping;
    }


    // GETTERS
    public function getIsForSeating()
    {
        return $this->is_for_seating;
    }

    public function getIsForSleeping()
    {
        return $this->is_for_sleeping;
    }

    // ADDED ADDITIONAL METHOD FOR WIDTH SO I CAN ACCESS IT IN SOFA CLASS
    protected function getWidth()
    {
        return $this->width;
    }

    protected function getLength()
    {
        return $this->length;
    }

    protected function getHeight()
    {
        return $this->height;
    }


    // METHODS
    public function area()
    {
        return $this->width * $this->length;
    }

    public function volume()
    {
        return $this->area() * $this->height;
    }
}

// CREATING NEW OBJECT FURNITURE AND CALLING ALL THE METHODS
$furniture = new Furniture(30, 20, 10);
$furniture->setIsForSeating(true);
$furniture->setIsForSleeping(false);
var_dump($furniture->getIsForSeating()); echo '<br>';
var_dump($furniture->getIsForSleeping()); echo '<br>';
echo $furniture->area() . '<br>';
echo $furniture->volume() . '<br>';

echo "<hr>";


// CLASS SOFA
class Sofa extends Furniture implements Printable
{
    // PROPERTIES
    private $seats;
    private $armrests;
    private $length_opened;

    // SETTERS
    public function setSeats(int $seats)
    {
        $this->seats = $seats;
    }

    public function setArmrests(int $armrests)
    {
        $this->armrests = $armrests;
    }

    public function setLengthOpened(int $length_opened)
    {
        $this->length_opened = $length_opened;
    }


    // GETTERS
    public function getSeats()
    {
        return $this->seats;
    }

    public function getArmrests()
    {
        return $this->armrests;
    }

    public function getLengthOpened()
    {
        return $this->length_opened;
    }


    // METHODS
    public function area_opened()
    {
        if($this->getIsForSleeping()){
            return $this->getWidth() * $this->length_opened;
        }

        return "This sofa is for sitting only, it has $this->armrests armrests and $this->seats seats.";
    }

    // INTERFACE METHODS
    public function print()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2";
    }

    public function sneakpeek()
    {
        return get_class($this);
    }

    public function fullinfo()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
    }

}

// CREATING NEW OBJECT SOFA AND CALLING THE METHODS
$sofa = new Sofa(2, 3, 2);
$sofa->setIsForSeating(true);
$sofa->setIsForSleeping(false);
$sofa->setArmrests(2);
$sofa->setSeats(3);
echo "Area: " . $sofa->area() . "<br>";
echo "Volume: " . $sofa->volume() . "<br>";
echo "Area Opened: " . $sofa->area_opened() . "<br>";

$sofa->setIsForSleeping(true);
$sofa->setLengthOpened(4);
echo "Area opened: " . $sofa->area_opened() . "<br>";

echo "<hr>";


// CLASS BENCH
class Bench extends Sofa implements Printable
{
    // INTERFACE METHODS
    public function print()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2";
    }

    public function sneakpeek()
    {
        return get_class($this);
    }

    public function fullinfo()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
    }
}


// CLASS CHAIR
class Chair extends Furniture implements Printable
{
    // INTERFACE METHODS
    public function print()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2";
    }

    public function sneakpeek()
    {
        return get_class($this);
    }

    public function fullinfo()
    {
        if($this->getIsForSleeping()){
            return get_class($this) . ", is for sleeping, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
        }

        return get_class($this) . ", sitting only, " . $this->area() . "cm2, width: " . $this->getWidth() . "cm, length: " . $this->getLength() . "cm, height: " . $this->getHeight() . "cm";
    }
}


// CREATING NEW OBJECT BENCH AND CALLING THE METHODS
$bench = new Bench(200, 150, 50);
$bench->setIsForSeating(true);
$bench->setIsForSleeping(true);
echo $bench->print() . "<br>";
echo $bench->sneakpeek() . "<br>"; 
echo $bench->fullinfo() . "<br>"; 

echo "<hr>";

// CREATING NEW OBJECT CHAIR AND CALLING THE METHODS
$chair = new Chair(70, 45, 40);
$chair->setIsForSeating(true);
$chair->setIsForSleeping(false);
echo $chair->print() . "<br>";
echo $chair->sneakpeek() . "<br>"; 
echo $chair->fullinfo() . "<br>"; 



?>