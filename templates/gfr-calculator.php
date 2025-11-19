<?php
// GFR Calculator Template
?>
<div class="card mb-4 calculator gfr-calculator">
    <div class="card-body" x-data="{
        creatinine: '',
        age: '',
        gender: 'male',
        result: null,
        stage: '',
        calculate() {
            if (!this.creatinine || !this.age) {
                this.result = null;
                this.stage = '';
                return;
            }
            const scr = Number(this.creatinine);
            const age = Number(this.age);
            if (scr <= 0 || age <= 0) {
                this.result = null;
                this.stage = '';
                return;
            }
            let egfr = 175 * Math.pow(scr, -1.154) * Math.pow(age, -0.203);
            if (this.gender === 'female') {
                egfr *= 0.742;
            }
            if (egfr < 0) egfr = 0;
            this.result = egfr.toFixed(0);
            if (egfr >= 90) this.stage = 'Stage 1 (Normal kidney function)';
            else if (egfr >= 60) this.stage = 'Stage 2 (Mild loss)';
            else if (egfr >= 45) this.stage = 'Stage 3a (Mild to moderate loss)';
            else if (egfr >= 30) this.stage = 'Stage 3b (Moderate to severe loss)';
            else if (egfr >= 15) this.stage = 'Stage 4 (Severe loss)';
            else this.stage = 'Stage 5 (Kidney failure)';
        }
    }">
        <h4 class="card-title mb-3">GFR Calculator</h4>
        <div class="row g-2">
            <div class="col-md-4">
                <label for="gfr-creatinine" class="form-label">Serum Creatinine (mg/dL)</label>
                <input id="gfr-creatinine" type="number" min="0" step="0.01" x-model.number="creatinine" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="gfr-age" class="form-label">Age (years)</label>
                <input id="gfr-age" type="number" min="1" x-model.number="age" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="gfr-gender" class="form-label">Gender</label>
                <select id="gfr-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">
                eGFR: <strong x-text="result + ' mL/min/1.73m²'"></strong>
                <div class="small text-muted" x-text="stage"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Uses the MDRD equation. Always confirm results with a healthcare professional.
        </div>
    </div>
</div>

