<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>POS Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 300px;
            margin: 20px auto;
            border: 1px solid #000;
            padding: 10px;
        }

        .header h1 {
            text-align: center;
            margin: 0;
        }

        .header p {
            margin: 5px 0;
        }

        .item {
            border-top: 1px dashed #000;
            padding: 5px 0;
        }

        .totals {
            margin-top: 10px;
            border-top: 2px solid #000;
            padding-top: 10px;
        }

        .strong {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <h1>Receipt</h1>
            <p>Date: <span id="date">[Date]</span></p>
            <p>Cashier: <span id="cashier">[Cashier Name]</span></p>
            <p>Address: <span id="address">[Address]</span></p>
        </div>
        <div class="items">
            <div class="item">
                <table style="width: 100%; margin-top: 4px"> 
                    <tr>
                        <td>Item Name</td>
                        <td style="text-align: center">12</td>
                        <td style="text-align: end">Rp. 12.000</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>- Rp. 1.000</td>
                        <td style="text-align: end">Rp. 11.000</td>
                    </tr>
                </table>
                
                <table style="width: 100%; margin-top: 4px"> 
                    <tr>
                        <td>Item Name</td>
                        <td style="text-align: center">12</td>
                        <td style="text-align: end">Rp. 12.000</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>- Rp. 1.000</td>
                        <td style="text-align: end">Rp. 11.000</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="totals">
            <p><strong>Sub Total:</strong> [Sub Total]</p>
            <p><strong>Total Discount:</strong> [Total Discount]</p>
            <p><strong>Grand Total:</strong> [Grand Total]</p>
        </div>
    </div>
</body>
</html>
