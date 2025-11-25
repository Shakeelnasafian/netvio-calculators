<?php
// Army Body Fat Calculator Template
?>
<div class="card mb-4 calculator army-body-fat-calculator">
    <div class="card-body" x-data="{ gender: 'male', waist: '', neck: '', height: '', hip: '', result: null }">
        <h4 class="card-title mb-3">Army Body Fat Calculator</h4>
        <div class="mb-2">
            <label for="abfc-gender">Gender:</label>
            <select id="abfc-gender" x-model="gender" class="form-select w-100">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="abfc-waist">Waist (cm):</label>
            <input id="abfc-waist" type="number" x-model="waist" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="abfc-neck">Neck (cm):</label>
            <input id="abfc-neck" type="number" x-model="neck" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="abfc-height">Height (cm):</label>
            <input id="abfc-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <template x-if="gender === 'female'">
            <div class="mb-2">
                <label for="abfc-hip">Hip (cm):</label>
                <input id="abfc-hip" type="number" x-model="hip" class="form-control w-100" />
            </div>
        </template>
        <button class="btn btn-primary w-100" @click="
            if (gender === 'male' && waist && neck && height) {
                let bf = 495 / (1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height)) - 450;
                result = bf.toFixed(1);
            } else if (gender === 'female' && waist && neck && hip && height) {
                let bf = 495 / (1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.22100 * Math.log10(height)) - 450;
                result = bf.toFixed(1);
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">Body Fat: <strong x-text="result"></strong>%</div>
        </template>
    </div>
</div>