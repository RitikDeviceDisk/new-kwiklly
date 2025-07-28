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

  .address-card {
    border-radius: 8px;
    padding: 10px;
    margin: 20px;
    margin-bottom: 15px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    background: #fff;
    position: relative;
  }

  .fancy-checkbox {
    display: inline-block;
    position: relative;
    cursor: pointer;
  }

  .fancy-checkbox input {
    display: none;
    /* Hide native checkbox */
  }

  .custom-checkmark {
    display: inline-block;
    width: 20px;
    height: 20px;
    background-color: white;
    border: 2px solid #ccc;
    border-radius: 4px;
    text-align: center;
    line-height: 18px;
    font-size: 16px;
    color: white;
    transition: all 0.3s ease;
    box-sizing: border-box;
}

  /* When checked, change background and show tick */
  .fancy-checkbox input:checked+.custom-checkmark {
    background-color: #28a745;
    /* green */
    color: white;
    /* tick becomes white */
    border-color: #28a745;
  }
  .proceed-btn2 {
    background-color: #E94412;
    color: white;
    width: fit-content;
    margin: 10px 0px;
    padding: 12px 70px;
    text-align: center;
    border-radius: 999px;
    font-weight: bold;
    font-size: 16px;
    cursor: pointer;
}
.proceed-btn2:hover {
    background-color: #E94412;
    color: white;
}
@media (max-width: 768px) {
    .extracartmargin {
    margin-top: 90px;
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
              <div class="step-circle inactive" style="background-color: #28a745;"><span
                  style="color: white;">&#10003;</span> </div>
              <span class="ms-md-2 step-label text-secondary ">Shopping Details</span>
            </div>
            <!-- Step 2 -->
            <div class="d-flex align-items-center step-box2 active-step">
              <div class="step-circle ">2</div>
              <span class="ms-md-2 step-label fw-bold">Delivery Address</span>
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
        <div class="col-md-6 main-content-box">
          <div class="p-3 ">

            <!-- Location address text -->
            <div class="pata-location-title">Your Location</div>
            <div class="pata-location-desc">
              Cisf ground, gali no 2, near metro station gate no 3, saket, Delhi
            </div>

            <!-- Buttons: Home / Work -->
            <div class="d-flex justify-content-between pata-tag-buttons">
              <button id="pataHomeBtn2" class="pata-home">🏠 Home</button>
              <button id="pataWorkBtn2" class="pata-work">🏢 Work</button>
            </div>

            <!-- Form Inputs -->
            <div class="pata-input"><input type="text" placeholder="Area / Sector / Locality*" class="form-control">
            </div>
            <div class="pata-input"><input type="text" placeholder="Flat / Building no*" class="form-control"></div>
            <div class="pata-input"><input type="text" placeholder="Landmark (optional)" class="form-control"></div>
            <div class="pata-input"><input type="text" placeholder="Pincode*" class="form-control"></div>
            <div class="pata-input"><input type="text" placeholder="Name*" class="form-control"></div>
            <div class="pata-input"><input type="text" placeholder="Phone Number*" class="form-control"></div>
            <div class="pata-input"><input type="text" placeholder="Alternate Phone Number (optional)"
                class="form-control"></div>

            <!-- Save Button -->
            <button class="pata-save-btn">Save Address</button>
          </div>

        </div>
        <div class="col-md-6 main-content-box">
          <div class="address-section pataoverflow">
            <div class="section-title text-center pt-3">
              <h4>Your saved address for current location</h4>
            </div>

            <!-- Active Address -->
            <div class="address-card selected">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/69/69524.png" alt="Home" class="icon">
                <div>
                  <strong>Home</strong>
                  <p>ARYAN KUMAR, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi,
                    India</p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address Card 2 -->
            <div class="address-card">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/609/609803.png" alt="Work" class="icon">
                <div>
                  <strong>Work</strong>
                  <p>Rakesh, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi, India
                  </p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="address-card selected">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/69/69524.png" alt="Home" class="icon">
                <div>
                  <strong>Home</strong>
                  <p>ARYAN KUMAR, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi,
                    India</p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address Card 2 -->
            <div class="address-card">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/609/609803.png" alt="Work" class="icon">
                <div>
                  <strong>Work</strong>
                  <p>Rakesh, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi, India
                  </p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="address-card selected">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/69/69524.png" alt="Home" class="icon">
                <div>
                  <strong>Home</strong>
                  <p>ARYAN KUMAR, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi,
                    India</p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address Card 2 -->
            <div class="address-card">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/609/609803.png" alt="Work" class="icon">
                <div>
                  <strong>Work</strong>
                  <p>Rakesh, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi, India
                  </p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="address-card selected">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/69/69524.png" alt="Home" class="icon">
                <div>
                  <strong>Home</strong>
                  <p>ARYAN KUMAR, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi,
                    India</p>
                </div>
              </div>
              <div class="address-right">
                <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Address Card 2 -->
            <div class="address-card">
              <div class="address-left">
                <img src="https://cdn-icons-png.flaticon.com/128/609/609803.png" alt="Work" class="icon">
                <div>
                  <strong>Work</strong>
                  <p>Rakesh, x 221, Okhla Phase 3 Road Okhla Phase III, Okhla Industrial Estate, New Delhi, Delhi, India
                  </p>
                </div>
              </div>
              <div class="address-right">
               <label class="fancy-checkbox">
                  <input type="checkbox">
                  <span class="custom-checkmark">&#10003;</span>
                </label>
                <div class="dropdown-wrapper">
                  <span class="options" onclick="toggleDropdown(this)">&#8942;</span>
                  <div class="dropdown-menu">
                    <div onclick="editAddress()">Edit</div>
                    <div onclick="deleteAddress(this)">Delete</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-end p-0 mt-3">
         <button class="btn proceed-btn2">Proceed to Pay ₹347</button>
      </div>
      </div>
      
    </div>
  </section>


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg fixed-top">
    <div class="container-fluid">

      <!-- Desktop: Logo + Location & Search -->
      <div class="d-flex align-items-center w-100  d-md-flex">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo.png" alt="Logo">
        </a>
      </div>
    </div>
  </nav>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const homeBtn = document.getElementById("pataHomeBtn2");
      const workBtn = document.getElementById("pataWorkBtn2");

      homeBtn.addEventListener("click", function () {
        homeBtn.classList.add("active");
        workBtn.classList.remove("active");
      });

      workBtn.addEventListener("click", function () {
        workBtn.classList.add("active");
        homeBtn.classList.remove("active");
      });
    });

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