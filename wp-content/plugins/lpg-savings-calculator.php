<?php
/*
Plugin Name: LPG Savings Calculator
Description: A simple WordPress shortcode to estimate savings after installing LPG.
Version: 1.0
Author: Your Name
*/

// Shortcode function
function lpg_savings_calculator() {
    ob_start(); ?>
    <style>
        #lpgCalculator {
            font-family: Arial, sans-serif;
            max-width: auto;
            margin: auto;
            padding: 20px;
            background: #f8f8f8;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        #lpgCalculator .form-group {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 10px 0;
        }
        #lpgCalculator label {
            font-weight: bold;
            color: red;
            flex: 1;
        }
        #lpgCalculator input {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: right;
            background: #eee;
        }
        #lpgCalculator button {
            width: 100%;
            padding: 10px;
            background: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #lpgCalculator button:hover {
            background: darkred;
        }
        #savings {
            display: inline-block;
            width: 100%;
            background: #eee;
            padding: 8px;
            border-radius: 5px;
            text-align: right;
        }
    </style>
    <form id="lpgCalculator">
        <div class="form-group">
            <label>1 Lt of Gasoline</label>
            <input type="number" id="gasolinePrice" step="0.01" required> ₹
        </div>
        <div class="form-group">
            <label>1 Lt of Gas</label>
            <input type="number" id="gasPrice" step="0.01" required> ₹
        </div>
        <div class="form-group">
            <label>Consumption per 100 Km</label>
            <input type="number" id="consumption" step="0.1" required> Lt
        </div>
        <div class="form-group">
            <label>Mileage per Month</label>
            <input type="number" id="mileage" required> Km
        </div>
        <button type="button" onclick="calculateSavings()">Calculate</button>
        <h3>Estimated Monthly Savings: ₹<span id="savings">0</span></h3>
    </form>
    
    <script>
        function calculateSavings() {
            let gasolinePrice = parseFloat(document.getElementById('gasolinePrice').value);
            let gasPrice = parseFloat(document.getElementById('gasPrice').value);
            let consumption = parseFloat(document.getElementById('consumption').value);
            let mileage = parseFloat(document.getElementById('mileage').value);
            
            if (isNaN(gasolinePrice) || isNaN(gasPrice) || isNaN(consumption) || isNaN(mileage)) {
                alert('Please fill in all fields correctly.');
                return;
            }
            
            let costGasoline = (mileage / 100) * consumption * gasolinePrice;
            let costGas = (mileage / 100) * consumption * gasPrice;
            let savings = costGasoline - costGas;
            
            document.getElementById('savings').textContent = savings.toFixed(2);
        }
    </script>
    <?php
    return ob_get_clean();
}

// Register shortcode
add_shortcode('lpg_savings_calculator', 'lpg_savings_calculator');
