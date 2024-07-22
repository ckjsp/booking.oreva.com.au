<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email-Product-Template</title>
    <style>
        @font-face {
            font-family: "Inter-Bold";
            src: url(../../fonts/Inter-Bold.ttf);
        }
        @font-face {
            font-family: "Inter-SemiBold";
            src: url(../../fonts/Inter-SemiBold.ttf);
        }
        @font-face {
            font-family: "Inter-Medium";
            src: url(../../fonts/Inter-Medium.ttf);
        }
        @font-face {
            font-family: "Inter-Regular";
            src: url(../../fonts/Inter-Regular.ttf);
        }
        body {
            width: 30%;
            margin: auto;
            margin-top: 100px;
            background-color: #F3F3F3;
        }
        .bg_white {
            background-color: #ffffff;
            padding: 10px;
        }
        h1 {
            font-family: "Inter-Bold";
            font-size: 20px;
            background-color: black;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }
        .emailproduct_text {
            font-family: "Inter-Medium";
            font-size: 14px;
            font-weight: 400;
            color: rgb(129, 128, 128);
            text-align: center;
        }
        .email_order_id {
            font-family: "Inter-Bold";
            font-size: 14px;
            font-weight: 500;
            color: #000000;
        }
        table {
            font-family: Arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border-bottom: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            border-top: 1px solid #dddddd;
        }
        .d-flex {
            display: flex;
            gap: 10px;
        }
        .loream_txt {
            font-family: "Inter-Medium";
            font-size: 15px;
            font-weight: 300;
            color: rgb(129, 128, 128);
        }
        .text_center {
            text-align: center;
        }
        a {
            color: #585757;
            text-decoration: none;
        }
        .clrblck {
            color: #000000;
            margin-top: 30px;
        }
        .pd_lft {
            padding-left: 34px;
        }
    </style>
</head>
<body>
    <div class="bg_white">
        <div class="header">
            <h1>Thank you for your order</h1>
        </div>
        <p class="emailproduct_text">Thank you for your order. We appreciate your business and are committed to providing you with the best possible service.</p>
        <h4 class="email_order_id">[Order #14548] (July 29, 2020)</h4>
        <table>
            <tr>
                <th>Product Name</th>
                <th>Product Code</th>
                <th>Quantity</th>
            </tr>
            @foreach ($orderData['ordersData'] as $item)
                <tr>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['product_code'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                </tr>
            @endforeach
        </table>
        <div>
            <p class="loream_txt text_center clrblck">Customer Details</p>
            <div class="text_center">
                <p>Email address: <a href="#">{{ $orderData['customerEmail'] }}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
