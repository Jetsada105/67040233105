<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Built-in Function</title>
</head>
<body>
    <h1>Built-in Function ฟังก์ชั่นที่มีพร้อมใช่ใน php</h1>
    <h2>ทดสอบการใช้ Function date</h2>
        <?php
            echo "วันนี้วันที่ " . date("d/m/y") . "<br>";
            echo "เวลาปุจจุบัน " . date("H:i:sa") . "<br>";
            echo "วันนี้เป็นวัน " . date("l") ;
        ?>
    <h2>ทดสอบการใช้ Function date_diff</h2>
        <?php
            $date1 = date_create("2005-08-22");
            $date2 = date_create("2025-12-11"); // วันที่ปัจจุปัน
            $diff = date_diff($date1, $date2);
            echo "จำนวนวันระหว่างวันที่ 22 สิงหาคม 2005 ถึง 11 ธันวาคม 202ถ คือ "
                . $diff->days . " วัน<br>";
            echo "หรือเท่ากับ " . $diff->y . " ปี "
                             . $diff->m . " เดือน "
                             . $diff->d . " วัน";
        ?>
        <h2>ทดสอบการใช้ Math function</h2>
            <?php
                $num1 = 10.3;
                $num2 = 5.7;
                $pi = 3.14159;
                echo "ค่าปัดขึ้นของ $num1 คือ " . ceil($num1) . "<br>";
                echo "ค่าปัดลงของ $num1 คือ " . floor($num1) . "<br>";
                echo "ค่าของ pi ปัดเป็นทศนิยม 2 ตำแหน่ง คือ  " . round($pi,2) . "<br>";
                echo "ค่า pi  คือ " . pi() . "<br>";
                echo "ค่ายกกำลัง 3 ของ 5 คือ " . pow(5, 3) . "<br>";
                echo "ค่ารากที่สองของ 49 คือ " . sqrt(49) . "<br>";
                echo "ค่าสุ่มระหว่าง 1 ถึง 100 คือ " . rand(1, 100) . "<br>";
                echo "ค่าสุ่มระหว่าง 50 ถึง 150 คือ " . rand(50, 150) . "<br>";
                echo "ค่าสุ่ม คือ ". rand() . "<br>";
                $arr = array(3, 5, 1, 8, 2);
                echo "ค่าสูงสุดใน Array คือ " . max($arr) . "<br>";
                echo "ค่าต่ำสุดใน Array คือ". min($arr) . "<br>";

            ?>
    <h2>ทดสอบการใช้ String Function</h2>
        <?php
            $str = "Hello PHP Function";
            echo "ความยาวของสตริง '$str' คือ " . strlen($str) . " ตัวอักษร<br>";
            echo "สตริง '$str' เมื่อแปลงเป็นตัวพิมพ์ใหญ่ทั้งหมด คือ " . strtoupper($str,) . "<br>";
            echo "สตริง '$str' เมื่อแปลงเป็นตัวพิมพ์เล็กทั้งหมด คือ " . strtolower($str,) . "<br>";
            echo "สตริง '$str' เมื่อแปลงเป็นตัวพิมพ์ใหญ่ตัวแรก คือ " . ucfirst($str,) . "<br>";
            echo "สตริง '$str' เมื่อแปลงเป็นตัวพิมพ์ใหญ่ทุกคำ คือ " . ucwords($str,) . "<br>";
            $substr = "PHP";
            echo "ตำแหน่งของคำว่า '่$substr' ในสตริง '$str' คือ" . strpos($str,$substr) . "'<br>";
            $replace = str_replace("Function", "ฟังก์ชั่น", $str);
            echo "เมื่อแทนที่คำว่า 'Function' ด้วย 'ฟังก์ชั่น' จะได้สตริงใหม่คือ '$replace' <br>";
            $str = " PHP     Function      with    Spaces ";
            echo "สตริงก่อนลบช่องว่างด้านหน้าและหลัง: . '$str2'<br>";
            echo "สตริงหลังลบช่องว่างด้านหน้าและหลัง: . '" . trim($str) . "'<br>"; 
        ?>
    <?php myFooter("Jetsada Susakunjinda");     // เรียกใช้ฟังก์ชั่น Function ?>
</body>
</html>
    <?php
        function myFooter($myname) {
            echo "<foooter><br>";
            echo "<p>PHP built-in Function Example &copy; 2024</p>";
            echo "<p>สร้างโดย  Jetsada Susakunjinda</p>";
            echo "</footer>";
        }
    ?>