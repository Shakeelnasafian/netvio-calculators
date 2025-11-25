<?php
// Pace Calculator Template
?>
<div class="card mb-4 calculator pace-calculator">
    <div class="card-body" x-data="{ distance: '', time: '', pace: null }">
        <h4 class="card-title mb-3">Pace Calculator</h4>
        <div class="mb-2">
            <label for="pace-distance">Distance (km):</label>
            <input id="pace-distance" type="number" x-model="distance" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="pace-time">Time (minutes):</label>
            <input id="pace-time" type="number" x-model="time" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (distance && time) {
                let paceVal = (time / distance).toFixed(2);
                pace = paceVal;
            }
        ">Calculate</button>
        <template x-if="pace">
            <div class="alert alert-success mt-2">Pace: <strong x-text="pace"></strong> min/km</div>
        </template>
    </div>
</div>