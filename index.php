<?php
// ==========================================
// PHP Configuration & Initial Data Setup
// ==========================================
$appName = "สั่งฉันสิจ๊ะ (Sang-Chan-Si-Ja)"; // Application Name
$currentServing = "A-008";
$waitingQueueCount = 4;

// Beverage Array (Data Source)
$beverages = [
    [
        'id'          => 1,
        'title'       => 'ชานมไข่มุก',
        'subtitle'    => 'Bubble Milk Tea',
        'price'       => 45,
        'badge'       => 'ขายดี',
        'badge_color' => 'bg-danger',
        'bg_color'    => '#ffe5ec',
        'icon_color'  => '#ff477e',
        'icon_svg'    => '<path d="M7 11h10l-1 10H8L7 11z"/><path d="M6 11V6a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v5"/><line x1="12" y1="2" x2="12" y2="6"/><circle cx="10" cy="15" r="1" fill="currentColor"/><circle cx="14" cy="16" r="1" fill="currentColor"/><circle cx="12" cy="18" r="1" fill="currentColor"/>'
    ],
    [
        'id'          => 2,
        'title'       => 'ชาเขียวมัทฉะ',
        'subtitle'    => 'Matcha Green Tea',
        'price'       => 50,
        'badge'       => 'แนะนำ',
        'badge_color' => 'bg-success',
        'bg_color'    => '#e8f5e9',
        'icon_color'  => '#2e7d32',
        'icon_svg'    => '<path d="M18 8h1a4 4 0 0 1 0 8h-1"/><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"/><line x1="6" y1="1" x2="6" y2="4"/><line x1="10" y1="1" x2="10" y2="4"/><line x1="14" y1="1" x2="14" y2="4"/>'
    ],
    [
        'id'          => 3,
        'title'       => 'อิตาเลียนโซดา',
        'subtitle'    => 'Italian Soda',
        'price'       => 40,
        'badge'       => 'สดชื่น',
        'badge_color' => 'bg-warning text-dark',
        'bg_color'    => '#fff9c4',
        'icon_color'  => '#f57f17',
        'icon_svg'    => '<path d="M8 2h8l1 7H7L8 2z"/><path d="M7 9l1 12h8l1-12"/><line x1="12" y1="9" x2="12" y2="21"/><path d="M12 2L9 5"/>'
    ],
    [
        'id'          => 4,
        'title'       => 'กาแฟโบราณ',
        'subtitle'    => 'Traditional Coffee',
        'price'       => 35,
        'badge'       => 'เข้มข้น',
        'badge_color' => 'bg-info text-dark',
        'bg_color'    => '#e0f7fa',
        'icon_color'  => '#00838f',
        'icon_svg'    => '<path d="M17 8h1a4 4 0 0 1 0 8h-1"/><path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4Z"/><line x1="12" y1="2" x2="10" y2="8"/>'
    ]
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($appName); ?> - Beverage Dashboard</title>

    <!-- Bootstrap 5.3 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="crossorigin">
   
    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Google Fonts (Prompt) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-pastel: #ff8fa3;
            --secondary-pastel: #ffb3c1;
            --accent-blue: #00b4d8;
            --bg-pastel: #fff0f5;
            --card-shadow: 0 10px 20px rgba(255, 143, 163, 0.15);
        }

        body {
            font-family: 'Prompt', sans-serif;
            background-color: var(--bg-pastel);
            color: #2b2d42;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Header Styling */
        .shop-header {
            background: linear-gradient(135deg, var(--primary-pastel) 0%, var(--secondary-pastel) 100%);
            color: #ffffff;
            padding: 1.25rem 1rem;
            border-bottom-left-radius: 24px;
            border-bottom-right-radius: 24px;
            box-shadow: 0 4px 15px rgba(255, 143, 163, 0.3);
        }

        /* Card Menu Hover Effects */
        .drink-card {
            border: none;
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: all 0.25s ease-in-out;
            background-color: #ffffff;
        }

        .drink-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(255, 143, 163, 0.3);
        }

        .drink-icon-box {
            height: 100px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Big Circular Button Styling (Exact Wireframe match) */
        .queue-btn-wrapper {
            padding: 20px 0;
        }

        .queue-btn-circle {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent-blue) 0%, #90e0ef 100%);
            color: #ffffff;
            border: 6px solid #ffffff;
            box-shadow: 0 10px 25px rgba(0, 180, 216, 0.4);
            font-weight: 700;
            font-size: 1.2rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.25s ease;
            animation: pulse-ring 2s infinite;
        }

        .queue-btn-circle:hover {
            transform: scale(1.08);
            box-shadow: 0 15px 35px rgba(0, 180, 216, 0.6);
            color: #ffffff;
        }

        .queue-btn-circle:active {
            transform: scale(0.95);
        }

        @keyframes pulse-ring {
            0% { box-shadow: 0 0 0 0 rgba(0, 180, 216, 0.5); }
            70% { box-shadow: 0 0 0 18px rgba(0, 180, 216, 0); }
            100% { box-shadow: 0 0 0 0 rgba(0, 180, 216, 0); }
        }

        /* Ticket Modal Custom Style */
        .ticket-box {
            border: 2px dashed #00b4d8;
            background-color: #f8f9fa;
            border-radius: 16px;
        }
    </style>
