<?php
// Conception Calculator Template
?>
<div class="card mb-4 calculator conception-calculator">
    <h4 class="card-title mb-3">Conception Calculator</h4>
    <div x-data="{
        lastPeriod: '',
        cycleLength: 28,
        conceptionDate: '',
        calculate() {
            if (this.lastPeriod) {
                const last = new Date(this.lastPeriod);
                last.setDate(last.getDate() + parseInt(this.cycleLength / 2));
                this.conceptionDate = last.toISOString().split('T')[0];
            } else {
                this.conceptionDate = '';
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
            <button type="submit" class="btn btn-primary">Calculate Conception Date</button>
        </form>
        <template x-if="conceptionDate">
            <div class="alert alert-success mt-3">
                <strong>Estimated Conception Date:</strong> <span x-text="conceptionDate"></span>
            </div>
        </template>
    </div>
</div>
