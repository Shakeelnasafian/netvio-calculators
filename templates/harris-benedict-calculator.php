<?php
// Harris-Benedict Calculator Template
?>
<div class="card mb-4 calculator harris-benedict-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        age: '',
        gender: 'male',
        activity: 'moderate',
        bmr: null,
        calories: null,
        factors: {
            sedentary: 1.2,
            light: 1.375,
            moderate: 1.55,
            active: 1.725,
            very_active: 1.9
        },
        calculate() {
            if (!this.weight || !this.height || !this.age) {
                this.bmr = null;
                this.calories = null;
                return;
            }
            const weight = Number(this.weight);
            const height = Number(this.height);
            const age = Number(this.age);
            let bmr;
            if (this.gender === 'male') {
                bmr = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
            } else {
                bmr = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
            }
            const factor = this.factors[this.activity] || 1.55;
            this.bmr = bmr.toFixed(0);
            this.calories = (bmr * factor).toFixed(0);
        }
    }">
        <h4 class="card-title mb-3">Harris-Benedict Calculator</h4>
        <div class="row g-2">
            <div class="col-md-3">
                <label for="hb-weight" class="form-label">Weight (kg)</label>
                <input id="hb-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="hb-height" class="form-label">Height (cm)</label>
                <input id="hb-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="hb-age" class="form-label">Age (years)</label>
                <input id="hb-age" type="number" min="0" x-model.number="age" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="hb-gender" class="form-label">Gender</label>
                <select id="hb-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-md-6">
                <label for="hb-activity" class="form-label">Activity Level</label>
                <select id="hb-activity" class="form-select" x-model="activity">
                    <option value="sedentary">Sedentary (little or no exercise)</option>
                    <option value="light">Light (1-3 days/week)</option>
                    <option value="moderate">Moderate (3-5 days/week)</option>
                    <option value="active">Active (6-7 days/week)</option>
                    <option value="very_active">Very Active / Labor Job</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bmr">
            <div class="alert alert-success mt-2">
                <div>BMR: <strong x-text="bmr + ' kcal/day'"></strong></div>
                <div>Total Daily Energy Needs: <strong x-text="calories + ' kcal/day'"></strong></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Based on the original Harris-Benedict equations. Adjust with professional guidance as needed.
        </div>
    </div>
</div>