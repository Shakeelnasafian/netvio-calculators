<?php
// Protein Calculator Template
?>
<div class="card mb-4 calculator protein-calculator">
    <div class="card-body" x-data="{
        weight: '',
        goal: 'maintenance',
        grams: null,
        multipliers: {
            maintenance: 1.2,
            muscle: 1.6,
            fatloss: 1.8
        },
        calculate() {
            if (!this.weight) {
                this.grams = null;
                return;
            }
            const factor = this.multipliers[this.goal] || 1.2;
            this.grams = (Number(this.weight) * factor).toFixed(0);
        }
    }">
        <h4 class="card-title mb-3">Protein Calculator</h4>
        <div class="mb-2">
            <label for="protein-weight" class="form-label">Body Weight (kg)</label>
            <input id="protein-weight" type="number" min="0" x-model.number="weight" class="form-control w-100" placeholder="e.g. 75" />
        </div>
        <div class="mb-3">
            <label for="protein-goal" class="form-label">Goal</label>
            <select id="protein-goal" class="form-select" x-model="goal">
                <option value="maintenance">General Health (1.2 g/kg)</option>
                <option value="muscle">Muscle Gain (1.6 g/kg)</option>
                <option value="fatloss">Fat Loss / High Protein (1.8 g/kg)</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="calculate">Calculate</button>
        <template x-if="grams">
            <div class="alert alert-success mt-2">
                Daily Protein: <strong x-text="grams + ' g'"></strong>
            </div>
        </template>
    </div>
</div>

