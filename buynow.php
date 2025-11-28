<?php
$pageTitle = "Buy Now | GlamStyle Fashions";
include 'header.php';

$title  = $_GET['title'] ?? 'Unknown Product';
$price  = $_GET['price'] ?? '0.00';
$image  = $_GET['img'] ?? 'img/default.jpg';
$description = $_GET['desc']  ?? 'This is a stylish product from GlamStyle Fashions.';
$company   = $_GET['company'] ?? 'GlamStyle';
$amountInPaise = intval(floatval($price) * 100);
$razorpayKey   = 'rzp_test_ek75cF7ikf5j8R';

// Detect Product Type
function detectProductType($title) {
    $title = strtolower($title);

    $clothing_keywords = ['shirt', 't-shirt', 'kurti', 'jeans', 'dress', 'jacket', 'trouser', 'blouse', 'saree', 'lehenga', 'pant', 'top', 'frock', 'chic summer top', 'hoody', 'hoodie'];
    $shoe_keywords     = ['shoes', 'sneakers', 'heels', 'sandals', 'boots', 'footwear', 'stylish elegance shoes', 'high heels elegance', 'socks'];
    $no_size_keywords  = ['laptop', 'bag', 'watch', 'ring', 'mobile'];

    foreach ($no_size_keywords as $kw) {
        if (stripos($title, $kw) !== false) return 'no_size';
    }

    foreach ($clothing_keywords as $kw) {
        if (stripos($title, $kw) !== false) return 'clothing';
    }

    foreach ($shoe_keywords as $kw) {
        if (stripos($title, $kw) !== false) return 'shoes';
    }

    return 'accessory'; // Default
}
$productType = detectProductType($title);
?>

