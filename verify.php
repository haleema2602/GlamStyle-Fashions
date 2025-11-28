<?php
require('vendor/autoload.php'); // Path to Composer autoload
use Razorpay\Api\Api;

$api_key = 'rzp_test_YourKeyHere';        // Replace with your Razorpay Key ID
$api_secret = 'your_secret_here';         // Replace with your Razorpay Key Secret

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $payment_id = $_POST['razorpay_payment_id'] ?? '';
    $order_id = $_POST['razorpay_order_id'] ?? '';
    $signature = $_POST['razorpay_signature'] ?? '';

    if ($payment_id && $order_id && $signature) {
        try {
            $api = new Api($api_key, $api_secret);

            $attributes = [
                'razorpay_order_id' => $order_id,
                'razorpay_payment_id' => $payment_id,
                'razorpay_signature' => $signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Signature verified successfully
            echo "<h2>Payment Successful</h2>";
            echo "<p>Payment ID: " . htmlspecialchars($payment_id) . "</p>";
            echo "<p>Order ID: " . htmlspecialchars($order_id) . "</p>";

            // ✅ You can now mark the order as paid in your database

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            echo "<h2 style='color:red;'>Payment Failed</h2>";
            echo "<p>Error: " . $e->getMessage() . "</p>";
        }
    } else {
        echo "<h2 style='color:red;'>Invalid Payment Request</h2>";
    }
} else {
    echo "<h2 style='color:red;'>Invalid Request Method</h2>";
}
 
