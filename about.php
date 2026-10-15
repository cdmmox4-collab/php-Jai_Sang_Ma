
<?php
$team = "Jai Sang Ma";
$topic = "ระบบสั่งเครื่องดื่มออนไลน์";

$goals = [
    "เพื่อให้ลูกค้าสามารถดูรายการเครื่องดื่มออนไลน์ได้",
    "เพื่อให้ลูกค้าสั่งเครื่องดื่มได้สะดวกและรวดเร็ว",
    "เพื่อช่วยให้ร้านจัดการรายการสั่งซื้อได้เป็นระบบ"
];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เกี่ยวกับโครงงาน</title>
</head>
<body>
    <h1>เกี่ยวกับโครงงาน</h1>

    <p>ชื่อทีม: <?php echo $team; ?></p>
    <p>ชื่อโครงงาน: <?php echo $topic; ?></p>

    <h2>เป้าหมายของโครงงาน</h2>
    <ul>
        <?php foreach ($goals as $goal) { ?>
            <li><?php echo $goal; ?></li>
        <?php } ?>
    </ul>

    <h2>เมนูเว็บไซต์</h2>
    <nav>
        <a href="index.php">หน้าแรก</a> |
        <a href="about.php">เกี่ยวกับโครงงาน</a> |
        <a href="server.php">ข้อมูลเซิร์ฟเวอร์</a> |
        <a href="hello.php">ทดสอบ PHP</a>
    </nav>
</body>
</html>
