<?php
// Body Fat Calculator Template (U.S. Navy Method)
?>
<div class="card mb-4 calculator body-fat-calculator">
    <div class="card-body" x-data="{
        gender: 'male',
        waist: '',
        neck: '',
        hip: '',
        height: '',
        bodyFat: null,
        category: '',
        calculate() {
            if (!this.waist || !this.neck || !this.height) {
                this.bodyFat = null;
                this.category = '';
                return;
            }
            const waist = Number(this.waist);
            const neck = Number(this.neck);
            const height = Number(this.height);
            if (this.gender === 'female' && !this.hip) {
                this.bodyFat = null;
                this.category = '';
                return;
            }
            const hip = Number(this.hip || 0);
            let bodyFat;
            if (this.gender === 'male') {
                bodyFat = 495 / (1.0324 - 0.19077 * Math.log10(waist - neck) + 0.15456 * Math.log10(height)) - 450;
            } else {
                bodyFat = 495 / (1.29579 - 0.35004 * Math.log10(waist + hip - neck) + 0.221 * Math.log10(height)) - 450;
            }
            this.bodyFat = bodyFat.toFixed(1);
            if (bodyFat < 6) this.category = 'Essential fat';
            else if (bodyFat < 14) this.category = 'Athlete';
            else if (bodyFat < 18) this.category = 'Fitness';
            else if (bodyFat < 25) this.category = 'Average';
            else this.category = 'Above average';
        }
    }">
        <h4 class="card-title mb-3">Body Fat Calculator</h4>
        <div class="row g-2">
            <div class="col-md-3">
                <label for="body-fat-gender" class="form-label">Gender</label>
                <select id="body-fat-gender" class="form-select" x-model="gender">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="col-md-3">
                <label for="body-fat-waist" class="form-label">Waist (cm)</label>
                <input id="body-fat-waist" type="number" min="0" x-model.number="waist" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="body-fat-neck" class="form-label">Neck (cm)</label>
                <input id="body-fat-neck" type="number" min="0" x-model.number="neck" class="form-control" />
            </div>
            <div class="col-md-3">
                <label for="body-fat-height" class="form-label">Height (cm)</label>
                <input id="body-fat-height" type="number" min="0" x-model.number="height" class="form-control" />
            </div>
        </div>
        <div class="row g-2 mt-2" x-show="gender === 'female'">
            <div class="col-md-3">
                <label for="body-fat-hip" class="form-label">Hip (cm)</label>
                <input id="body-fat-hip" type="number" min="0" x-model.number="hip" class="form-control" />
            </div>
        </div>
        <button class="btn btn-primary w-100 mt-3" @click="calculate">Calculate</button>
        <template x-if="bodyFat">
            <div class="alert alert-success mt-2">
                Body Fat: <strong x-text="bodyFat + '%'"></strong>
                <div class="small" x-text="category"></div>
            </div>
        </template>
        <div class="small text-muted mt-2">
            Based on the U.S. Navy circumference method. Measurements should be snug but not compressed.
        </div>
    </div>
</div>