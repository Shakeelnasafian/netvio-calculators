<?php // Water Intake Calculator Template ?>
<div class="card mb-4 calculator water-intake-calculator">
    <div class="card-body" x-data="{ weight: '', activity: 'moderate', climate: 'normal', liters: null, glasses: null }">
        <h4 class="card-title mb-3">Water Intake Calculator</h4>
        <div class="mb-2">
            <label for="water-weight">Body Weight (kg):</label>
            <input id="water-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="water-activity">Activity Level:</label>
            <select id="water-activity" x-model="activity" class="form-control w-100">
                <option value="sedentary">Sedentary (little/no exercise)</option>
                <option value="light">Light (1-3 days/week)</option>
                <option value="moderate" selected>Moderate (3-5 days/week)</option>
                <option value="active">Active (6-7 days/week)</option>
                <option value="very-active">Very Active (2× per day)</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="water-climate">Climate:</label>
            <select id="water-climate" x-model="climate" class="form-control w-100">
                <option value="cold">Cold</option>
                <option value="normal" selected>Normal/Temperate</option>
                <option value="hot">Hot / Humid</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight) {
                let w = parseFloat(weight);
                let base = w * 0.033;
                let actMult = { sedentary: 0, light: 0.15, moderate: 0.35, active: 0.5, 'very-active': 0.7 };
                let climMult = { cold: -0.1, normal: 0, hot: 0.3 };
                let total = base + actMult[activity] + climMult[climate];
                liters  = total.toFixed(2);
                glasses = Math.round(total / 0.25);
            }
        ">Calculate</button>
        <template x-if="liters">
            <div class="alert alert-success mt-2">
                Daily Water Intake: <strong x-text="liters + ' litres'"></strong>
                <div class="text-muted small mt-1">≈ <span x-text="glasses"></span> glasses (250 ml each)</div>
            </div>
        </template>
    </div>
</div>
