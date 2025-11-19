<?php
// Body Surface Area Calculator Template
?>
<div class="card mb-4 calculator body-surface-area-calculator">
    <div class="card-body" x-data="{
        weight: '',
        height: '',
        bsa: null,
        calculate() {
            if (!this.weight || !this.height) {
                this.bsa = null;
                return;
            }
            const weight = Number(this.weight);
            const height = Number(this.height);
            if (weight <= 0 || height <= 0) {
                this.bsa = null;
                return;
            }
            const value = 0.007184 * Math.pow(height, 0.725) * Math.pow(weight, 0.425);
            this.bsa = value.toFixed(2);
        }
    }">
        <h4 class="card-title mb-3">Body Surface Area (BSA) Calculator</h4>
        <div class="row g-2">
            <div class="col-md-6">
                <label for="bsa-weight" class="form-label">Weight (kg)</label>
                <input id="bsa-weight" type="number" min="0" x-model.number="weight" class="form-control" />
            </div>
            <div class="col-md-6">
                <label for="bsa-height" class="form-label">Height (cm)</label>
                <input id="bsa-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bsa">
            <div class="alert alert-success mt-2">
                Estimated BSA: <strong x-text="bsa + ' m²'"></strong>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Uses the Du Bois formula for clinical body surface area estimation.
        </div>
    </div>
</div>

