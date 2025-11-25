<?php
// Target Heart Rate Calculator Template
?>
<div class="card mb-4 calculator target-heart-rate-calculator">
    <div class="card-body" x-data="{ age: '', resting: '', min: null, max: null }">
        <h4 class="card-title mb-3">Target Heart Rate Calculator</h4>
        <div class="mb-2">
            <label for="thr-age">Age:</label>
            <input id="thr-age" type="number" x-model="age" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="thr-resting">Resting Heart Rate:</label>
            <input id="thr-resting" type="number" x-model="resting" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (age && resting) {
                let maxHR = 220 - age;
                min = Math.round((maxHR - resting) * 0.5 + resting);
                max = Math.round((maxHR - resting) * 0.85 + resting);
            }
        ">Calculate</button>
        <template x-if="min && max">
            <div class="alert alert-success mt-2">Target Heart Rate: <strong x-text="min + ' - ' + max"></strong> bpm</div>
        </template>
    </div>
</div>