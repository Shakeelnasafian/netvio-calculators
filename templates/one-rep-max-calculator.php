<?php
// One Rep Max Calculator Template
?>
<div class="card mb-4 calculator one-rep-max-calculator">
    <div class="card-body" x-data="{ weight: '', reps: '', result: null }">
        <h4 class="card-title mb-3">One Rep Max Calculator</h4>
        <div class="mb-2">
            <label for="orm-weight">Weight Lifted (kg):</label>
            <input id="orm-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="orm-reps">Repetitions:</label>
            <input id="orm-reps" type="number" x-model="reps" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && reps) {
                let orm = weight * (1 + reps / 30);
                result = orm.toFixed(1);
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">One Rep Max: <strong x-text="result"></strong> kg</div>
        </template>
    </div>
</div>