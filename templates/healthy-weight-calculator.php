<?php
// Healthy Weight Calculator Template
?>
<div class="card mb-4 calculator healthy-weight-calculator">
    <div class="card-body" x-data="{ height: '', min: null, max: null }">
        <h4 class="card-title mb-3">Healthy Weight Calculator</h4>
        <div class="mb-2">
            <label for="hwc-height">Height (cm):</label>
            <input id="hwc-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (height) {
                let h = height / 100;
                min = (18.5 * h * h).toFixed(1);
                max = (24.9 * h * h).toFixed(1);
            }
        ">Calculate</button>
        <template x-if="min && max">
            <div class="alert alert-success mt-2">Healthy Weight Range: <strong x-text="min + ' - ' + max"></strong> kg</div>
        </template>
    </div>
</div>