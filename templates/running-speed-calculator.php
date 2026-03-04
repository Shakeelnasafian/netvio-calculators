<?php // Running Speed Calculator Template ?>
<div class="card mb-4 calculator running-speed-calculator">
    <div class="card-body" x-data="{
        mode: 'speed',
        distance: '', hours: '0', minutes: '', seconds: '',
        speed: '', pace_min: '', pace_sec: '',
        result: null, resultLabel: ''
    }">
        <h4 class="card-title mb-3">Running Speed Calculator</h4>

        <div class="mb-2">
            <label>Calculate:</label>
            <select x-model="mode" class="form-control w-100">
                <option value="speed">Speed (from distance + time)</option>
                <option value="time">Finish Time (from distance + pace)</option>
                <option value="distance">Distance (from time + pace)</option>
            </select>
        </div>

        <!-- Distance input (used for speed & time modes) -->
        <template x-if="mode !== 'distance'">
            <div class="mb-2">
                <label for="rs-dist">Distance (km):</label>
                <input id="rs-dist" type="number" x-model="distance" step="0.01" class="form-control w-100" />
            </div>
        </template>

        <!-- Time inputs (used for speed & distance modes) -->
        <template x-if="mode !== 'time'">
            <div class="mb-2">
                <label>Time (h / min / sec):</label>
                <div class="row g-1">
                    <div class="col-4"><input type="number" x-model="hours"   placeholder="h"  min="0" class="form-control" /></div>
                    <div class="col-4"><input type="number" x-model="minutes" placeholder="min" min="0" max="59" class="form-control" /></div>
                    <div class="col-4"><input type="number" x-model="seconds" placeholder="sec" min="0" max="59" class="form-control" /></div>
                </div>
            </div>
        </template>

        <!-- Pace inputs (used for time & distance modes) -->
        <template x-if="mode !== 'speed'">
            <div class="mb-2">
                <label>Pace (min : sec per km):</label>
                <div class="row g-1">
                    <div class="col-6"><input type="number" x-model="pace_min" placeholder="min" min="0" class="form-control" /></div>
                    <div class="col-6"><input type="number" x-model="pace_sec" placeholder="sec" min="0" max="59" class="form-control" /></div>
                </div>
            </div>
        </template>

        <button class="btn btn-primary w-100" @click="
            result = null;
            let totalSec = parseInt(hours||0)*3600 + parseInt(minutes||0)*60 + parseInt(seconds||0);
            let dist = parseFloat(distance||0);
            let paceTotal = parseInt(pace_min||0)*60 + parseInt(pace_sec||0);

            if (mode === 'speed' && dist > 0 && totalSec > 0) {
                let kmh = (dist / (totalSec / 3600)).toFixed(2);
                let paceS = Math.round(totalSec / dist);
                let pm = Math.floor(paceS/60), ps = paceS%60;
                result = kmh + ' km/h  |  Pace: ' + pm + ':' + ('0'+ps).slice(-2) + ' min/km';
                resultLabel = 'Speed';
            } else if (mode === 'time' && dist > 0 && paceTotal > 0) {
                let finishSec = Math.round(paceTotal * dist);
                let fh = Math.floor(finishSec/3600), fm = Math.floor((finishSec%3600)/60), fs = finishSec%60;
                result = ('0'+fh).slice(-2)+':'+('0'+fm).slice(-2)+':'+('0'+fs).slice(-2);
                resultLabel = 'Finish Time';
            } else if (mode === 'distance' && totalSec > 0 && paceTotal > 0) {
                result = (totalSec / paceTotal).toFixed(2) + ' km';
                resultLabel = 'Distance';
            }
        ">Calculate</button>

        <template x-if="result">
            <div class="alert alert-success mt-2">
                <span x-text="resultLabel + ': '"></span><strong x-text="result"></strong>
            </div>
        </template>
    </div>
</div>
