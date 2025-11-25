<?php
// Body Type Calculator Template
?>
<div class="card mb-4 calculator body-type-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        bmi: null,
        type: '',
        calculate() {
            if (!this.weight || !this.height) {
                this.bmi = null;
                this.type = '';
                return;
            }
            const h = Number(this.height) / 100;
            if (h <= 0) {
                this.bmi = null;
                this.type = '';
                return;
            }
            const bmi = Number(this.weight) / (h * h);
            this.bmi = bmi.toFixed(1);
            if (bmi < 18.5) this.type = 'Ectomorph (naturally lean build)';
            else if (bmi < 25) this.type = 'Mesomorph (balanced / athletic build)';
            else this.type = 'Endomorph (easier fat storage)';
        }
    }">
        <h4 class="card-title mb-3">Body Type Calculator</h4>
        <div class="row g-2">
            <div class="col-md-6">
                <label for="body-type-weight" class="form-label">Weight (kg)</label>
                <input id="body-type-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-6">
                <label for="body-type-height" class="form-label">Height (cm)</label>
                <input id="body-type-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bmi">
            <div class="alert alert-success mt-2">
                BMI: <strong x-text="bmi"></strong>
                <div x-text="type"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Body type estimates are generalized; use actual measurements and training response for personalization.
        </div>
    </div>
</div>