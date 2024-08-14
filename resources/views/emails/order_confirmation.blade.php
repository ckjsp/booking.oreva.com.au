<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 20px;
        }
        .invoice-box {
            width: 90%; /* Adjust the width for better responsiveness */
            max-width: 800px; /* Set a max width */
            margin: auto;
            padding: 20px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 6px;
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Allow the content to wrap on smaller screens */
            margin-bottom: 20px;
            background-color: rgba(47,43,61,.06);
            padding: 10px;
            color: black;
            border-radius: 6px;
        }
        .invoice-header div {
            font-size: 14px;
            line-height: 2.4;
            flex: 1; /* Make each header div take up equal space */
            min-width: 200px; /* Prevent the divs from becoming too small */
            margin-bottom: 10px;
        }
        .invoice-details {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Allow the content to wrap on smaller screens */
            margin-bottom: 20px;
        }
        .invoice-details div {
            width: 100%;
            margin-bottom: 10px;
        }
        .invoice-details h2 {
            font-size: 14px;
            margin: 0;
        }
        .invoice-details p {
            font-size: 14px;
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
        } 
        table th, table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        table th {
            background-color: #f5f5f5;
        }
        table img {
            max-width: 100%;
            height: auto;
        }
        .total-section {
            text-align: right;
            margin-bottom: 20px;
        }
        .total-section div {
            font-size: 14px;
            margin: 5px 0;
        }
        .note {
            font-size: 14px;
            color: #555;
            margin-top: 20px;
        }
        .Vuexy {
            font-size: 1.5rem !important;
        }
        .invoice {
            font-size: 1.125rem;
        }

        /* Media Query for smaller screens */
        @media (max-width: 600px) {
            .invoice-header, .invoice-details {
                flex-direction: column;
            }
            .invoice-header div, .invoice-details div {
                width: 100%;
                text-align: left;
            }
            .invoice-box {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="invoice-box">
        <div class="invoice-header">
            <div style="padding-right:259px">
                <strong class="Vuexy">Oreva</strong><br>
                38 Palladium Cct, Clyde North VIC 3978, Australia
            </div>
            <div>
                <strong class="invoice">Project id #{{ $orderData['list']['id'] }}</strong><br>
                Date Issued: {{ \Carbon\Carbon::now()->format('Y-m-d') }}<br>
                Date Due: {{ \Carbon\Carbon::now()->addDays(7)->format('Y-m-d') }}
            </div>
        </div>
        <div class="invoice-details">
            <div>
                <h2>Invoice To:</h2>
                <p>Customer Name: {{ $orderData['customer']->name }}</p>
                <p>Customer Email: {{ $orderData['customer']->email }}</p>
                <p>Phone Number: {{ $orderData['customer']->phone }}</p>
                <p>Customer ID: {{ $orderData['customer']->id }}</p>
            </div>
            <div>
                <h2>Project To:</h2>
                <p>Builder Name: {{ $orderData['list']['builder_name'] }}</p>
                <p>Builder Email: {{ $orderData['list']['contact_email'] }}</p>
                <p>Phone Number: {{ $orderData['list']['contact_number'] }}</p>
                <p>Address: {{ $orderData['list']['name'] }},{{ $orderData['list']['suburb'] }},{{ $orderData['list']['state'] }},{{ $orderData['list']['pincod'] }}</p>
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Item</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderData['ordersData'] as $item)
                    <tr>
                    <td><img src="https://booking.oreva.au/images/products/{{ $item['product_order_image'] }}" alt="Product Image"></td>
                    <td>{{ $item['product_name'] }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
