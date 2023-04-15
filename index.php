<?php
//------------------Function 1---------------------
 function convertDecimalToBinary($number) {
    $integerNumber = (int)($number);
    $decimalPart = $number - $integerNumber;

    $firstPart = '';
    while($integerNumber>=1){
        $firstPart .= $integerNumber % 2;
        $integerNumber = floor($integerNumber / 2);
    }

    $firstPart = strrev($firstPart);
    // $firstPart = decbin($integerNumber);

    if($decimalPart == 0) {
        return $firstPart;
    }

    $secondPart = '';
    $decimalLimit = 8;
    for($i = 0; $i < $decimalLimit; $i++){
        if($decimalPart != 0) {
            $decimalPart *= 2;
            if($decimalPart >= 1){
                $secondPart .= "1";
                $decimalPart -= 1;
            } else {
                $secondPart .= "0";
            }
        }
    }

    $binaryNumber = $firstPart . "." . $secondPart;
    return $binaryNumber;
 }   
 echo convertDecimalToBinary(23);
 echo "<hr>";

 //---------------Function 1 Recursive(doesn't work for decimals)---------------
 function recursiveConvertDecimalToBinary($number){
    if($number == 0) {
        return '';
    } else {
        return recursiveConvertDecimalToBinary(floor($number / 2)) . ($number % 2);
    }
 }
 echo recursiveConvertDecimalToBinary(3420);
 echo "<hr>";

 //------------------Function 2---------------------
 function convertDecimalToRoman($number) {
    $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
    $romanNumber = '';
    if($number <= 3999999){
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if($number >= $int) {
                    $number -= $int;
                    $romanNumber .= $roman;
                    break;
                }
            }
        }
        return $romanNumber;
    } else {
        $error = "Can't convert numbers bigger than 3999";
        return $error;
    }
}

echo convertDecimalToRoman(1543);
echo "<hr>";

// ------------------Function 3---------------------
function convertBinaryToDecimal($number) {
    $parts = explode('.', $number);

    $integerDigits = str_split($parts[0]);
    $decimal = 0;
    $power = count($integerDigits) - 1;

    for($i = 0; $i < count($integerDigits); $i++){
        $decimal += $integerDigits[$i] * pow(2, $power);
        $power--;
    }
    // decbin($number);

    if(isset($parts[1])) {
        $fractionalDigits = str_split($parts[1]);
        $power = -1;

        for($i = 0; $i < count($fractionalDigits); $i++){
            $decimal += $fractionalDigits[$i] * pow(2, $power);
            $power--;
        }
    }

    return $decimal;
}

echo convertBinaryToDecimal(10011.101100);
echo "<hr>";

// ------------------Function 4---------------------
function convertRomanToDecimal($number) {
    $map = ['M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1];
    $decimalNumber = 0;
    $digits = str_split($number);
    for($i = 0; $i < count($digits); $i++){
        if($i+1 < count($digits) && isset($map[$digits[$i].$digits[$i+1]])){
            $decimalNumber += $map[$digits[$i].$digits[$i+1]];
            $i++;
        }
        else{
            foreach($map as $key => $value) {
                if($digits[$i] == $key) {
                    $decimalNumber += $value;
                }
            }
        }
    }

    return $decimalNumber;
}

echo convertRomanToDecimal("CMCD");
echo "<hr>";

// ------------------Function 5---------------------
function convertNumbers($number) {
    if(preg_match("/^[01]+(\.[01]+)?$/", $number)){
        echo "Converted to decimal: ".convertBinaryToDecimal($number);
        echo "<br>";
        if(strpos($number, '.') !== false) {
            echo "Cant't convert a float to a roman number";
        } else {
            echo "Converted to roman: ".convertDecimalToRoman(convertBinaryToDecimal($number));
        }
    } elseif(preg_match("/^M{0,3}(CM|CD|D?C{0,3})(XC|XL|L?X{0,3})(IX|IV|V?I{0,3})$/", $number)) {
        echo "Converted to decimal: ".convertRomanToDecimal($number);
        echo "<br>";
        echo "Converted to binary: ".convertDecimalToBinary(convertRomanToDecimal($number));
    } elseif(preg_match("/^(?!0)[-+]?[1-9]\d*(?:\.\d+)?$/", $number)) {
        echo "Converted to binary: ".convertDecimalToBinary($number);
        echo "<br>";
        if(strpos($number, '.') !== false) {
            echo "Cant't convert float to a roman number";
        } else {
            echo "Converted to roman: ".convertDecimalToRoman($number);
        }
    } else {
        echo "Invalid number!";
    }
}

$numbers = ["XVI", "+023", "54", "10010", "+55", "XLIX", "1011101001", "XXII", "+54", "11101"];

foreach($numbers as $number){
    echo "Number: " . $number . "<br>";
    convertNumbers($number);
    echo "<hr>";
}






?>