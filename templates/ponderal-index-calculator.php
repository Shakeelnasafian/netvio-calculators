<?php // Ponderal Index Calculator Template ?>
<div class="card mb-4 calculator ponderal-index-calculator">
    <div class="card-body" x-data="{ weight: '', height: '', pi: null, category: '' }">
        <h4 class="card-title mb-3">Ponderal Index Calculator</h4>
        <p class="text-muted small">The Ponderal Index (PI) accounts for height more accurately than BMI for very tall or short individuals.</p>
        <div class="mb-2">
            <label for="pi-weight">Weight (kg):</label>
            <input id="pi-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="pi-height">Height (cm):</label>
            <input id="pi-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && height) {
                let h = parseFloat(height) / 100;
                pi = (parseFloat(weight) / Math.pow(h, 3)).toFixed(2);
                if      (pi < 11)  category = 'Very Underweight';
                else if (pi < 14)  category = 'Underweight';
                else if (pi <= 17) category = 'Normal weight';
                else if (pi <= 20) category = 'Overweight';
                else               category = 'Obese';
            }
        ">Calculate</button>
        <template x-if="pi">
            <div class="alert alert-success mt-2">
                Ponderal Index: <strong x-text="pi + ' kg/m³'"></strong>
                <div x-text="'Category: ' + category"></div>
                <div class="text-muted small mt-1">Normal range: 14 – 17 kg/m³</div>
            </div>
        </template>
    </div>
</div>
