<?php
// Fat Intake Calculator Template
?>
<div class="card mb-4 calculator fat-intake-calculator">
    <div class="card-body" x-data="{
        calories: '',
        percent: 30,
        grams: null,
        calculate() {
            if (!this.calories) {
                this.grams = null;
                return;
            }
            const calories = Number(this.calories);
            this.grams = ((calories * this.percent / 100) / 9).toFixed(1);
        }
    }">
        <h4 class="card-title mb-3">Fat Intake Calculator</h4>
        <div class="mb-2">
            <label for="fat-calories" class="form-label">Daily Calories</label>
            <input id="fat-calories" type="number" min="0" x-model.number="calories" class="form-control w-100" placeholder="e.g. 2000" />
        </div>
        <div class="mb-3">
            <label for="fat-percent" class="form-label">Fat Percentage of Calories</label>
            <select id="fat-percent" class="form-select" x-model.number="percent">
                <option value="20">20% (Lower Fat)</option>
                <option value="25">25%</option>
                <option value="30">30% (Balanced)</option>
                <option value="35">35% (Higher Fat)</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="calculate">Calculate</button>
        <template x-if="grams">
            <div class="alert alert-success mt-2">
                Daily Fat: <strong x-text="grams + ' g'"></strong>
            </div>
        </template>
    </div>
</div>