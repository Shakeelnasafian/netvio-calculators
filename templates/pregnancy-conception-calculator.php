<?php
// Pregnancy Conception Calculator Template
?>
<div class="card mb-4 calculator pregnancy-conception-calculator">
    <h4 class="card-title mb-3">Pregnancy Conception Calculator</h4>
    <div x-data="{
        dueDate: '',
        conceptionDate: '',
        calculate() {
            if (this.dueDate) {
                const due = new Date(this.dueDate);
                due.setDate(due.getDate() - 266); // 38 weeks from conception
                this.conceptionDate = due.toISOString().split('T')[0];
            } else {
                this.conceptionDate = '';
            }
        }
    }">
        <form @submit.prevent="calculate">
            <div class="mb-2">
                <label>Due Date:</label>
                <input type="date" x-model="dueDate" class="form-control" required>
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