<div class="container py-5">
    <h2 class="text-center mb-4">Buy Now</h2>
    <div class="row">
        <!-- Product Details -->
        <div class="col-md-6">
            <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($title) ?>" class="img-fluid rounded shadow mb-3">
            <h4><?= htmlspecialchars($title) ?></h4>
            <h5 class="text-info">Brand: <?= htmlspecialchars($company) ?></h5>
            <p class="text-muted"><?= htmlspecialchars($description) ?></p>
            <h5 class="text-success">Price: ₹<?= number_format($price, 2) ?></h5>
            <p class="text-warning">★ ★ ★ ★ ☆</p>
        </div>

        <!-- Order Form -->
        <div class="col-md-6">
            <h3>Order Details</h3>
            <form id="orderForm" action="placeorder.php" method="POST" class="mt-4">
                <input type="hidden" name="title" value="<?= htmlspecialchars($title) ?>">
                <input type="hidden" name="price" value="<?= htmlspecialchars($price) ?>">
                <input type="hidden" name="image" value="<?= htmlspecialchars($image) ?>">
                <input type="hidden" name="description" value="<?= htmlspecialchars($description) ?>">
                <input type="hidden" name="company" value="<?= htmlspecialchars($company) ?>">
                <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">

                <div class="mb-3"><label class="form-label">Full Name</label><input type="text" name="fullname" class="form-control" required></div>
                <div class="mb-3"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" required></div>
                <div class="mb-3">
                    <label class="form-label">Pincode</label>
                    <input type="text" name="pincode" id="pincode" class="form-control" maxlength="6" required>
                    <small id="pincodeStatus" class="text-muted"></small>
                </div>
                <div class="mb-3" id="addressDropdownWrapper" style="display:none">
                    <label class="form-label">Choose Your Area</label>
                    <select id="addressDropdown" class="form-select"></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipping Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3" required></textarea>
                </div>
                <div class="mb-3"><label class="form-label">Phone Number</label><input type="tel" name="phone" class="form-control" required></div>

                <!-- Size Selection Based on Product Type -->
                <?php if ($productType === 'clothing'): ?>
                    <div class="mb-3"><label class="form-label">Clothing Size</label>
                    <select name="size" class="form-select" required>
                        <option value="">-- Select Size --</option>
                        <option value="S">S</option><option value="M">M</option><option value="L">L</option><option value="XL">XL</option><option value="XXL">XXL</option>
                    </select></div>
                <?php elseif ($productType === 'shoes'): ?>
                    <div class="mb-3"><label class="form-label">Shoe Size</label>
                    <select name="size" class="form-select" required>
                        <option value="">-- Select Shoe Size --</option>
                        <?php for ($i=5; $i<=11; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select></div>
                <?php else: ?>
                    <input type="hidden" name="size" value="N/A">
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Payment Method</label>
                    <select name="payment" id="payment" class="form-select" required>
                        <option value="">-- Select Payment --</option>
                        <option value="cod">Cash on Delivery</option>
                        <option value="razorpay">Pay Online (Razorpay)</option>
                    </select>
                </div>

                <button type="button" id="payButton" class="btn btn-primary">Confirm Order</button>
            </form>
        </div>
    </div>
</div>

<!-- Razorpay + Address Scripts -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
const customPincodeAddresses = {
  "580020": [
    "Vidya Nagar, Hubli, Karnataka, 580020",
    "Deshpande Nagar, Hubli, Karnataka, 580020",
    "Keshwapur, Hubli, Karnataka, 580020"
  ],
  "580001": [
    "Malammaddi, Dharwad, Karnataka, 580001",
    "Line Bazaar, Dharwad, Karnataka, 580001",
    "Vidyagiri, Dharwad, Karnataka, 580001"
  ],
  "400001": [
    "Fort, Mumbai, Maharashtra, 400001",
    "Ballard Estate, Mumbai, Maharashtra, 400001"
  ]
};

document.getElementById('payButton').addEventListener('click', () => {
  const form = document.getElementById('orderForm');
  const req = ['fullname','email','pincode','address','phone','payment'];
  for (let id of req) {
    if (!form[id]?.value.trim()) { alert('Fill all fields.'); return; }
  }
  if (form.payment.value==='razorpay') {
    const options = {
      "key": "<?= $razorpayKey ?>",
      "amount": "<?= $amountInPaise ?>",
      "currency": "INR",
      "name": "GlamStyle Fashions",
      "description": "Order Payment",
      "image": "<?= $image ?>",
      "handler": function(res) {
        form.razorpay_payment_id.value = res.razorpay_payment_id;
        form.submit();
      },
      "prefill": {
        "name": form.fullname.value,
        "email": form.email.value,
        "contact": form.phone.value
      },
      "theme": {"color":"#d63384"}
    };
    new Razorpay(options).open();
  } else {
    form.submit();
  }
});

document.getElementById('pincode').addEventListener('input', function() {
  const p = this.value;
  const status = document.getElementById('pincodeStatus');
  const wrapper = document.getElementById('addressDropdownWrapper');
  const dropdown = document.getElementById('addressDropdown');
  document.getElementById('address').value = '';
  wrapper.style.display = 'none';
  status.textContent = '';

  if (/^\d{6}$/.test(p)) {
    if (customPincodeAddresses[p]) {
      dropdown.innerHTML = '<option value="">-- Select Area --</option>';
      customPincodeAddresses[p].forEach(addr => {
        dropdown.add(new Option(addr, addr));
      });
      wrapper.style.display = 'block';
      status.textContent = `Showing predefined areas for pincode ${p}.`;
      return;
    }

    status.textContent = 'Looking up areas...';
    fetch(`https://api.postalpincode.in/pincode/${p}`)
      .then(r => r.json())
      .then(data => {
        if (data[0].Status === 'Success') {
          const list = data[0].PostOffice;
          dropdown.innerHTML = '<option value="">-- Select Area --</option>';
          list.forEach(po => {
            const val = `${po.Name}, ${po.Block}, ${po.District}, ${po.State}, ${p}`;
            dropdown.add(new Option(val, val));
          });
          wrapper.style.display = 'block';
          status.textContent = `${list.length} areas found from API.`;
        } else {
          status.textContent = 'No areas found.';
        }
      }).catch(() => {
        status.textContent = 'Lookup error.';
      });
  }
});

document.getElementById('addressDropdown').addEventListener('change', function() {
  document.getElementById('address').value = this.value;
});
</script>

<?php include 'footer.php'; ?>
