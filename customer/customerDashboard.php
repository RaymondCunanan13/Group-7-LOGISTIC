
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GO SHDC </title>
    <link rel="stylesheet" href="../styles/signup.css">
</head>
<body>

<div class="container">

        
    <form method="post" action="customerDashboardLogic.php" onsubmit="return validateForm();">

               
        <label for="cargo_name">Cargo Name: </label>
        <input type="text" id="cargo_name" name="cargo_name" class="input-field" required>

        <label for="pickup_point">Pickup Point: </label>
        <input type="text" id="pickup_point" name="pickup_point" class="input-field" required>

        <label for="dropoff_point">Drop-off Point: </label>
        <input type="text" id="dropoff_point" name="dropoff_point" class="input-field" required>

        <label for="weight">Weight of Cargo (kg): </label>
            <input type="number" name="weight" id="weight" class="input-field" required oninput="calculateCargoCost()">


        <label for="length">Length of Cargo (cm): </label>
        <input type="number" id="length" name="length" class="input-field" required>

        <label for="width">Width of Cargo (cm): </label>
        <input type="number" id="width" name="width" class="input-field" required>

        <label for="height">Height of Cargo (cm): </label>
        <input type="number" id="height" name="height" class="input-field" required>

        <label for="distance">Distance of Transport (km): </label>
        <input type="number" id="distance" name="distance" class="input-field" required>

        <label for="rate">Select Rate: </label>
        <select id="rate" name="rate" class="select-field" required>
            <option value="0.10">Point-to-Point (0.10)</option>
            <option value="0.25">Cross-Island (0.25)</option>
            <option value="0.40">Heavy and Special (0.40)</option>
        </select><br>

        <label for="currency">Select Currency: </label>
        <select id="currency" name="currency" class="select-field">
            <option value="USD">USD (U.S. Dollar)</option>
            <option value="PHP">PHP (Philippine Peso)</option>
            <option value="EUR">EUR (Euro)</option>
            <option value="JPY">JPY (Japanese Yen)</option>
            <option value="GBP">GBP (British Pound)</option>
            <option value="AUD">AUD (Australian Dollar)</option>
            <option value="CAD">CAD (Canadian Dollar)</option>
            <option value="CNY">CNY (Chinese Yuan)</option>
            <option value="INR">INR (Indian Rupee)</option>
            <!-- Add more currencies as needed -->
        </select><br>


             <p id="result"></p>

         <input id="button" type="submit" value="Go Deliver"><br><br>
    </form>


</div>

<script>
   
    function calculateCargoCost() {
        var cargo_name = document.getElementById('cargo_name').value;
        var pickup_point = document.getElementById('pickup_point').value;
        var dropoff_point = document.getElementById('dropoff_point').value;
        var weight = parseFloat(document.getElementById('weight').value);
        var length = parseFloat(document.getElementById('length').value);
        var width = parseFloat(document.getElementById('width').value);
        var height = parseFloat(document.getElementById('height').value);
        var distance = parseFloat(document.getElementById('distance').value);
        var rate = parseFloat(document.getElementById('rate').value);
        var currency = document.getElementById('currency').value;

        if (cargo_name.trim() === '' || pickup_point.trim() === '' || dropoff_point.trim() === '' || isNaN(weight) || isNaN(length) || isNaN(width) || isNaN(height) || isNaN(distance) || isNaN(rate)) {
            alert("Please enter valid values for cargo name, pickup point, drop-off point, weight, dimensions, distance, and rate.");
            return;
        }

        var volume = (length * width * height) / 1000000; // Convert cm³ to dm³
        var cargo_cost = weight * volume * distance * rate;

        // Define exchange rates (replace with actual rates)
        var exchangeRates = {
            'USD': 1.0,
            'PHP': 50.0,
            'EUR': 0.85,
            'JPY': 110.0,
            'GBP': 0.75,
            'AUD': 1.35,
            'CAD': 1.25,
            'CNY': 6.45,
            'INR': 75.0
            // Add more currencies and their exchange rates as needed
        };

        // Convert the cargo cost to the selected currency
        cargo_cost /= exchangeRates[currency];

        document.getElementById('result').innerHTML = 'Cargo Cost for ' + cargo_name + ' from ' + pickup_point + ' to ' + dropoff_point + ': ' + formatCurrency(cargo_cost, currency);
    }

    function formatCurrency(amount, currency) {
        var formatter = new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: currency
        });
        return formatter.format(amount);
    }
    function validateForm() {
        // Implement client-side validation if needed
        return true; // Return false if validation fails
    }


    
</script>



</body>
</html>
