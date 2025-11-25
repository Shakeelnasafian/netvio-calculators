<?php
// BMI Calculator Template (Consistent Design)
?>
<div class="card mb-4 calculator bmi-calculator">
    <div class="card-body" x-data="{ weight: '', height: '', bmi: null, category: '' }">
        <h4 class="card-title mb-3">BMI Calculator</h4>
        <div class="mb-2">
            <label for="bmi-weight">Weight (kg):</label>
            <input id="bmi-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="bmi-height">Height (cm):</label>
            <input id="bmi-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && height) {
                let h = height / 100;
                bmi = (weight / (h * h)).toFixed(2);
                if (bmi < 18.5) category = 'Underweight';
                else if (bmi < 25) category = 'Normal weight';
                else if (bmi < 30) category = 'Overweight';
                else category = 'Obese';
            }
        ">Calculate</button>
        <template x-if="bmi">
            <div class="alert alert-success mt-2">
                BMI: <strong x-text="bmi"></strong>
                <div x-text="category"></div>
            </div>
        </template>
    </div>
</div>