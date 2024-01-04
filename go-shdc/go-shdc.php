<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC</title>
    <style>
       body {
            font-family: 'Courier New', Courier, monospace;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
           background: rgb(16,10,92);
            color: #fff;
            padding: 15px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header img {
            height: 120px;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
        }

        nav li {
            margin-right: 20px;
        }

        nav li:last-child {
            margin-right: 0;
        }

        nav a {
            text-decoration: none;
            color: #fff;
            display: flex;
            align-items: center;
        }

        nav button {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        nav .selected {
            background-color: #2196F3;
        }

        nav button img {
            width: 20px;
            height: 20px;
            margin-right: 5px;
            filter: invert(100%) sepia(0%) saturate(7213%) hue-rotate(199deg) brightness(114%) contrast(100%);
        }

        nav ul.dropdown {
            display: none;
            position: absolute;
            background-color: rgb(15, 16, 53);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            z-index: 1;
            padding: 5px;
            border-radius: 8px;
        }

        nav li:hover .dropdown {
            display: flex;
            flex-direction: column;
        }

        nav .dropdown a {
            padding: 8px;
            text-decoration: none;
            color: #fff;
            display: block;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
        }

        nav .dropdown a:hover {
            background-color: #2196F3;
        }

        main {
            padding: 40px;
            flex: 1;
            text-align: center;
            background: linear-gradient(to bottom, rgba(173, 216, 230, 0.5), rgba(173, 216, 230, 0.5)),
                        url('../icon/deliveryman.png') center/cover;
            background-attachment: fixed;
            animation: alternateBackgrounds 10s linear infinite;
            color: rgb(15, 16, 53);
        }

        @keyframes alternateBackgrounds {
            0%, 100% {
                background-image: linear-gradient(to bottom, rgba(173, 216, 230, 0.5), rgba(173, 216, 230, 0.5)),
                                url('deliveryman.png') center/cover;
            }
            50% {
                background-image: linear-gradient(to bottom, rgba(173, 216, 230, 0.5), rgba(173, 216, 230, 0.5)),
                                url('box.png') center/cover;
            }
        }

        h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 30px;
            color: #FFF;
        }

        button {
            background-color: #2196F3;
            color: #fff;
            padding: 15px 30px;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #1565C0;
        }

        footer {
            background-color: rgb(15, 16, 53);
            color: #fff;
            text-align: center;
            padding: 15px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        .flip-card {
            background-color: transparent;
            width: 300px;
            height: 300px;
            perspective: 1000px;
            margin: 20px; /* Added margin for spacing */
            display: inline-block; /* Ensures horizontal alignment */
        }

        .flip-card-inner {
            position: relative;
            width: 100%;
            height: 100%;
            text-align: center;
            transition: transform 0.6s;
            transform-style: preserve-3d;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            transform: rotateY(0deg); /* Only rotating on Y-axis */
        }

        .flip-card:hover .flip-card-inner {
            transform: rotateY(180deg); /* Only rotating on Y-axis */
        }

        .flip-card-front, .flip-card-back {
            position: absolute;
            width: 100%;
            height: 100%;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
        }

        .flip-card-front {
    background: rgb(15, 16, 53);
            color: black;
        }

        .flip-card-back {
    background: rgb(15, 16, 53);
            color: white;
            transform: rotateY(180deg);
            padding: 20px;
        }
    </style>
</head>

<body>
    <header>
        <div>
            <img src="../icon/go-shdc.png"  alt="Company Logo">
        </div>
        <nav>
            <ul>
                <li><a href="go-shdc.php">Home</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="support.html">Support</a></li>
                <li>
                    <button class="selected">
                        <img src="../icon/menu.png" alt="More Icon">Log In
                    </button>
                    <ul class="dropdown">
                        <li><a href="../customer/logCustomer.php"><img src="../icon/user.png" alt="User Icon" style="width: 20px; height: 20px; margin-right: 5px;"> New Customer</a></li>
                        <li><a href="../driver/logDriver.php"><img src="../icon/user.png" alt="User Icon" style="width: 20px; height: 20px; margin-right: 5px;"> Delivery Driver</a></li>
                        <li><a href="../admin/logAdmin.php"><img src="../icon/user.png" alt="User Icon" style="width: 20px; height: 20px; margin-right: 5px;"> Admin</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>GO SHDC - Shipping & Delivery of Cargo</h1>
        <p>Let's start so you can create your first delivery request</p>

      <marquee><img src="../icon/box2.gif"></marquee><br><br>

              <?php include('../driver/driverDashboard.php');
 ?><br><br>
    

        <br><br><br><br>

        <h1>Implement user accounts for customers and administrators to manage and track shipments.</h1>



        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="../icon/customer-service.png" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h1>Go Vendor</h1>
                    <p>Service delivery, the main goal is to provide services from a vendor to a customer.</p>
                    <button><a href="../customer/customerSign.php">Create Account</button></a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="../icon/buy-home.png" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h1>Go Deliver</h1>
                    <p>Delivery drivers collect items from one location to transport them to a different destination.</p>
                    <button><a href="../driver/driverSign.php">Create Account</button></a>
                </div>
            </div>
        </div>

        <div class="flip-card">
            <div class="flip-card-inner">
                <div class="flip-card-front">
                    <img src="../icon/key.png" alt="Avatar" style="width:300px;height:300px;">
                </div>
                <div class="flip-card-back">
                    <h1>Go Manage</h1>
                    <p>An Administrator, performs clerical duties to help an office run smoothly and efficiently. </p>
                    <button><a href="../admin/adminSign.php">Create Account</button></a>
                </div>
            </div>
        </div>

        <br><br><br><br>

        <h1>Display relevant information, such as shipping vessel details, container numbers, and departure/arrival times.</h1>



           <br><br> <?php include("../customer/customerDashboard.php"); ?>

    </main>

    <footer>
        &copy; 2023 GO SHDC. All Rights Reserved.
    </footer>
</body>

</html>
