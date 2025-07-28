<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kwiklly</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <link rel="stylesheet" href="{{ asset('public/assets/website/CSS/style.css')}}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>
<style>
  .extracartmargin {
    margin-top: 120px;
  }

  .qty-container {
    display: flex;
    align-items: center;
    gap: 0px;
    transition: 0.3s ease-in-out;
    width: 90px;
  }

  .add-btn {
    background: #E94412;
    color: white;
    border: none;
    padding: 4px 16px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s ease-in-out;
  }

  .main-content-box {
    background: #fff;
    padding: 0px;
    border-radius: 10px;
    border: 1px solid #FFDBD1;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
  }

  .step-box2 {
    display: flex;
    justify-content: space-between;
    margin-bottom: 1rem;
    flex-wrap: wrap;
  }

  .step-box2 .step {
    flex: 1;
    text-align: center;
    position: relative;
  }

  .step-circle {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: inline-block;
    line-height: 32px;
    text-align: center;
    color: white;
    margin-bottom: 0.25rem;
  }

  .step.active .step-circle {
    background-color: #28a745;
  }

  .step.inactive .step-circle {
    background-color: #ccc;
  }

  .delivery-box,
  .order-summary {
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: white;
    padding: 1rem;
    margin-bottom: 1rem;
  }

  .delivery-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
  }

  .product {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #eee;
    padding: 0.75rem 0;
  }

  .highlight-box,
  .wallet-box,
  .coupon-box {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 1rem;
    margin-bottom: 1rem;
  }

  .confirm-btn,
  .choose-btn {
    width: 100%;
    background-color: #28a745;
    color: #fff;
    border: none;
    padding: 0.75rem;
    border-radius: 6px;
  }

  .choose-btn {
    background-color: #f4511e;
  }

  .bill-summary td {
    padding: 0.25rem 0;
  }

  .alert-success small {
    font-size: 0.85rem;
  }

  .step-circle {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 2px solid #ccc;
    text-align: center;
    line-height: 24px;
    font-size: 14px;
    color: #999;
    font-weight: 500;
  }

  .active-step .step-circle {
    border-color: #28a745;
    color: #28a745;
  }

  .wallet-box {
    background-color: #3B6939;
    font-weight: 500;
  }

  .change-link {
    padding: 15px;
    font-weight: bold;
    color: #ff4d4d;
    cursor: pointer;
  }

  .sidebar {
    position: fixed;
    top: 0;
    right: -100%;
    width: 100%;
    max-width: 520px;
    height: 100%;
    background: #fff;
    box-shadow: -3px 0 8px rgba(0, 0, 0, 0.15);
    z-index: 999999;
    transition: right 0.3s ease-in-out;
    border-left: 1px solid #ccc;
  }

  .sidebar.open {
    right: 0;
  }

  .sidebar-header {
    display: flex;
    align-items: center;
    padding: 16px;
    border-bottom: 1px solid #e0e0e0;
    font-size: 18px;
    font-weight: bold;
  }

  .sidebar-header i {
    margin-right: 10px;
    font-size: 20px;
    cursor: pointer;
  }

  .add-new-address {
    text-align: center;
    color: red;
    font-weight: 600;
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
  }

  .add-new-address:hover {
    text-align: center;
    color: red;
    font-weight: 600;
    padding: 12px;
    border-bottom: 1px solid #f0f0f0;
    cursor: pointer;
  }

  .address-section {
    padding: 16px;
    padding-bottom: 45px;
  }

  .section-title {
    font-size: 14px;
    color: #666;
    margin-bottom: 12px;
  }

  .address-card {
    display: flex;
    align-items: flex-start;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 6px;
    padding: 12px;
    margin-bottom: 12px;
    position: relative;
  }

  .address-card.active {
    background: #f3fff3;
    border-color: #c1eac5;
  }

  .icon {
    margin-right: 10px;
    font-size: 20px;
    margin-top: 3px;
  }

  .address-content {
    flex: 1;
    font-size: 14px;
    line-height: 1.4;
    color: #333;
  }

  .address-content b {
    display: block;
    margin-bottom: 4px;
  }

  .tick-icon {
    font-size: 16px;
    color: green;
    margin-left: 8px;
    margin-top: 2px;
  }

  .menu-icon {
    position: absolute;
    right: 12px;
    top: 16px;
    font-size: 18px;
    color: #999;
    cursor: pointer;
  }

  .ordersummary-box {
    background: #fff;
    border-radius: 8px;
    padding: 20px;
    font-family: Arial, sans-serif;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.05);
  }

  .ordersummary-title {
    font-weight: bold;
    font-size: 18px;
    margin-bottom: 15px;
  }

  .ordersummary-row {
    display: flex;
    justify-content: space-between;
    padding: 10px 0;
    font-size: 14px;
    border-bottom: 1px solid #eee;
  }

  .grandtotal-row {
    border-bottom: none;
    padding-bottom: 0;
  }

  .text-green {
    color: #28a745;
  }

  .final-price {
    color: #000;
    margin-left: 5px;
  }

  .save-box {
    display: inline-block;
    background-color: #d4edda;
    color: #28a745;
    font-size: 12px;
    padding: 2px 6px;
    border-radius: 4px;
    margin-top: 5px;
  }

  .congrats-box {
    background-color: #eaf6f3;
    border-left: 5px solid #28a745;
    border-radius: 6px;
    padding: 10px 15px;
    margin-top: 10px;
    font-size: 14px;
  }

  .congrats-box p {
    margin: 0;
    color: #155724;
  }

  .congrats-box small {
    color: #6c757d;
  }

  .delivery-btn {
    background-color: #f04716;
    color: #fff;
    font-size: 14px;
    width: 100%;
    border: none;
    border-radius: 30px;
    padding: 10px 0;
    margin-top: 15px;
  }

  .cart-items-wrapper {
    max-height: 1000px;
    overflow: hidden;
    transition: max-height 0.4s ease, opacity 0.4s ease;
    opacity: 1;
  }

  .cart-items-wrapper.hidden {
    max-height: 0;
    opacity: 0;
    pointer-events: none;
  }
  @media (max-width: 768px) {
    .extracartmargin {
    margin-top: 90px;
}
.gap-4 {
    gap: 0rem !important;
}

}
</style>

