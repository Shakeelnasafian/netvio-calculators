<?php
// Due Date Calculator Template
?>
<div class="card mb-4 calculator due-date-calculator">
    <h4 class="card-title mb-3">Due Date Calculator</h4>
    <div x-data="{
        lastPeriod: '',
        dueDate: '',
        calculate() {
            if (this.lastPeriod) {
                const last = new Date(this.lastPeriod);
                last.setDate(last.getDate() + 280); // 40 weeks
                this.dueDate = last.toISOString().split('T')[0];
            } else {
                this.dueDate = '';
            }
        }
    }">
        <form @submit.prevent="calculate">
            <div class="mb-2">
                <label>Last Period Date:</label>
                <input type="date" x-model="lastPeriod" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Calculate Due Date</button>
        </form>
        <template x-if="dueDate">
            <div class="alert alert-success mt-3">
                <strong>Estimated Due Date:</strong> <span x-text="dueDate"></span>
            </div>
        </template>
    </div>
</div>