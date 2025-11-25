<?php
// Calories Burned Calculator Template
?>
<div class="card mb-4 calculator calories-burned-calculator">
    <div class="card-body" x-data="{ weight: '', duration: '', met: '', result: null }">
        <h4 class="card-title mb-3">Calories Burned Calculator</h4>
        <div class="mb-2">
            <label for="cbc-weight">Weight (kg):</label>
            <input id="cbc-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="cbc-duration">Duration (minutes):</label>
            <input id="cbc-duration" type="number" x-model="duration" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="cbc-met">MET Value:</label>
            <input id="cbc-met" type="number" x-model="met" class="form-control w-100" placeholder="e.g. 8 for running" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && duration && met) {
                let cal = (met * 3.5 * weight / 200) * duration;
                result = cal.toFixed(1);
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">Calories Burned: <strong x-text="result"></strong> kcal</div>
        </template>
    </div>
</div>