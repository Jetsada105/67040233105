<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ระบบลงทะเบียนอบรม</title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fee2e2, #fef2f2);
            color: #3f3f46;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
        }

        .container {
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(185,28,28,0.15);
            width: 100%;
            max-width: 620px;
            margin-bottom: 40px;
        }

        h2, h3 {
            text-align: center;
            color: #7f1d1d;
            margin-bottom: 20px;
        }

        /* Input */
        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 12px;
            margin: 10px 0 20px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            font-size: 15px;
            transition: 0.3s;
        }

        input:focus,
        select:focus {
            border-color: #b91c1c;
            box-shadow: 0 0 0 3px rgba(185,28,28,0.2);
            outline: none;
        }

        /* Checkbox & Radio */
        label {
            margin-right: 15px;
        }

        /* Button */
        button {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #b91c1c, #7f1d1d);
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(127,29,29,0.45);
        }

        /* Success Box */
        .success-box {
            background: #fee2e2;
            color: #7f1d1d;
            padding: 16px;
            border-radius: 10px;
            border-left: 6px solid #b91c1c;
            margin-bottom: 25px;
        }

        /* Table */
        table {
            width: 100%;
            max-width: 900px;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(185,28,28,0.15);
        }

        th {
            background: linear-gradient(135deg, #7f1d1d, #b91c1c);
            color: white;
            padding: 14px;
            font-weight: 600;
        }

        td {
            padding: 14px;
            border-bottom: 1px solid #fecaca;
        }

        tr:nth-child(even) {
            background-color: #fff5f5;
        }

        tr:hover {
            background-color: #fee2e2;
        }
    </style>
</head>

<body>

<div class="container">
<?php
if (isset($_POST['submit'])) {

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $type = $_POST['type'];

    $food = isset($_POST['food']) ? implode(", ", $_POST['food']) : "ไม่ระบุ";
    $price = ($type == "Onsite") ? 1500 : 800;

    $data = "$fullname|$email|$course|$food|$type|$price\n";
    file_put_contents("register.txt", $data, FILE_APPEND);

    echo "<div class='success-box'>
            <strong>ลงทะเบียนสำเร็จ!</strong><br>
            คุณ: $fullname <br>
            รูปแบบ: $type <br>
            ค่าใช้จ่าย: ".number_format($price,2)." บาท
          </div>";
}
?>

<h2>ฟอร์มลงทะเบียนอบรม</h2>

<form method="post">
    ชื่อ-นามสกุล
    <input type="text" name="fullname" required>

    Email
    <input type="email" name="email" required>

    หัวข้ออบรม
    <select name="course">
        <option>AI สำหรับงานสำนักงาน</option>
        <option>Excel สำหรับการทำงาน</option>
        <option>การเขียนเว็บด้วย PHP</option>
    </select>

    อาหารที่ต้องการ <br>
    <label><input type="checkbox" name="food[]" value="ปกติ"> ปกติ</label>
    <label><input type="checkbox" name="food[]" value="มังสวิรัติ"> มังสวิรัติ</label>
    <label><input type="checkbox" name="food[]" value="ฮาลาล"> ฮาลาล</label>
    <br><br>

    รูปแบบการเข้าร่วม <br>
    <label><input type="radio" name="type" value="Onsite" required> Onsite (1,500)</label>
    <label><input type="radio" name="type" value="Online"> Online (800)</label>
    <br><br>

    <button type="submit" name="submit">ลงทะเบียน</button>
</form>
</div>

<h3>รายชื่อผู้ลงทะเบียนทั้งหมด</h3>

<?php
if (file_exists("register.txt")) {
    echo "<table>
            <tr>
                <th>ชื่อ</th>
                <th>Email</th>
                <th>หัวข้อ</th>
                <th>อาหาร</th>
                <th>รูปแบบ</th>
                <th>ราคา</th>
            </tr>";

    foreach (file("register.txt") as $line) {
        list($n,$e,$c,$f,$t,$p) = explode("|", trim($line));
        echo "<tr>
                <td>$n</td>
                <td>$e</td>
                <td>$c</td>
                <td>$f</td>
                <td>$t</td>
                <td>".number_format($p,2)."</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>ยังไม่มีข้อมูลผู้ลงทะเบียน</p>";
}
?>

</body>
</html>
