<?php
// BMI Calculator for Kids Template
?>
<div class="card mb-4 calculator bmi-kids-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        age: '',
        gender: 'girl',
        bmi: null,
        guidance: '',
        calculate() {
            if (!this.weight || !this.height) {
                this.bmi = null;
                this.guidance = '';
                return;
            }
            const h = Number(this.height) / 100;
            if (h <= 0) {
                this.bmi = null;
                this.guidance = '';
                return;
            }
            const bmi = Number(this.weight) / (h * h);
            this.bmi = bmi.toFixed(1);
            if (bmi < 14) this.guidance = 'Below average BMI. Review growth charts with a pediatrician.';
            else if (bmi < 18) this.guidance = 'Within common healthy range. Confirm with BMI-for-age percentiles.';
            else this.guidance = 'Above average BMI. Use growth charts and medical guidance for next steps.';
        }
    }">
        <h4 class="card-title mb-3">BMI Calculator for Kids</h4>
        <div class="row g-2">
            <div class="col-md-3">
                <label for="bmi-kids-weight" class="form-label">Weight (kg)</label>
                <input id="bmi-kids-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bmi-kids-height" class="form-label">Height (cm)</label>
                <input id="bmi-kids-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bmi-kids-age" class="form-label">Age (years)</label>
                <input id="bmi-kids-age" type="number" min="2" max="20" x-model.number="age" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="bmi-kids-gender" class="form-label">Sex</label>
                <select id="bmi-kids-gender" class="form-select" x-model="gender">
                    <option value="girl">Girl</option>
                    <option value="boy">Boy</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bmi">
            <div class="alert alert-info mt-2">
                BMI: <strong x-text="bmi"></strong>
                <div class="small" x-text="guidance"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Use CDC or WHO BMI-for-age percentile charts for official classification.
        </div>
    </div>
</div>