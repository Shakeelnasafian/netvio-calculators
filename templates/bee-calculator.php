<?php
// BEE Calculator Template (Harris-Benedict BMR)
?>
<div class="card mb-4 calculator bee-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        age: '',
        gender: 'male',
        bee: null,
        calculate() {
            if (!this.weight || !this.height || !this.age) {
                this.bee = null;
                return;
            }
            const weight = Number(this.weight);
            const height = Number(this.height);
            const age = Number(this.age);
            let result;
            if (this.gender === 'male') {
                result = 66.47 + (13.75 * weight) + (5.003 * height) - (6.755 * age);
            } else {
                result = 655.1 + (9.563 * weight) + (1.850 * height) - (4.676 * age);
            }
            this.bee = result.toFixed(0);
        }
    }">
        <h4 class="card-title mb-3">BEE Calculator</h4>
        <div class="row g-2">
            <div class="col-md-3">
                <label for="bee-weight" class="form-label">Weight (kg)</label>
                <input id="bee-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bee-height" class="form-label">Height (cm)</label>
                <input id="bee-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bee-age" class="form-label">Age (years)</label>
                <input id="bee-age" type="number" min="0" x-model.number="age" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bee-gender" class="form-label">Gender</label>
                <select id="bee-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bee">
            <div class="alert alert-success mt-2">
                Basal Energy Expenditure: <strong x-text="bee + ' kcal/day'"></strong>
            </div>
        </template>
        <div class="small text-muted mt-2">
            BEE represents calories burned at complete rest using the classic Harris-Benedict equation.
        </div>
    </div>
</div>