<body>
  <section>
    <div class="container">
      <div class="row">
        <!-- Steps Navigation -->
        <div class="d-flex justify-content-between align-items-center extracartmargin">
          <!-- Steps -->
          <div class="d-flex gap-4">
            <!-- Step 1 -->
            <div class="d-flex align-items-center step-box2 active-step">
              <div class="step-circle">1</div>
              <span class="ms-md-2 step-label fw-bold">Shopping Details</span>
            </div>
            <!-- Step 2 -->
            <div class="d-flex align-items-center step-box2">
              <div class="step-circle inactive">2</div>
              <span class="ms-md-2 step-label text-secondary">Delivery Address</span>
            </div>
            <!-- Step 3 -->
            <div class="d-flex align-items-center step-box2">
              <div class="step-circle inactive">3</div>
              <span class="ms-md-2 step-label text-secondary">Payment Details</span>
            </div>
          </div>

          <!-- Wallet Box -->
          <div class="wallet-box d-flex align-items-center py-1 rounded text-white">
            <i class="fa fa-wallet text-white me-2"></i> ₹55
          </div>
        </div>
        <hr style="border: 1px solid #D8C2BC;">
        <div class="col-md-7 main-content-box">
          <div class=" p-3 rounded my-3 p-3">
            <div class="d-flex justify-content-between align-items-center">
              <div class="gotostore mx-4">
                <h6 class="mb-0 fw-semibold">Aryan Grocery</h6>
                <button class="toggle-bill-btn" id="toggleBillBtn4">
                  hide items <i class="fa fa-chevron-down"></i>
                </button>
              </div>
              <div class="">
                <button class="btn btn-sm delivery-toggle-btn" id="deliveryToggle3">
                  <i class="fa fa-clock me-1"></i> Delivery in 30 min
                </button>
              </div>
            </div>

            <div id="deliveryOptions3" class="" style="display: none;">
              <div class="mt-3">
                <div class="d-flex align-items-center mb-2">
                  <input type="radio" name="deliveryOption" class="form-check-input me-2" checked>
                  <div class="row w-100 gx-2">
                    <div class="col">
                      <select class="form-select form-select-sm">
                        <option>Tomorrow, 11/24</option>
                        <option>Today, 11/23</option>
                      </select>
                    </div>
                    <div class="col">
                      <select class="form-select form-select-sm">
                        <option>10:00 AM - 1:00 PM</option>
                        <option>1:00 PM - 4:00 PM</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="form-check mb-3">
                  <input type="radio" name="deliveryOption" class="form-check-input me-2" id="expressOption">
                  <label for="expressOption" class="form-check-label fw-semibold">
                    Get order in 20 min for ₹5000
                  </label>
                </div>
                <div class="text-center">
                  <span class="text-muted d-block mb-2">or</span>
                  <button class="btn btn-success w-100" id="expressBtn3">
                    <i class="fa fa-bolt me-1"></i> Express Delivery in 20 mins
                  </button>
                </div>
              </div>
            </div>

            <!-- Cart Items -->

            <div id="cartItems" class="cart-items-wrapper">
              <!-- Cart Item 1 -->
              <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-2 p-3">
                <div class="d-flex align-items-center totalimg">
                  <img src="images/category1.png" alt="...">
                  <div class="mx-3">
                    <p class="mb-0">Jackpot Cheese Balls</p>
                    <small class="text-success">₹55 <s class="text-muted">₹60</s></small>
                  </div>
                </div>
                <div class="input-group input-group-sm sidecartbutton" style="width: 90px;">
                  <button class="btn btn-danger decrement-btn">-</button>
                  <input type="text" class="form-control text-center quantity-input" value="1">
                  <button class="btn btn-danger increment-btn">+</button>
                </div>
              </div>

              <!-- Cart Item 2 -->
              <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-2 p-3">
                <div class="d-flex align-items-center totalimg">
                  <img src="images/category3.png" alt="...">
                  <div class="mx-3">
                    <p class="mb-0">Coca Cola - 250 ml</p>
                    <small class="text-success">₹55 <s class="text-muted">₹60</s></small>
                  </div>
                </div>
                <div class="input-group input-group-sm sidecartbutton" style="width: 90px;">
                  <button class="btn btn-danger decrement-btn">-</button>
                  <input type="text" class="form-control text-center quantity-input" value="1">
                  <button class="btn btn-danger increment-btn">+</button>
                </div>
              </div>

              <!-- Cart Item 3 -->
              <div class="cart-item d-flex align-items-center justify-content-between border-bottom py-2 p-3">
                <div class="d-flex align-items-center totalimg">
                  <img src="images/category3.png" alt="...">
                  <div class="mx-3">
                    <p class="mb-0">Coca Cola - 250 ml</p>
                    <small class="text-success">FREE SAMPLE</small>
                  </div>
                </div>
                <button class="add-btn" onclick="convertToQty(this)">
                  Add <img src="images/cart.svg" alt="" class="ms-2">
                </button>
              </div>
            </div>
            <!-- Cart Items end -->
            <!-- Free delivery notice -->
            <div class="my-3 p-3">
              <div class="xyz-info-box">
                <div class="d-flex align-items-center mb-2">
                  <img src="images/demo.png" alt="Icon">
                  <div class="ms-3 w-100">
                    <div>Add item worth ₹<b>5000</b> to get free cook</div>
                    <p class="text-danger p-0 m-0">Accept</p>
                  </div>
                </div>
                <br>
                <div class="xyz-clickable-div" data-state="default" onclick="changeText(this)">
                  <div>Add item worth ₹<b>60</b> more to get free delivery<i class="fa fa-angle-right"
                      style="position: absolute; left: 50%;color:#4caf50;"></i></button></div>
                  <div class="xyz-progress mt-1">
                    <div class="xyz-progress-bar" style="width: 80%"></div>
                  </div>
                </div>

                <div class="xyz-right-text">*Progress Bar will reset in next order</div>
              </div>
            </div>
            <div class=" mb-3 px-2" id="couponsxyz">
              <div class="">
                <h2 class="" id="">
                  <button class="couponbutton" type="button" onclick="showModal()">
                    <i class="fa-solid fa-badge-percent"></i>View Coupons & Offers
                    <i class="fa fa-angle-right" style="position: absolute; left: 50%;color:red;"></i></button>
                </h2>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded mb-3 wallet-box p-3">
              <div>
                <span id="walletText3"><i class="fa fa-wallet me-1"></i> Kwiklly Points</span>
              </div>
              <button class="btn btn-outline-success btn-sm" id="walletBtn3">Use ₹5</button>
            </div>

            <!-- Toggle Button -->
            <div class="d-flex align-items-center p-3">
              <h6 class="fw-bold mb-0">Bill Summary</h6>
              <button class="toggle-bill-btn" id="toggleBillBtn3"><i class="fa fa-chevron-down"></i></button>
            </div>

            <!-- Bill Summary -->
            <div class=" pt-2 mt-2 p-3" id="billSummary3" style="display: none;">
              <ul class="list-unstyled small">
                <li class="d-flex justify-content-between">
                  <span>Item charge</span><span>₹380 <s class="text-muted">₹332</s></span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Delivery Charges</span><span>₹20</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Coupon Discount</span><span class="text-success">- ₹40</span>
                </li>
                <li class="d-flex justify-content-between">
                  <span>Wallet Discount</span><span class="text-success">- ₹5</span>
                </li>
                <li>
                  <div class="ordersummary-row grandtotal-row">
                    <span><strong>Grand Total</strong></span>
                    <div class="text-end">
                      <strong>₹400 <span class="final-price">₹347</span></strong><br>
                      <span class="save-box">Saved ₹53</span>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="delivery-card">
              <div class="delivery-info">
                <div class="details">
                  <div class="name">Proudly sponsored by</div>

                </div>
              </div>
              <div class="company"><span style="color:green;">BLUE</span><span style="color:#0047ab;"> DART</span></div>
            </div>
          </div>

        </div>
        <div class="col-md-5">
          <div class="ordersummary-box">
            <h6 class="ordersummary-title">Order Summary</h6>
            <div class="ordersummary-row">
              <span>Items</span>
              <span>342</span>
            </div>
            <div class="ordersummary-row">
              <span>Sub Total</span>
              <span>₹34121</span>
            </div>
            <div class="ordersummary-row">
              <span>Delivery Fee</span>
              <span>₹2300</span>
            </div>
            <div class="ordersummary-row">
              <span>Coupon Discount</span>
              <span class="text-green">-₹550</span>
            </div>
            <div class="ordersummary-row">
              <span>Wallet Discount</span>
              <span class="text-green">-₹20</span>
            </div>
            <div class="ordersummary-row grandtotal-row">
              <span><strong>Grand Total</strong></span>
              <div class="text-end">
                <strong>₹400 <span class="final-price">₹347</span></strong><br>
                <span class="save-box">Saved ₹53</span>
              </div>
            </div>

            <div class="congrats-box">
              <p><strong>Congratulations!! You got free cook </strong></p>
              <small>by Aryan Grocery</small>
            </div>
            <div class="congrats-box">
              <p><strong>Congratulations!! You got free gift</strong></p>
              <small>by Chandresh Grocery</small>
            </div>

            <button class="delivery-btn">Choose Delivery Address</button>
          </div>
        </div>
      </div>
    </div>
  </section>


  <div class="xyz-modal-overlay" id="couponModalxyz">
    <div class="xyz-modal">
      <!-- Header -->
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0"><b>Coupons</b></h5>
        <button class="xyz-close" onclick="hideModal()">&times;</button>
      </div>

      <!-- Coupon Row 1 -->
      <div class="xyz-coupon-row row m-2">
        <div class="col-6">
          <h6><strong>20% OFF</strong></h6>
          <div style="color: green;">MAX ₹200</div>
          <small>Holi Week Discount</small>
        </div>
        <div class="col-6 text-end">
          <img src="images/klogo.png" alt="logo" class="xyz-coupon-logo">
          <div><small>COUPON EXPIRES 23/05</small></div>
        </div>
      </div>

      <!-- Coupon Row 2 -->
      <div class="xyz-coupon-row row m-2">
        <div class="col-6">
          <h6><strong>20% OFF</strong></h6>
          <div style="color: green;">MAX ₹200</div>
          <small>Holi Week Discount</small>
        </div>
        <div class="col-6 text-end">
          <img src="images/klogo.png" alt="logo" class="xyz-coupon-logo">
          <div><small>COUPON EXPIRES 23/05</small></div>
        </div>
      </div>

      <!-- Coupon Row 3 -->
      <div class="xyz-coupon-row row m-2">
        <div class="col-6">
          <h6><strong>20% OFF</strong></h6>
          <div style="color: green;">MAX ₹200</div>
          <small>Holi Week Discount</small>
        </div>
        <div class="col-6 text-end">
          <img src="images/klogo.png" alt="logo" class="xyz-coupon-logo">
          <div><small>COUPON EXPIRES 23/05</small></div>
        </div>
      </div>

      <!-- Coupon Row 4 -->
      <div class="xyz-coupon-row row m-2">
        <div class="col-6">
          <h6><strong>20% OFF</strong></h6>
          <div style="color: green;">MAX ₹200</div>
          <small>Holi Week Discount</small>
        </div>
        <div class="col-6 text-end">
          <img src="images/klogo.png" alt="logo" class="xyz-coupon-logo">
          <div><small>COUPON EXPIRES 23/05</small></div>
        </div>
      </div>

    </div>
  </div>


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">

      <!-- Desktop: Logo + Location & Search -->
      <div class="d-flex align-items-center w-100 d-md-flex">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo.png" alt="Logo">
        </a>
      </div>
    </div>
  </nav>

  <!-- javascript related to this page don't remove anyone  -->
  <script>
    // cart item hide and show js 
    const toggleBtn = document.getElementById('toggleBillBtn4');
    const cartItems = document.getElementById('cartItems');

    toggleBtn.addEventListener('click', function () {
      cartItems.classList.toggle('hidden');

      if (cartItems.classList.contains('hidden')) {
        toggleBtn.innerHTML = 'show items <i class="fa fa-chevron-up"></i>';
      } else {
        toggleBtn.innerHTML = 'hide items <i class="fa fa-chevron-down"></i>';
      }
    });

    // express time change js 
    document.getElementById("expressBtn3").addEventListener("click", function () {
      const btn = this;
      const isExpress = btn.classList.contains("btn-success");
      if (isExpress) {
        btn.classList.remove("btn-success");
        btn.classList.add("btn-outline-success");
        btn.innerHTML = '<i class="fa fa-times me-1"></i> Remove Express Delivery';
      } else {
        btn.classList.remove("btn-outline-success");
        btn.classList.add("btn-success");
        btn.innerHTML = '<i class="fa fa-bolt me-1"></i> Express Delivery in 20 mins';
      }
    });
    // delviery time managment 

    document.getElementById("deliveryToggle3").addEventListener("click", function () {
      const el = document.getElementById("deliveryOptions3");
      el.style.display = el.style.display === "none" ? "block" : "none";
    });



    document.getElementById("toggleBillBtn3").addEventListener("click", function () {
      const bill = document.getElementById("billSummary3");
      const icon = this.querySelector("i");
      if (bill.style.display === "none") {
        bill.style.display = "block";
        this.innerHTML = "<i class='fa fa-chevron-up'></i>";
      } else {
        bill.style.display = "none";
        this.innerHTML = "<i class='fa fa-chevron-down'></i>";
      }
    });

    //   wallet 
    document.getElementById("walletBtn3").addEventListener("click", function () {
      const btn = this;
      const walletText = document.getElementById("walletText3");
      if (btn.textContent.includes("Use")) {
        btn.textContent = "Remove";
        walletText.innerHTML = '<i class="fa fa-wallet me-1"></i> Added ₹5 in your wallet';
      } else {
        btn.textContent = "Use ₹5";
        walletText.innerHTML = '<i class="fa fa-wallet me-1"></i> Save money by kwikily wallet';
      }
    });

    //   POP UP FOR COUPON 
    function showModal() {
      document.getElementById('couponModalxyz').style.display = 'flex';
    }

    function hideModal() {
      document.getElementById('couponModalxyz').style.display = 'none';
    }
  </script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!--------------- CUSTOM JAVASCRIPT START ----------------->
  <script src="JS/custom.js"></script>
  <!--------------- CUSTOM JAVASCRIPT END ----------------->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
</body>

</html>