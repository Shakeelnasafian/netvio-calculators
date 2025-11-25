<?php
// Lean Body Mass Calculator Template
?>
<div class="card mb-4 calculator lean-body-mass-calculator">
    <div class="card-body" x-data="{ weight: '', height: '', gender: 'male', result: null }">
        <h4 class="card-title mb-3">Lean Body Mass Calculator</h4>
        <div class="mb-2">
            <label for="lbm-weight">Weight (kg):</label>
            <input id="lbm-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="lbm-height">Height (cm):</label>
            <input id="lbm-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="lbm-gender">Gender:</label>
            <select id="lbm-gender" x-model="gender" class="form-select w-100">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && height && gender) {
                let lbm = gender === 'male' ? (0.407 * weight + 0.267 * height - 19.2) : (0.252 * weight + 0.473 * height - 48.3);
                result = lbm.toFixed(1);
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">Lean Body Mass: <strong x-text="result"></strong> kg</div>
        </template>
    </div>
</div>