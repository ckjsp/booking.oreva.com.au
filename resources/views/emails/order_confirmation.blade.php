<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Dear {{ $orderData['customerName'] }},</p>
    <p>Thank you for your order. Here are your order details:</p>
    <ul>
        <li>Order ID: {{ $orderData['orderId'] }}</li>
        <li>Order Date: {{ $orderData['orderDate'] }}</li>
        <li>Total Amount: {{ $orderData['orderAmount'] }}</li>
    </ul>
    <p>For any questions or concerns, please contact our support team.</p>
</body>
</html>