</head>
<body>

    <!-- Header Section (ชื่อเว็บ / Shop Title) -->
    <header class="shop-header text-center mb-4">
        <div class="container">
            <h1 class="h3 fw-bold mb-0 d-flex align-items-center justify-content-center gap-2">
                <i class="bi bi-cup-hot-fill"></i>
                <span><?php echo htmlspecialchars($appName); ?></span>
            </h1>
        </div>
    </header>

    <div class="container max-width-700 flex-grow-1 d-flex flex-column" style="max-width: 720px;">

        <!-- Status Dashboard Bar -->
        <div class="row g-3 mb-4">
            <div class="col-6">
                <div class="p-3 bg-white rounded-4 shadow-sm text-center border">
                    <small class="text-muted d-block mb-1">คิวที่กำลังรับบริการ</small>
                    <span class="fs-4 fw-bold text-danger"><?php echo htmlspecialchars($currentServing); ?></span>
                </div>
            </div>
            <div class="col-6">
                <div class="p-3 bg-white rounded-4 shadow-sm text-center border">
                    <small class="text-muted d-block mb-1">รอรับบริการ</small>
                    <span class="fs-4 fw-bold" style="color: var(--accent-blue);"><?php echo (int)$waitingQueueCount; ?> คิว</span>
                </div>
            </div>
        </div>

        <!-- 2x2 Grid Layout (เมนูตัวอย่าง 1 - 4 ตาม Wireframe) -->
        <div class="row row-cols-2 g-3 mb-4">
            <?php foreach ($beverages as$item): ?>
                <div class="col">
                    <div class="card h-100 drink-card p-3 text-center position-relative">
                        <!-- Badge -->
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill <?php echo $item['badge_color']; ?>" style="z-index: 1;">
                            <?php echo htmlspecialchars($item['badge']); ?>
                        </span>

                        <!-- Drink Icon Container -->
                        <div class="drink-icon-box mb-3" style="background-color: <?php echo $item['bg_color']; ?>; color: <?php echo$item['icon_color']; ?>;">
                            <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <?php echo $item['icon_svg']; ?>
                            </svg>
                        </div>

                        <!-- Menu Details -->
                        <h2 class="h6 fw-bold text-dark mb-1"><?php echo htmlspecialchars($item['title']); ?></h2>
                        <p class="small text-muted mb-3" style="font-size: 0.8rem;"><?php echo htmlspecialchars($item['subtitle']); ?></p>

                        <!-- Price and Selection Button -->
                        <div class="mt-auto d-flex align-items-center justify-content-between pt-2 border-top">
                            <span class="fw-bold text-dark"><?php echo number_format($item['price']); ?> ฿</span>
                            <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold btn-select-item"
                                    data-title="<?php echo htmlspecialchars($item['title']); ?>"
                                    data-price="<?php echo $item['price']; ?>"
                                    onclick="selectBeverage(this)">
                                เลือก
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Order Summary Floating Toast/Alert Box -->
        <div id="orderSummaryBox" class="alert alert-light border-danger shadow-sm rounded-4 d-none mb-3 text-center">
            <span class="text-muted small">เมนูที่เลือก:</span>
            <strong id="selectedDrinkName" class="text-danger ms-1">-</strong>
            <span class="badge bg-danger ms-2" id="selectedDrinkPrice">0 ฿</span>
            <button type="button" class="btn-close ms-2 float-end small" onclick="clearSelection()"></button>
        </div>

        <!-- Bottom Circular Button (กดรับคิว) -->
        <div class="queue-btn-wrapper mt-auto d-flex justify-content-center">
            <button type="button" class="btn queue-btn-circle" onclick="triggerQueueModal()">
                <i class="bi bi-ticket-perforated-fill fs-3"></i>
                <span>กดรับคิว</span>
            </button>
        </div>

    </div>

    <!-- Footer -->
    <footer class="text-center py-3 text-muted small mt-auto">
        &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($appName); ?>. All rights reserved.
    </footer>

    <!-- Bootstrap 5 Queue Ticket Modal -->
    <div class="modal fade" id="queueTicketModal" tabindex="-1" aria-labelledby="queueTicketModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title w-100 text-center fw-bold text-success" id="queueTicketModalLabel">
                        <i class="bi bi-check-circle-fill me-1"></i> รับคิวเรียบร้อย!
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-4">
                    <p class="small text-muted mb-2"><?php echo htmlspecialchars($appName); ?></p>
                   
                    <div class="ticket-box p-3 my-2">
                        <span class="small text-muted d-block">หมายเลขคิวของคุณ</span>
                        <span class="display-5 fw-extrabold text-primary d-block my-1" id="modalQueueNumber" style="color: var(--accent-blue) !important;">A-009</span>
                        <span class="badge bg-light text-dark border mt-1" id="modalTicketTime">10:00 น.</span>
                    </div>

                    <div class="text-start bg-light p-2 rounded-3 small mt-3">
                        <span class="text-muted d-block mb-1">รายการเครื่องดื่ม:</span>
                        <div class="fw-semibold text-dark" id="modalSelectedSummary">สั่งหน้าร้าน</div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-danger w-100 rounded-pill fw-semibold" data-bs-dismiss="modal">ตกลง</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN (Includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="crossorigin"></script>

    <!-- Custom Interactive JS Logic -->
    <script>
        let currentQueueNumber = 9;
        let selectedDrink = null;

        // Function: Handle Beverage Selection
        function selectBeverage(button) {
            const title = button.getAttribute('data-title');
            const price = button.getAttribute('data-price');

            selectedDrink = { title: title, price: price };

            // Update DOM Summary
            document.getElementById('selectedDrinkName').innerText = title;
            document.getElementById('selectedDrinkPrice').innerText = price + ' ฿';
            document.getElementById('orderSummaryBox').classList.remove('d-none');

            // Highlight active button style
            document.querySelectorAll('.btn-select-item').forEach(btn => {
                btn.classList.remove('btn-danger', 'text-white');
                btn.classList.add('btn-outline-danger');
                btn.innerText = 'เลือก';
            });

            button.classList.remove('btn-outline-danger');
            button.classList.add('btn-danger', 'text-white');
            button.innerText = 'เลือกแล้ว';
        }

        // Function: Clear Selection
        function clearSelection() {
            selectedDrink = null;
            document.getElementById('orderSummaryBox').classList.add('d-none');
            document.querySelectorAll('.btn-select-item').forEach(btn => {
                btn.classList.remove('btn-danger', 'text-white');
                btn.classList.add('btn-outline-danger');
                btn.innerText = 'เลือก';
            });
        }

        // Function: Trigger Queue Modal Pop-up
        function triggerQueueModal() {
            // Generate Queue String (e.g. A-009, A-010)
            const queueFormatted = 'A-' + String(currentQueueNumber).padStart(3, '0');
            document.getElementById('modalQueueNumber').innerText = queueFormatted;

            // Generate Current Timestamp
            const now = new Date();
            const timeString = now.toLocaleTimeString('th-TH', { hour: '2-digit', minute: '2-digit' }) + ' น.';
            document.getElementById('modalTicketTime').innerText = timeString;

            // Update Summary Details
            const summaryContainer = document.getElementById('modalSelectedSummary');
            if (selectedDrink) {
                summaryContainer.innerHTML = `<i class="bi bi-cup-straw text-danger me-1"></i> ${selectedDrink.title} <span class="text-danger float-end">${selectedDrink.price} ฿</span>`;
            } else {
                summaryContainer.innerHTML = `<i class="bi bi-shop text-secondary me-1"></i> สั่งหน้าร้าน / ยังไม่ได้เลือกเมนู`;
            }

            // Show Bootstrap Modal
            const queueModal = new bootstrap.Modal(document.getElementById('queueTicketModal'));
            queueModal.show();

            // Increment queue for next click
            currentQueueNumber++;
           
            // Clear current selection state after ticket generated
            clearSelection();
        }
    </script>

    <!-- ==========================================
         ส่วนระบบตะกร้าสินค้า (Cart System Extension)
         ========================================== -->

    <!-- Modal แสดงรายการในตะกร้า -->
    <div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 border-0 shadow">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold text-danger" id="cartModalLabel">
                        <i class="bi bi-cart-fill me-1"></i> ตะกร้าสินค้าของคุณ
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div id="cartItemsList" class="mb-3" style="max-height: 250px; overflow-y: auto;">
                        <!-- รายการสินค้าจะแสดงที่นี่ -->
                    </div>
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top fw-bold fs-5">
                        <span>ราคารวมทั้งหมด:</span>
                        <span id="cartTotalPrice" class="text-danger">0 ฿</span>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">เลือกเพิ่ม</button>
                    <button type="button" class="btn btn-danger rounded-pill px-4 fw-semibold" onclick="checkoutCart()">ยืนยันรับคิว</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ปุ่มลอยเปิดตะกร้า (Floating Cart Button) -->
    <button type="button" id="floatingCartBtn" class="btn btn-danger rounded-circle shadow-lg position-fixed d-none" 
            style="bottom: 25px; right: 25px; width: 60px; height: 60px; z-index: 1050; border: 3px solid #fff;"
            onclick="openCartModal()">
        <i class="bi bi-cart-fill fs-4"></i>
        <span id="cartBadgeCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark border border-light">
            0
        </span>
    </button>

    <script>
        let cart = [];

        // Override selectBeverage เดิม
        window.selectBeverage = function(button) {
            const title = button.getAttribute('data-title');
            const price = parseFloat(button.getAttribute('data-price'));

            const existingItem = cart.find(item => item.title === title);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ title: title, price: price, quantity: 1 });
            }

            updateCartUI();
        };

        function updateCartUI() {
            const totalCount = cart.reduce((sum, item) => sum + item.quantity, 0);
            const totalPrice = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

            const cartBtn = document.getElementById('floatingCartBtn');
            const cartBadge = document.getElementById('cartBadgeCount');
            if (totalCount > 0) {
                cartBtn.classList.remove('d-none');
                cartBadge.innerText = totalCount;
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
                            <span class="fw-bold text-danger ms-2" style="min-width: 50px; text-align: right;">${itemTotal} ฿</span>
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

        window.clearSelection = function() {
            cart = [];
            updateCartUI();
            document.querySelectorAll('.btn-select-item').forEach(btn => {
                btn.classList.remove('btn-danger', 'text-white');
                btn.classList.add('btn-outline-danger');
                btn.innerText = 'เลือก';
            });
        };

        window.triggerQueueModal = function() {
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
                            <span><i class="bi bi-cup-straw text-danger me-1"></i> ${item.title} x ${item.quantity}</span>
                            <span class="fw-bold">${subtotal} ฿</span>
                        </li>`;
                });
                summaryHTML += `</ul>
                    <div class="border-top pt-1 mt-1 d-flex justify-content-between fw-bold text-danger">
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
        };
    </script>
</body>
</html>