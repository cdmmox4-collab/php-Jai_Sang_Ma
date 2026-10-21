<?php
// ==========================================
// PHP Configuration & Initial Data Setup
// ==========================================
define('APP_NAME', 'สั่งฉันสิจ๊ะ (Sang-Chan-Si-Ja)');
define('LOAN_DAYS', 7);
define('FINE_PER_DAY', 20);
define('ALERT_PERCENT', 80);

$currentServing = "A-008";
$waitingQueueCount = 4;
$overdue = 1;

// Beverage Array (Data Source)
$beverages = [
    [
        'id'          => 1,
        'code'        => 'DRK-001',
        'title'       => 'ชานมไข่มุก',
        'subtitle'    => 'Bubble Milk Tea',
        'price'       => 45,
        'badge'       => 'ขายดี',
        'badge_color' => 'badge-soft-coral',
        'tone'        => 'coral',
        'icon'        => 'bi-cup-hot'
    ],
    [
        'id'          => 2,
        'code'        => 'DRK-002',
        'title'       => 'ชาเขียวมัทฉะ',
        'subtitle'    => 'Matcha Green Tea',
        'price'       => 50,
        'badge'       => 'แนะนำ',
        'badge_color' => 'badge-soft-mint',
        'tone'        => 'mint',
        'icon'        => 'bi-cup-straw'
    ],
    [
        'id'          => 3,
        'code'        => 'DRK-003',
        'title'       => 'อิตาเลียนโซดา',
        'subtitle'    => 'Italian Soda',
        'price'       => 40,
        'badge'       => 'สดชื่น',
        'badge_color' => 'badge-soft-sky',
        'tone'        => 'sky',
        'icon'        => 'bi-brightness-high'
    ],
    [
        'id'          => 4,
        'code'        => 'DRK-004',
        'title'       => 'กาแฟโบราณ',
        'subtitle'    => 'Traditional Coffee',
        'price'       => 35,
        'badge'       => 'เข้มข้น',
        'badge_color' => 'badge-soft-blue',
        'tone'        => 'blue',
        'icon'        => 'bi-cup-hot-fill'
    ],
    [
        'id'          => 5,
        'code'        => 'DRK-005',
        'title'       => 'ชาไทยเย็น',
        'subtitle'    => 'Thai Milk Tea',
        'price'       => 40,
        'badge'       => 'ยอดฮิต',
        'badge_color' => 'badge-soft-coral',
        'tone'        => 'coral',
        'icon'        => 'bi-cup-straw'
    ],
    [
        'id'          => 6,
        'code'        => 'DRK-006',
        'title'       => 'โกโก้เข้มข้น',
        'subtitle'    => 'Dark Cocoa',
        'price'       => 45,
        'badge'       => 'เข้มข้น',
        'badge_color' => 'badge-soft-blue',
        'tone'        => 'blue',
        'icon'        => 'bi-cup-hot'
    ],
    [
        'id'          => 7,
        'code'        => 'DRK-007',
        'title'       => 'นมสดฮอกไกโด',
        'subtitle'    => 'Hokkaido Milk',
        'price'       => 45,
        'badge'       => 'หอมนุ่ม',
        'badge_color' => 'badge-soft-sky',
        'tone'        => 'sky',
        'icon'        => 'bi-droplet-fill'
    ],
    [
        'id'          => 8,
        'code'        => 'DRK-008',
        'title'       => 'ชามะนาว',
        'subtitle'    => 'Lemon Tea',
        'price'       => 35,
        'badge'       => 'เปรี้ยวซ่า',
        'badge_color' => 'badge-soft-mint',
        'tone'        => 'mint',
        'icon'        => 'bi-lemon'
    ]
];

$menu = [
    ['label' => 'ภาพรวมแดชบอร์ด', 'icon' => 'bi-grid-1x2', 'href' => 'index.php', 'active' => true],
    ['label' => 'จัดการเมนูเครื่องดื่ม', 'icon' => 'bi-cup-straw', 'href' => '#', 'active' => false],
    ['label' => 'คิวบริการหน้าร้าน', 'icon' => 'bi-ticket-perforated', 'href' => '#', 'active' => false],
    ['label' => 'รายงานยอดขาย', 'icon' => 'bi-graph-up', 'href' => '#', 'active' => false],
];

