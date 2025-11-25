<?php
// Pregnancy Weight Gain Calculator Template
?>
<div class="card mb-4 calculator pregnancy-weight-gain-calculator">
    <h4 class="card-title mb-3">Pregnancy Weight Gain Calculator</h4>
    <div x-data="{
        prePregnancyWeight: '',
        height: '',
        bmi: '',
        recommendedGain: '',
        calculate() {
            if (this.prePregnancyWeight && this.height) {
                const weight = parseFloat(this.prePregnancyWeight);
                const heightM = parseFloat(this.height) / 100;
                this.bmi = (weight / (heightM * heightM)).toFixed(1);
                if (this.bmi < 18.5) {
                    this.recommendedGain = '28-40 lbs (13-18 kg)';
                } else if (this.bmi < 25) {
                    this.recommendedGain = '25-35 lbs (11-16 kg)';
                } else if (this.bmi < 30) {
                    this.recommendedGain = '15-25 lbs (7-11 kg)';
                } else {
                    this.recommendedGain = '11-20 lbs (5-9 kg)';
                }
            } else {
                this.bmi = '';
                this.recommendedGain = '';
            }
        }
    }">
        <form @submit.prevent="calculate">
            <div class="mb-2">
                <label>Pre-pregnancy Weight (kg):</label>
                <input type="number" x-model="prePregnancyWeight" class="form-control" min="30" max="200" required>
            </div>
            <div class="mb-2">
                <label>Height (cm):</label>
                <input type="number" x-model="height" class="form-control" min="120" max="220" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate Recommended Weight Gain</button>
        </form>
        <template x-if="bmi">
            <div class="alert alert-info mt-3">
                <strong>BMI:</strong> <span x-text="bmi"></span>
            </div>
        </template>
        <template x-if="recommendedGain">
            <div class="alert alert-success mt-3">
                <strong>Recommended Weight Gain:</strong> <span x-text="recommendedGain"></span>
            </div>
        </template>
    </div>
</div>