<?php
// Period Calculator Template
?>
<div class="card mb-4 calculator period-calculator">
    <h4 class="card-title mb-3">Period Calculator</h4>
    <div x-data="{
        lastPeriod: '',
        cycleLength: 28,
        nextPeriod: '',
        calculate() {
            if (this.lastPeriod) {
                const last = new Date(this.lastPeriod);
                last.setDate(last.getDate() + parseInt(this.cycleLength));
                this.nextPeriod = last.toISOString().split('T')[0];
            } else {
                this.nextPeriod = '';
            }
        }
    }">
        <form @submit.prevent="calculate">
            <div class="mb-2">
                <label>Last Period Date:</label>
                <input type="date" x-model="lastPeriod" class="form-control" required>
            </div>
            <div class="mb-2">
                <label>Average Cycle Length (days):</label>
                <input type="number" x-model="cycleLength" class="form-control" min="21" max="35" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate Next Period</button>
        </form>
        <template x-if="nextPeriod">
            <div class="alert alert-success mt-3">
                <strong>Next Period Date:</strong> <span x-text="nextPeriod"></span>
            </div>
        </template>
    </div>
</div>
