<?php
// Carbohydrate Calculator Template
?>
<div class="card mb-4 calculator carbohydrate-calculator">
    <div class="card-body" x-data="{
        weight: '',
        level: 'moderate',
        grams: null,
        factors: {
            sedentary: 3,
            moderate: 5,
            endurance: 7
        },
        calculate() {
            if (!this.weight) {
                this.grams = null;
                return;
            }
            const factor = this.factors[this.level] || 5;
            this.grams = (Number(this.weight) * factor).toFixed(0);
        }
    }">
        <h4 class="card-title mb-3">Carbohydrate Calculator</h4>
        <div class="mb-2">
            <label for="carb-weight" class="form-label">Body Weight (kg)</label>
            <input id="carb-weight" type="number" min="0" x-model.number="weight" class="form-control w-100" placeholder="e.g. 70" />
        </div>
        <div class="mb-3">
            <label for="carb-level" class="form-label">Training Load</label>
            <select id="carb-level" class="form-select" x-model="level">
                <option value="sedentary">Light / Sedentary (3 g/kg)</option>
                <option value="moderate">Moderate (5 g/kg)</option>
                <option value="endurance">Endurance / Athlete (7 g/kg)</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="calculate">Calculate</button>
        <template x-if="grams">
            <div class="alert alert-success mt-2">
                Daily Carbohydrates: <strong x-text="grams + ' g'"></strong>
            </div>
        </template>
    </div>
</div>

