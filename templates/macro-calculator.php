<?php
// Macro Calculator Template
?>
<div class="card mb-4 calculator macro-calculator">
    <div class="card-body" x-data="{
        calories: '',
        proteinPercent: 30,
        carbPercent: 40,
        fatPercent: 30,
        result: null,
        error: '',
        calculate() {
            const total = Number(this.proteinPercent) + Number(this.carbPercent) + Number(this.fatPercent);
            if (!this.calories) {
                this.error = 'Enter your daily calorie target.';
                this.result = null;
                return;
            }
            if (Math.abs(total - 100) > 0.5) {
                this.error = 'Macro percentages must total 100%.';
                this.result = null;
                return;
            }
            const calories = Number(this.calories);
            this.result = {
                protein: ((calories * this.proteinPercent / 100) / 4).toFixed(1),
                carbs: ((calories * this.carbPercent / 100) / 4).toFixed(1),
                fats: ((calories * this.fatPercent / 100) / 9).toFixed(1),
            };
            this.error = '';
        }
    }">
        <h4 class="card-title mb-3">Macro Calculator</h4>
        <div class="mb-2">
            <label for="macro-calories" class="form-label">Daily Calories</label>
            <input id="macro-calories" type="number" min="0" x-model.number="calories" class="form-control w-100" placeholder="e.g. 2200" />
        </div>
        <div class="row g-2">
            <div class="col">
                <label for="macro-protein" class="form-label">Protein %</label>
                <input id="macro-protein" type="number" min="0" max="100" x-model.number="proteinPercent" class="form-control" />
            </div>
            <div class="col">
                <label for="macro-carbs" class="form-label">Carbs %</label>
                <input id="macro-carbs" type="number" min="0" max="100" x-model.number="carbPercent" class="form-control" />
            </div>
            <div class="col">
                <label for="macro-fats" class="form-label">Fats %</label>
                <input id="macro-fats" type="number" min="0" max="100" x-model.number="fatPercent" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="error">
            <div class="alert alert-warning mt-2" x-text="error"></div>
        </template>
        <template x-if="result">
            <div class="alert alert-success mt-2">
                <div>Protein: <strong x-text="result.protein + ' g'"></strong></div>
                <div>Carbs: <strong x-text="result.carbs + ' g'"></strong></div>
                <div>Fats: <strong x-text="result.fats + ' g'"></strong></div>
            </div>
        </template>
    </div>
</div>

