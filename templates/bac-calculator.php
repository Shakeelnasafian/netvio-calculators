<?php
// Blood Alcohol Concentration Calculator Template
?>
<div class="card mb-4 calculator bac-calculator">
    <div class="card-body" x-data="{
        drinks: '',
        hours: '',
        weight: '',
        gender: 'male',
        result: null,
        status: '',
        calculate() {
            if (!this.drinks || !this.weight) {
                this.result = null;
                this.status = '';
                return;
            }
            const drinks = Number(this.drinks);
            const hours = Number(this.hours || 0);
            const weightLb = Number(this.weight) * 2.20462;
            if (weightLb <= 0) {
                this.result = null;
                this.status = '';
                return;
            }
            const r = this.gender === 'female' ? 0.66 : 0.73;
            let bac = ((drinks * 14 * 5.14) / (weightLb * r)) - 0.015 * hours;
            if (bac < 0) bac = 0;
            this.result = bac.toFixed(3);
            if (bac >= 0.08) this.status = 'At or above common legal limit (0.08). Do not drive.';
            else if (bac > 0) this.status = 'Alcohol detected; reaction time is impaired.';
            else this.status = 'No measurable BAC.';
        }
    }">
        <h4 class="card-title mb-3">Blood Alcohol Concentration Calculator</h4>
        <div class="row g-2">
            <div class="col-md-4">
                <label for="bac-drinks" class="form-label">Standard Drinks</label>
                <input id="bac-drinks" type="number" min="0" x-model.number="drinks" class="form-control" placeholder="e.g. 3" />
            </div>
            <div class="col-md-4">
                <label for="bac-hours" class="form-label">Hours Since First Drink</label>
                <input id="bac-hours" type="number" min="0" x-model.number="hours" class="form-control" placeholder="e.g. 2" />
            </div>
            <div class="col-md-4">
                <label for="bac-weight" class="form-label">Body Weight (kg)</label>
                <input id="bac-weight" type="number" min="0" x-model.number="weight" class="form-control" placeholder="e.g. 80" />
            </div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-md-6">
                <label for="bac-gender" class="form-label">Gender</label>
                <select id="bac-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="result">
            <div class="alert alert-warning mt-2">
                Estimated BAC: <strong x-text="result"></strong>
                <div class="small" x-text="status"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            For education only—BAC varies significantly by individual. Never drink and drive.
        </div>
    </div>
</div>