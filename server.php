<?php
date_default_timezone_set('Asia/Bangkok'); // ถ้าตั้งใน php.ini แล้ว ไม่ต้องมีบรรทัดนี้
?>
<!DOCTYPE html>
<html lang="th">
<head><meta charset="UTF-8"><title>ข้อมูลเซิร์ฟเวอร์</title></head>
<body>
  <h1>เซิร์ฟเวอร์ของทีม</h1>
  <table border="1">
    <tr><th>รายการ</th><th>ค่า</th></tr>
    <tr><td>เวอร์ชัน PHP</td><td><?php echo PHP_VERSION; ?></td></tr>
    <tr><td>ซอฟต์แวร์เว็บเซิร์ฟเวอร์</td><td><?php echo $_SERVER['SERVER_SOFTWARE']; ?></td></tr>
    <tr><td>ชื่อเครื่อง:พอร์ต</td><td><?php echo $_SERVER['SERVER_NAME']; ?></td></tr>
    <tr><td>Timezone</td><td><?php echo date_default_timezone_get(); ?></td></tr>
    <tr><td>เวลาบนเซิร์ฟเวอร์</td><td><?php echo date('d/m/Y H:i:s'); ?></td></tr>
  </table>
  
</body>
</html>
