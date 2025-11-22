<?php
// Pregnancy Calculator Template
?>
<div class="card mb-4 calculator pregnancy-calculator">
    <div class="card-body">
        <h4 class="card-title mb-3">Pregnancy Calculator</h4>
        <div x-data="{
        lastPeriod: '',
        weeksPregnant: '',
        calculate() {
            if (this.lastPeriod) {
                const last = new Date(this.lastPeriod);
                const today = new Date();
                const diff = Math.floor((today - last) / (1000 * 60 * 60 * 24));
                this.weeksPregnant = Math.floor(diff / 7);
            } else {
                this.weeksPregnant = '';
            }
        }
    }">
            <form @submit.prevent="calculate">
                <div class="mb-2">
                    <label>Last Period Date:</label>
                    <input type="date" x-model="lastPeriod" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Calculate Weeks Pregnant</button>
            </form>
            <template x-if="weeksPregnant !== ''">
                <div class="alert alert-success mt-3">
                    <strong>Weeks Pregnant:</strong> <span x-text="weeksPregnant"></span>
                </div>
            </template>
        </div>
    </div>
</div>