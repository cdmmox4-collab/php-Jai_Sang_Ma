<?php
require_once 'config.php';

// 1) กำหนดตัวแปรระบบ
$shopName = 'ร้านชานม Jai Sang Ma';
$isOpen = true;
$totalDrinks = 20;
$dailyOrder = 50;
$completedOrders = 40;
$drinkPrice = 35;
$orderQty = 2;
$discount = 5;

// 2) คำนวณค่าต่างๆ
$totalPriceBD = $drinkPrice * $orderQty;
$netPrice = $totalPriceBD - $discount;
$pendingOrders = $dailyOrder - $completedOrders;
$completionRate = $dailyOrder > 0 ? round(($completedOrders / $dailyOrder) * 100, 1) : 0;

// 3) รายการสั่งซื้อล่าสุด
$customerName = 'สมชาย ใจดี';
$menuName = 'ชาไทยเย็น';

// 4) เงื่อนไขการแจ้งเตือน
$isOverloaded = $pendingOrders > 8 || $completionRate < 50.0;
$alertMessage = $isOverloaded ? '⚠️ เตือน: ออเดอร์ค้างทำสะสมมากเกินไป กรุณาเร่งดำเนินการ!' : 'ปกติ: การบริหารคิวอยู่ในเกณฑ์ดี';
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title><?php echo APP_NAME; ?></title>
  <style>
    body { font-family: sans-serif; margin: 24px; background-color: #f9f9f9; }
    .card { display: inline-block; padding: 16px 24px; margin: 6px; border-radius: 8px; background: #e3f2fd; text-align: center; }
    .warn { background: #ffebee; color: #c62828; }
    .alert-box { padding: 12px; border-radius: 6px; background: #fff3e0; border-left: 5px solid #ef6c00; margin-top: 15px; }
  </style>
</head>
<body>
  <h1><?php echo APP_NAME; ?></h1>
  <p><?php echo $shopName; ?> · สถานะร้าน: <b><?php echo $isOpen ? 'เปิดบริการ' : 'ปิดบริการ'; ?></b> · วันที่ <?php echo date('d/m/Y'); ?></p>

  <div class="card">ออเดอร์ทั้งหมด<br><b><?php echo $dailyOrder; ?></b> รายการ</div>
  <div class="card">ทำเสร็จแล้ว<br><b><?php echo $completedOrders; ?></b> รายการ</div>
  <div class="card <?php echo $pendingOrders > 8 ? 'warn' : ''; ?>">ค้างทำ (Pending)<br><b><?php echo $pendingOrders; ?></b> รายการ</div>
  <div class="card">อัตราความสำเร็จ<br><b><?php echo $completionRate; ?>%</b></div>

  <h2>รายการสั่งซื้อล่าสุด</h2>
  <p>ลูกค้า: <b><?php echo $customerName; ?></b> สั่งเมนู <b><?php echo $menuName; ?></b> จำนวน <b><?php echo $orderQty; ?></b> แก้ว</p>
  <p>ราคารวม: <?php echo number_format($totalPriceBD, 2); ?> บาท | ส่วนลด: <?php echo number_format($discount, 2); ?> บาท</p>
  <p><b>ยอดชำระสุทธิ: <?php echo number_format($netPrice, 2); ?> บาท</b></p>

  <?php if ($isOverloaded): ?>
    <div class="alert-box"><?php echo $alertMessage; ?></div>
  <?php endif; ?>

  <p style="margin-top: 30px;"><a href="about.php">เกี่ยวกับโครงงาน</a></p>
</body>
</html>