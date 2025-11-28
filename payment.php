<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" src="styles/payment.css">
</head>

<body>

    <div class="pay_container">

        <form action="" method="POST">

            <div class="row">

                <div class="col">

                    <h3 class="title">billing address</h3>
                    <div class="inputBox">
                        <span>email :</span>
                        <input type="email" placeholder="example@example.com" required>
                    </div>
                    <div class="inputBox">
                        <span>address :</span>
                        <input type="text" placeholder="your address" name="address" required>
                    </div>
                    <div class="inputBox">
                        <span>city :</span>
                        <input type="text" placeholder="Addis Abab" name="city" required>
                    </div>

                    <div class="inputBox">
                        <span>Country :</span>
                        <input type="text" placeholder="Ethipia" name="country" required>
                    </div>
                </div>
                <div class="col">

                    <h3 class="title">payment</h3>

                    <div class="inputBox">
                        <span>cards accepted :</span>
                        <img src="images/card_img.png" alt=""><br>
                        <img src="images/telebirr.jpg" alt="">
                        <p style="display: inline-block;">number: 0912121212</p>
                        <span>Account Number: 1000232323232(CBE)</span>

                    </div>
                    <div class="inputBox">
                        <span>credit card number :</span>
                        <input type="number" placeholder="credit card number" name="card" min="1">
                    </div>
                    <input type="submit" value="Done" class="submit-btn" name="pay">
                </div>

            </div>

        </form>

</body>

</html>