$stats = [
    ['label' => 'คิวปัจจุบัน', 'value' => $currentServing, 'unit' => 'กำลังรับบริการ', 'tone' => 'coral', 'icon' => 'bi-person-lines-fill'],
    ['label' => 'คิวที่รอ', 'value' => $waitingQueueCount, 'unit' => 'คิวในแถว', 'tone' => 'sky', 'icon' => 'bi-clock-history'],
    ['label' => 'เมนูทั้งหมด', 'value' => count($beverages), 'unit' => 'รายการพร้อมขาย', 'tone' => 'mint', 'icon' => 'bi-cup-hot'],
    ['label' => 'ยอดสั่งวันนี้', 'value' => '128', 'unit' => 'แก้ว', 'tone' => 'blue', 'icon' => 'bi-bag-check']
];

$borrowPercent = 65;

function e($s) {
    return htmlspecialchars((string) $s, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="th">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>แดชบอร์ด · <?php echo e(APP_NAME); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@400;500;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --pp-bg: #f4f8fd;
      --pp-surface: #ffffff;
      --pp-sidebar: #1e2f4d;
      --pp-sidebar-text: #a9bdd6;
      --pp-sidebar-muted: #6f86a6;
      --pp-border: #dce8f5;
      --pp-text: #23364d;
      --pp-muted: #6b819b;
      --pp-primary: #5b9ee6;
      --pp-primary-soft: #d8eafc;
      --pp-sky: #7cc4ec;
      --pp-sky-soft: #ddf1fb;
      --pp-coral: #e8857a;
      --pp-coral-soft: #fce6e3;
      --pp-mint: #5fbfa0;
      --pp-mint-soft: #dcf4ec;
      --sidebar-w: 250px;
    }

    body {
      font-family: 'Prompt', system-ui, sans-serif;
      background: var(--pp-bg);
      color: var(--pp-text);
    }

    /* ---------- Sidebar ---------- */
    .sidebar {
      width: var(--sidebar-w);
      background-color: var(--pp-sidebar) !important;
      border-right: 0;
    }

    @media (min-width: 992px) {
      .sidebar {
        position: fixed;
        inset: 0 auto 0 0;
      }

      .main {
        margin-left: var(--sidebar-w);
      }
    }

    .brand {
      display: flex;
      align-items: center;
      gap: .75rem;
      padding: 1.25rem 1.25rem 1rem;
      color: #fff;
      text-decoration: none;
    }

    .brand-logo {
      width: 40px;
      height: 40px;
      flex-shrink: 0;
      border-radius: 12px;
      display: grid;
      place-items: center;
      background: var(--pp-primary);
      color: #fff;
      font-size: 1.2rem;
    }

    .brand-name {
      font-weight: 600;
      font-size: .9rem;
      line-height: 1.3;
    }

    .menu-title {
      font-size: .72rem;
      letter-spacing: .08em;
      text-transform: uppercase;
      color: var(--pp-sidebar-muted);
      padding: 1rem 1.5rem .5rem;
    }

    .side-link {
      display: flex;
      align-items: center;
      gap: .75rem;
      margin: .15rem .75rem;
      padding: .65rem .9rem;
      border-radius: 10px;
      color: var(--pp-sidebar-text);
      text-decoration: none;
      font-size: .95rem;
      transition: background .15s, color .15s;
    }

    .side-link:hover {
      background: rgba(255, 255, 255, .06);
      color: #fff;
    }

    .side-link.active {
      background: var(--pp-primary);
      color: #fff;
      font-weight: 500;
      box-shadow: 0 4px 12px rgba(91, 158, 230, .35);
    }

    /* ---------- Topbar ---------- */
    .topbar {
      position: sticky;
      top: 0;
      z-index: 1020;
      background: rgba(255, 255, 255, .85);
      backdrop-filter: blur(8px);
      border-bottom: 1px solid var(--pp-border);
    }

    .search {
      max-width: 320px;
    }

    .search .form-control,
    .search .input-group-text {
      background: var(--pp-bg);
      border-color: var(--pp-border);
    }

    .icon-btn {
      width: 40px;
      height: 40px;
      border-radius: 10px;
      border: 1px solid var(--pp-border);
      background: var(--pp-surface);
      color: var(--pp-muted);
      position: relative;
    }

    .icon-btn .dot {
      position: absolute;
      top: 8px;
      right: 9px;
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: var(--pp-coral);
      border: 2px solid #fff;
    }

    .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      display: grid;
      place-items: center;
      background: var(--pp-primary-soft);
      color: var(--pp-primary);
      font-weight: 600;
    }

    /* ---------- Cards ---------- */
    .panel {
      background: var(--pp-surface);
      border: 1px solid var(--pp-border);
      border-radius: 16px;
      box-shadow: 0 4px 16px rgba(35, 54, 77, .04);
    }

    .stat-card {
      padding: 1.25rem;
      height: 100%;
      transition: transform .15s, box-shadow .15s;
    }

    .stat-card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(91, 158, 230, .15);
    }

    .stat-icon {
      width: 48px;
      height: 48px;
      border-radius: 14px;
      display: grid;
      place-items: center;
      font-size: 1.35rem;
    }

    .stat-label {
      color: var(--pp-muted);
      font-size: .9rem;
    }

    .stat-value {
      font-size: 1.9rem;
      font-weight: 600;
      line-height: 1.1;
      font-variant-numeric: tabular-nums;
    }

    .stat-unit {
      color: var(--pp-muted);
      font-size: .85rem;
    }

    .tone-blue {
      background: var(--pp-primary-soft);
      color: var(--pp-primary);
    }

    .tone-sky {
      background: var(--pp-sky-soft);
      color: #3f9fcf;
    }

    .tone-coral {
      background: var(--pp-coral-soft);
      color: var(--pp-coral);
    }

    .tone-mint {
      background: var(--pp-mint-soft);
      color: var(--pp-mint);
    }

    /* ---------- Menu Card ---------- */
    .drink-card {
      border: 1px solid var(--pp-border);
      border-radius: 16px;
      background: var(--pp-surface);
      transition: all .2s ease-in-out;
    }

    .drink-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 8px 24px rgba(91, 158, 230, .18);
    }

    .badge-soft-blue { background: var(--pp-primary-soft); color: #3b7fc8; }
    .badge-soft-coral { background: var(--pp-coral-soft); color: #c95f53; }
    .badge-soft-mint { background: var(--pp-mint-soft); color: #3c9a7c; }
    .badge-soft-sky { background: var(--pp-sky-soft); color: #2b84b0; }

    /* Circular Queue Button */
    .queue-btn-circle {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      background: linear-gradient(135deg, var(--pp-primary) 0%, var(--pp-sky) 100%);
      color: #ffffff;
      border: 5px solid #ffffff;
      box-shadow: 0 8px 20px rgba(91, 158, 230, .4);
      font-weight: 600;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      gap: 4px;
      transition: all .2s ease;
    }

    .queue-btn-circle:hover {
      transform: scale(1.05);
      color: #fff;
      box-shadow: 0 12px 28px rgba(91, 158, 230, .5);
    }

    .ticket-box {
      border: 2px dashed var(--pp-primary);
      background-color: var(--pp-bg);
      border-radius: 16px;
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <aside class="sidebar offcanvas-lg offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="d-flex align-items-start justify-content-between">
      <a class="brand" href="index.php" id="sidebarLabel">
        <span class="brand-logo"><i class="bi bi-cup-hot-fill"></i></span>
        <span class="brand-name"><?php echo e(APP_NAME); ?></span>
      </a>
      <button type="button" class="btn-close btn-close-white d-lg-none m-3" data-bs-dismiss="offcanvas"
        data-bs-target="#sidebar" aria-label="Close"></button>
    </div>

    <div class="menu-title">เมนูหลัก</div>
    <nav>
      <?php foreach ($menu as$item): ?>
        <a class="side-link<?php echo !empty($item['active']) ? ' active' : ''; ?>" href="<?php echo e($item['href']); ?>"
          <?php echo !empty($item['active']) ? 'aria-current="page"' : ''; ?>>
          <i class="bi <?php echo e($item['icon']); ?>"></i>
          <span><?php echo e($item['label']); ?></span>
        </a>
      <?php endforeach; ?>
    </nav>

    <div class="menu-title">ระบบ</div>
    <a class="side-link" href="#"><i class="bi bi-gear"></i><span>ตั้งค่า</span></a>
    <a class="side-link" href="#"><i class="bi bi-box-arrow-left"></i><span>ออกจากระบบ</span></a>
  </aside>

  <div class="main">
    <!-- Topbar -->
    <header class="topbar">
      <div class="d-flex align-items-center gap-3 px-3 px-lg-4 py-3">
        <button class="icon-btn d-lg-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
          aria-controls="sidebar" aria-label="เปิดเมนู">
          <i class="bi bi-list fs-5"></i>
        </button>

        <div class="input-group search d-none d-md-flex">
          <span class="input-group-text"><i class="bi bi-search"></i></span>
          <input type="search" class="form-control" placeholder="ค้นหาเมนูเครื่องดื่ม...">
        </div>

        <div class="ms-auto d-flex align-items-center gap-2">
          <button class="icon-btn" type="button" aria-label="การแจ้งเตือน">
            <i class="bi bi-bell"></i>
            <?php if ($overdue > 0): ?><span class="dot"></span><?php endif; ?>
          </button>
          <div class="dropdown">
            <button class="btn d-flex align-items-center gap-2 p-1 border-0" type="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <span class="avatar">A</span>
              <span class="text-start d-none d-sm-block lh-sm">
                <span class="d-block fw-medium">Admin</span>
                <small class="text-secondary">ผู้จัดการร้าน</small>
              </span>
              <i class="bi bi-chevron-down small text-secondary"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
              <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>โปรไฟล์</a></li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>ตั้งค่า</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-left me-2"></i>ออกจากระบบ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <main class="p-3 p-lg-4">
      <div class="d-flex flex-wrap align-items-end justify-content-between gap-2 mb-4">
        <div>
          <h1 class="h4 fw-semibold mb-1">แดชบอร์ดรับคิวสั่งเครื่องดื่ม</h1>
          <p class="text-secondary mb-0">รายการสินค้าและสถานะคิวประจำวันที่ <?php echo date('d/m/Y'); ?></p>
        </div>
      </div>

      <!-- การ์ดสรุป 4 ใบ -->
      <div class="row g-3 mb-4">
        <?php foreach ($stats as$s): ?>
          <div class="col-12 col-sm-6 col-xl-3">
            <div class="panel stat-card d-flex align-items-center gap-3">
              <div class="stat-icon tone-<?php echo e($s['tone']); ?>"><i class="bi <?php echo e($s['icon']); ?>"></i>
              </div>
              <div>
                <div class="stat-label"><?php echo e($s['label']); ?></div>
                <div class="stat-value"><?php echo e($s['value']); ?></div>
                <div class="stat-unit"><?php echo e($s['unit']); ?></div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- รายการเมนูเครื่องดื่ม (8 รายการ) -->
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3 mb-4">
        <?php foreach ($beverages as$item): ?>
          <div class="col">
            <div class="card h-100 drink-card p-3 text-center position-relative">
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?php echo $item['badge_color']; ?>" style="z-index: 1;">
                <?php echo e($item['badge']); ?>
              </span>

              <div class="stat-icon tone-<?php echo e($item['tone']); ?> mx-auto mb-3" style="width: 70px; height: 70px; font-size: 2rem;">
                <i class="bi <?php echo e($item['icon']); ?>"></i>
              </div>

              <h2 class="h6 fw-bold text-dark mb-1"><?php echo e($item['title']); ?></h2>
              <p class="small text-muted mb-3"><?php echo e($item['subtitle']); ?></p>

              <div class="mt-auto d-flex align-items-center justify-content-between pt-2 border-top">
                <span class="fw-bold text-dark"><?php echo number_format($item['price']); ?> ฿</span>
                <button type="button" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold btn-select-item"
                  data-title="<?php echo e($item['title']); ?>"
                  data-price="<?php echo $item['price']; ?>"
                  onclick="selectBeverage(this)">
                  เลือก
                </button>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <!-- สรุปรายการในตะกร้าชั่วคราว -->
      <div id="orderSummaryBox" class="alert alert-light border-primary shadow-sm rounded-4 d-none mb-4 text-center">
        <span class="text-muted small">สรุปในตะกร้า:</span>
        <strong id="selectedDrinkName" class="text-primary ms-1">-</strong>
        <span class="badge bg-primary ms-2" id="selectedDrinkPrice">0 ฿</span>
        <button type="button" class="btn-close ms-2 float-end small" onclick="clearSelection()"></button>
      </div>

      <!-- ปุ่มใหญ่กดรับคิว -->
      <div class="d-flex justify-content-center my-4">
        <button type="button" class="btn queue-btn-circle" onclick="triggerQueueModal()">
          <i class="bi bi-ticket-perforated-fill fs-3"></i>
          <span>กดรับคิว</span>
        </button>
      </div>

    </main>
  </div>

  <!-- Modal บัตรคิว -->
  <div class="modal fade" id="queueTicketModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title w-100 text-center fw-bold text-success">
            <i class="bi bi-check-circle-fill me-1"></i> รับคิวเรียบร้อย!
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center p-4">
          <p class="small text-muted mb-2"><?php echo e(APP_NAME); ?></p>
          <div class="ticket-box p-3 my-2">
            <span class="small text-muted d-block">หมายเลขคิวของคุณ</span>
            <span class="display-6 fw-bold text-primary d-block my-1" id="modalQueueNumber">A-009</span>
            <span class="badge bg-light text-dark border mt-1" id="modalTicketTime">10:00 น.</span>
          </div>
          <div class="text-start bg-light p-2 rounded-3 small mt-3">
            <span class="text-muted d-block mb-1">รายการเครื่องดื่ม:</span>
            <div class="fw-semibold text-dark" id="modalSelectedSummary">สั่งหน้าร้าน</div>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-primary w-100 rounded-pill fw-semibold" data-bs-dismiss="modal">ตกลง</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal ตะกร้าสินค้า -->
  <div class="modal fade" id="cartModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold text-primary">
            <i class="bi bi-cart-fill me-1"></i> ตะกร้าสินค้าของคุณ
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div id="cartItemsList" class="mb-3" style="max-height: 250px; overflow-y: auto;"></div>
          <div class="d-flex justify-content-between align-items-center pt-3 border-top fw-bold fs-5">
            <span>ราคารวมทั้งหมด:</span>
            <span id="cartTotalPrice" class="text-primary">0 ฿</span>
          </div>
        </div>
        <div class="modal-footer border-0 pt-0">
          <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">เลือกเพิ่ม</button>
          <button type="button" class="btn btn-primary rounded-pill px-4 fw-semibold" onclick="checkoutCart()">ยืนยันรับคิว</button>
        </div>
      </div>
    </div>
  </div>

  <!-- ปุ่มลอยเปิดตะกร้า -->
  <button type="button" id="floatingCartBtn" class="btn btn-primary rounded-circle shadow-lg position-fixed d-none"
    style="bottom: 25px; right: 25px; width: 60px; height: 60px; z-index: 1050; border: 3px solid #fff;"
    onclick="openCartModal()">
    <i class="bi bi-cart-fill fs-4"></i>
    <span id="cartBadgeCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light">0</span>
  </button>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>

  <!-- ระบบตะกร้าและออกคิว -->
  <script>
    let currentQueueNumber = 9;
    let cart = [];

    function selectBeverage(button) {
      const title = button.getAttribute('data-title');
      const price = parseFloat(button.getAttribute('data-price'));

      const existingItem = cart.find(item => item.title === title);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        cart.push({ title: title, price: price, quantity: 1 });
      }

      updateCartUI();
    }

    function updateCartUI() {
      const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
      const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

      const cartBtn = document.getElementById('floatingCartBtn');
      if (totalCount > 0) {
        cartBtn.classList.remove('d-none');
        document.getElementById('cartBadgeCount').innerText = totalCount;
      } else {
        cartBtn.classList.add('d-none');
      }

      const summaryBox = document.getElementById('orderSummaryBox');
      if (totalCount > 0) {
        summaryBox.classList.remove('d-none');
        document.getElementById('selectedDrinkName').innerText = `รวม ${totalCount} รายการ`;
        document.getElementById('selectedDrinkPrice').innerText = totalPrice + ' ฿';
      } else {
        summaryBox.classList.add('d-none');
      }

      renderCartItems();
    }

    function renderCartItems() {
      const listContainer = document.getElementById('cartItemsList');
      const totalPriceEl = document.getElementById('cartTotalPrice');

      if (cart.length === 0) {
        listContainer.innerHTML = `<p class="text-center text-muted my-3">ยังไม่มีสินค้าในตะกร้า</p>`;
        totalPriceEl.innerText = '0 ฿';
        return;
      }

      let html = '';
      let total = 0;

      cart.forEach((item, index) => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        html += `
          <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
            <div>
              <div class="fw-bold text-dark">${item.title}</div>
              <small class="text-muted">${item.price} ฿ / แก้ว</small>
            </div>
            <div class="d-flex align-items-center gap-2">
              <button class="btn btn-sm btn-outline-secondary rounded-circle px-2 py-0" onclick="changeQuantity(${index}, -1)">-</button>
              <span class="fw-bold px-1">${item.quantity}</span>
              <button class="btn btn-sm btn-outline-secondary rounded-circle px-2 py-0" onclick="changeQuantity(${index}, 1)">+</button>
              <span class="fw-bold text-primary ms-2" style="min-width: 50px; text-align: right;">${itemTotal} ฿</span>
            </div>
          </div>
        `;
      });

      listContainer.innerHTML = html;
      totalPriceEl.innerText = total + ' ฿';
    }

    function changeQuantity(index, delta) {
      cart[index].quantity += delta;
      if (cart[index].quantity <= 0) {
        cart.splice(index, 1);
      }
      updateCartUI();
    }

    function openCartModal() {
      renderCartItems();
      const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
      cartModal.show();
    }

    function checkoutCart() {
      const cartModalEl = document.getElementById('cartModal');
      const modalInstance = bootstrap.Modal.getInstance(cartModalEl);
      if (modalInstance) {
        modalInstance.hide();
      }
      triggerQueueModal();
    }

    function clearSelection() {
      cart = [];
      updateCartUI();
    }

    function triggerQueueModal() {
      const queueFormatted = 'A-' + String(currentQueueNumber).padStart(3, '0');
      document.getElementById('modalQueueNumber').innerText = queueFormatted;

      const now = new Date();
      const timeString = now.toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit' }) + ' น.';
      document.getElementById('modalTicketTime').innerText = timeString;

      const summaryContainer = document.getElementById('modalSelectedSummary');
      
      if (cart.length > 0) {
        let summaryHTML = '<ul class="list-unstyled mb-0 small">';
        let totalPrice = 0;
        cart.forEach(item => {
          const subtotal = item.price * item.quantity;
          totalPrice += subtotal;
          summaryHTML += `
            <li class="d-flex justify-content-between mb-1">
              <span><i class="bi bi-cup-straw text-primary me-1"></i> ${item.title} x ${item.quantity}</span>
              <span class="fw-bold">${subtotal} ฿</span>
            </li>`;
        });
        summaryHTML += `</ul>
          <div class="border-top pt-1 mt-1 d-flex justify-content-between fw-bold text-primary">
            <span>ราคารวม:</span>
            <span>${totalPrice} ฿</span>
          </div>`;
        summaryContainer.innerHTML = summaryHTML;
      } else {
        summaryContainer.innerHTML = `<i class="bi bi-shop text-secondary me-1"></i> สั่งหน้าร้าน / ยังไม่ได้เลือกเมนู`;
      }

      const queueModal = new bootstrap.Modal(document.getElementById('queueTicketModal'));
      queueModal.show();

      currentQueueNumber++;
      clearSelection();
    }
  </script>
</body>

</html>