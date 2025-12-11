<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การใช้ User-define Function</title>
</head>
<body>
    <h1>User-define Function ฟังก์ชั่นที่เราสร้างขึ้นเอง</h1>
        <?php   // เรียกใช้ function
            echo "ผลบวกของ 10 กับ 20 คือ " . sum(10, 20) . "<br>";
            echo "ผลบวกของ 15 กับ 25 คือ " . sum(10, 20) . "<br>";
            $a = 30; $b = 45;
            echo "ผลยวกของ $a กับ $b คือ " . sum($a, $b) . "<br>";
            echo "<hr>";
            $num = 50;
            $new_value = add_five($num);
            echo "ค่าของ num ก่อนเรียกใช่ฟังก์ชั่น add_five คือ $num <br>";
            add_five($num);
            echo "ค่าของ num หลังเรียกใช้่ฟังก์ชั่น add_five คือ $num <br>";
        ?>
    <h2>ตัวอย่าง function ที่มีพารามิเตอร์หลายตัว</h2>
        <?php
        // สร้าง     function sumListofNumbers ที่รับพารามิเตอร์หลายตัว
            function sumListofNumbers(...$x) {
                $n = 0;
                $len = count($x);
                for ($i = 0; $i < $len; $i++) {
                    $n += $x[$i];
                }
                return $n;
            }
            
        // เรียกใช้ function sumListofNumbers
            echo "ผลบวกของตัวเลข 5, 10, 15  ตัว คือ " . sumListofNumbers(5, 10, 15) . "<br>";
            echo "ผลบวกของตัวเลข 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 คือ "
                     . sumListofNumbers(1, 2, 3, 4, 5, 6, 7, 8, 9, 10) . "<br>";


        // สร้าง function รับนามสกุล และชื่อหลายคน
            function myFamily($lastName, ...$firstnames) {
                $len = count($firstnames);
                for ($i = 0; $i < $len; $i++) {
                    echo "สวัสดี คุณ " . $firstnames[$i] . " " . $lastName . "<br>";
                }
            }

        // เรียกใช้ function myFamily
            myFamily("สมชาย", "สมศรี", "สมหมาย", "สมปอง");    
        ?>
    <h2>ตัวอย่าง function ที่มีค่าพารามิเตอร์เริ่มต้น</h2>
        <?php 
            function thai_date($strDate="noe") {
                $strYear = date("Y", strtotime($strDate)) + 543;
                $strMonth = date("n", strtotime($strDate));
                $strDay = date("j", strtotime($strDate));

                $thaiMonthName = ["", "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
                                  "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];

                $strMonthThai = $thaiMonthName[$strMonth];
                return "$strDay $strMonthThai พ.ศ. $strYear";
            }
            echo thai_date("2025-12-11") . "<br>";
            echo thai_date(""); // ใช้ค่าเริ่มต้นเป็นวันที่ปัจจุบัน
        ?>
          
</body>
</html>
<?php

    function sum($num1, $num2) {
        $result = $num1 + $num2;
        return $result;
    }


    function add_five($num) {
        $value = $num + 5;
        echo "ค่าของ n ภายในฟังก์ชั่น add_five คือ $num <br>";
    }