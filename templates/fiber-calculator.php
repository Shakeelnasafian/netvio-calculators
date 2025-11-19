<?php
// Fiber Calculator Template
?>
<div class="card mb-4 calculator fiber-calculator">
    <div class="card-body" x-data="{
        calories: '',
        result: null,
        calculate() {
            if (!this.calories) {
                this.result = null;
                return;
            }
            const calories = Number(this.calories);
            if (calories <= 0) {
                this.result = null;
                return;
            }
            const fiber = (calories / 1000) * 14;
            this.result = fiber.toFixed(1);
        }
    }">
        <h4 class="card-title mb-3">Fiber Calculator</h4>
        <div class="mb-2">
            <label for="fiber-calories" class="form-label">Daily Calorie Intake</label>
            <input id="fiber-calories" type="number" min="0" x-model.number="calories" class="form-control w-100" placeholder="e.g. 2200" />
        </div>
        <button class="btn btn-primary w-100" @click="calculate">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">
                Recommended Fiber: <strong x-text="result + ' g/day'"></strong>
                <div class="small text-muted">Using 14 grams per 1,000 calories (Institute of Medicine guideline).</div>
            </div>
        </template>
    </div>
</div>

