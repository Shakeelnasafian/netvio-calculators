<?php
// Ideal Weight Calculator Template
?>
<div class="card mb-4 calculator ideal-weight-calculator">
    <div class="card-body" x-data="{ height: '', gender: 'male', result: null }">
        <h4 class="card-title mb-3">Ideal Weight Calculator</h4>
        <div class="mb-2">
            <label for="iwc-height">Height (cm):</label>
            <input id="iwc-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="iwc-gender">Gender:</label>
            <select id="iwc-gender" x-model="gender" class="form-select w-100">
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="
            if (height && gender) {
                result = gender === 'male' ? (50 + 0.91 * (height - 152.4)).toFixed(1) : (45.5 + 0.91 * (height - 152.4)).toFixed(1);
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">Ideal Weight: <strong x-text="result"></strong> kg</div>
        </template>
    </div>
</div>