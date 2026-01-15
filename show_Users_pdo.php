<?php
/***********************
 * PDO CONNECT
 ***********************/
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = "localhost";
$db   = "js_it67";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ: " . $e->getMessage());
}

/***********************
 * DELETE
 ***********************/
if (isset($_GET['delete_id'])) {
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['delete_id']]);
    header("Location: users.php");
    exit;
}

/***********************
 * EDIT DATA
 ***********************/
$editData = null;
if (isset($_GET['edit_id'])) {
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['edit_id']]);
    $editData = $stmt->fetch();
}

/***********************
 * INSERT / UPDATE
 ***********************/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['id'])) {
        // UPDATE
        $stmt = $conn->prepare(
            "UPDATE users SET
                name = ?, sex = ?, phone = ?, email = ?, birthday = ?
             WHERE id = ?"
        );
        $stmt->execute([
            $_POST['name'],
            $_POST['sex'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['birthday'],
            $_POST['id']
        ]);
    } else {
        // INSERT
        $stmt = $conn->prepare(
            "INSERT INTO users (name, sex, phone, email, birthday)
             VALUES (?,?,?,?,?)"
        );
        $stmt->execute([
            $_POST['name'],
            $_POST['sex'],
            $_POST['phone'],
            $_POST['email'],
            $_POST['birthday']
        ]);
    }

    header("Location: users.php");
    exit;
}

/***********************
 * FETCH ALL
 ***********************/
$users = $conn->query("SELECT * FROM users")->fetchAll();
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>ระบบจัดการผู้ใช้ (PDO)</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-4">

<h2 class="text-center fw-bold mb-4">ระบบจัดการผู้ใช้ (PDO)</h2>

<!-- TABLE -->
<table class="table table-bordered table-hover">
<thead class="table-dark text-center">
<tr>
  <th>ID</th>
  <th>ชื่อ</th>
  <th>เพศ</th>
  <th>โทร</th>
  <th>Email</th>
  <th>วันเกิด</th>
  <th>จัดการ</th>
</tr>
</thead>
<tbody>
<?php foreach ($users as $row): ?>
<tr>
  <td class="text-center"><?= $row['id'] ?></td>
  <td><?= $row['name'] ?></td>
  <td class="text-center"><?= $row['sex'] ?></td>
  <td><?= $row['phone'] ?></td>
  <td><?= $row['email'] ?></td>
  <td><?= $row['birthday'] ?></td>
  <td class="text-center">
    <a href="?edit_id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">แก้ไข</a>
    <a href="?delete_id=<?= $row['id'] ?>"
       class="btn btn-danger btn-sm"
       onclick="return confirm('ยืนยันการลบ?')">ลบ</a>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<!-- FORM -->
<div class="card mt-4">
<div class="card-header <?= $editData ? 'bg-warning' : 'bg-success' ?> text-white">
<?= $editData ? 'แก้ไขผู้ใช้' : 'เพิ่มผู้ใช้ใหม่' ?>
</div>

<div class="card-body">
<form method="post">
<input type="hidden" name="id" value="<?= $editData['id'] ?? '' ?>">

<div class="row">
  <div class="col-md-6 mb-2">
    <label>ชื่อ</label>
    <input type="text" name="name" class="form-control"
           value="<?= $editData['name'] ?? '' ?>" required>
  </div>

  <div class="col-md-6 mb-2">
    <label>เพศ</label>
    <select name="sex" class="form-select">
      <option value="ชาย" <?= ($editData['sex'] ?? '')=='ชาย'?'selected':'' ?>>ชาย</option>
      <option value="หญิง" <?= ($editData['sex'] ?? '')=='หญิง'?'selected':'' ?>>หญิง</option>
    </select>
  </div>

  <div class="col-md-6 mb-2">
    <label>เบอร์โทร</label>
    <input type="text" name="phone" class="form-control"
           value="<?= $editData['phone'] ?? '' ?>">
  </div>

  <div class="col-md-6 mb-2">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
           value="<?= $editData['email'] ?? '' ?>">
  </div>

  <div class="col-md-6 mb-2">
    <label>วันเกิด</label>
    <input type="date" name="birthday" class="form-control"
           value="<?= $editData['birthday'] ?? '' ?>">
  </div>
</div>

<button class="btn <?= $editData ? 'btn-warning' : 'btn-success' ?> mt-3">
<?= $editData ? 'อัปเดต' : 'บันทึก' ?>
</button>

<?php if ($editData): ?>
<a href="users.php" class="btn btn-secondary mt-3">ยกเลิก</a>
<?php endif; ?>

</form>
</div>
</div>

</div>
</body>
</html>
