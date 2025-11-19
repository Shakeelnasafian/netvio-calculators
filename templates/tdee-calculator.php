<?php
// TDEE Calculator Template
?>
<div class="card mb-4 calculator tdee-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        age: '',
        gender: 'male',
        activity: 'moderate',
        result: null,
        factors: {
            sedentary: 1.2,
            light: 1.375,
            moderate: 1.55,
            active: 1.725,
            athlete: 1.9
        },
        calculate() {
            if (!this.weight || !this.height || !this.age) {
                this.result = null;
                return;
            }
            const weight = Number(this.weight);
            const height = Number(this.height);
            const age = Number(this.age);
            const genderAdj = this.gender === 'male' ? 5 : -161;
            const bmr = 10 * weight + 6.25 * height - 5 * age + genderAdj;
            const activityFactor = this.factors[this.activity] || 1.55;
            this.result = (bmr * activityFactor).toFixed(0);
        }
    }">
        <h4 class="card-title mb-3">TDEE Calculator</h4>
        <div class="row g-2">
            <div class="col-md-4">
                <label for="tdee-weight" class="form-label">Weight (kg)</label>
                <input id="tdee-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="tdee-height" class="form-label">Height (cm)</label>
                <input id="tdee-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="tdee-age" class="form-label">Age</label>
                <input id="tdee-age" type="number" min="0" x-model.number="age" class="form-control" />
            </div>
        </div>
        <div class="row g-2 mt-2">
            <div class="col-md-6">
                <label for="tdee-gender" class="form-label">Gender</label>
                <select id="tdee-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="tdee-activity" class="form-label">Activity Level</label>
                <select id="tdee-activity" class="form-select" x-model="activity">
                    <option value="sedentary">Sedentary (little or no exercise)</option>
                    <option value="light">Light (1-3 days/week)</option>
                    <option value="moderate">Moderate (3-5 days/week)</option>
                    <option value="active">Very Active (6-7 days/week)</option>
                    <option value="athlete">Athlete / Physical Job</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">
                Estimated TDEE: <strong x-text="result + ' kcal/day'"></strong>
            </div>
        </template>
    </div>
</div>

