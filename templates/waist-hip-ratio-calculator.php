<?php
// Waist to Hip Ratio Calculator Template
?>
<div class="card mb-4 calculator waist-hip-ratio-calculator">
    <div class="card-body" x-data="{
        waist: '',
        hip: '',
        gender: 'male',
        ratio: null,
        risk: '',
        calculate() {
            if (!this.waist || !this.hip) {
                this.ratio = null;
                this.risk = '';
                return;
            }
            const waist = Number(this.waist);
            const hip = Number(this.hip);
            if (waist <= 0 || hip <= 0) {
                this.ratio = null;
                this.risk = '';
                return;
            }
            const ratio = waist / hip;
            this.ratio = ratio.toFixed(2);
            if (this.gender === 'male') {
                if (ratio < 0.9) this.risk = 'Low health risk';
                else if (ratio <= 0.99) this.risk = 'Moderate risk';
                else this.risk = 'High risk';
            } else {
                if (ratio < 0.8) this.risk = 'Low health risk';
                else if (ratio <= 0.84) this.risk = 'Moderate risk';
                else this.risk = 'High risk';
            }
        }
    }">
        <h4 class="card-title mb-3">Waist to Hip Ratio Calculator</h4>
        <div class="row g-2">
            <div class="col-md-4">
                <label for="whr-gender" class="form-label">Gender</label>
                <select id="whr-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-md-4">
                <label for="whr-waist" class="form-label">Waist (cm)</label>
                <input id="whr-waist" type="number" min="0" x-model.number="waist" class="form-control" />
            </div>
            <div class="col-md-4">
                <label for="whr-hip" class="form-label">Hip (cm)</label>
                <input id="whr-hip" type="number" min="0" x-model.number="hip" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="ratio">
            <div class="alert alert-success mt-2">
                Waist-to-Hip Ratio: <strong x-text="ratio"></strong>
                <div class="small" x-text="risk"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Measurements should be in centimeters or inches, but keep units consistent for both values.
        </div>
    </div>
</div>

