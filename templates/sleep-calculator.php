<?php // Sleep Calculator Template ?>
<div class="card mb-4 calculator sleep-calculator">
    <div class="card-body" x-data="{
        mode: 'wakeup',
        wakeTime: '',
        bedTime: '',
        cycles: 6,
        results: [],
        calcError: false
    }">
        <h4 class="card-title mb-3">Sleep Calculator</h4>
        <p class="text-muted small">Each sleep cycle is ~90 minutes. 5–6 cycles is ideal.</p>

        <div class="mb-2">
            <label>Calculate by:</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sl-wakeup" value="wakeup" x-model="mode">
                    <label class="form-check-label" for="sl-wakeup">Wake-up time</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="sl-bedtime" value="bedtime" x-model="mode">
                    <label class="form-check-label" for="sl-bedtime">Bed time</label>
                </div>
            </div>
        </div>

        <template x-if="mode === 'wakeup'">
            <div class="mb-2">
                <label for="sl-wake">I need to wake up at:</label>
                <input id="sl-wake" type="time" x-model="wakeTime" class="form-control w-100" />
            </div>
        </template>

        <template x-if="mode === 'bedtime'">
            <div class="mb-2">
                <label for="sl-bed">I plan to go to bed at:</label>
                <input id="sl-bed" type="time" x-model="bedTime" class="form-control w-100" />
            </div>
        </template>

        <button class="btn btn-primary w-100" @click="
            results = []; calcError = false;
            let cycleMin = 90, fallAsleepMin = 15;
            if (mode === 'wakeup' && wakeTime) {
                let [h, m] = wakeTime.split(':').map(Number);
                let wakeTotal = h * 60 + m;
                for (let c = 6; c >= 4; c--) {
                    let bedTotal = wakeTotal - (c * cycleMin) - fallAsleepMin;
                    if (bedTotal < 0) bedTotal += 1440;
                    let bh = Math.floor(bedTotal / 60) % 24;
                    let bm = bedTotal % 60;
                    results.push({ time: ('0'+bh).slice(-2) + ':' + ('0'+bm).slice(-2), cycles: c });
                }
            } else if (mode === 'bedtime' && bedTime) {
                let [h, m] = bedTime.split(':').map(Number);
                let bedTotal = h * 60 + m + fallAsleepMin;
                for (let c = 4; c <= 6; c++) {
                    let wakeTotal = bedTotal + (c * cycleMin);
                    let wh = Math.floor(wakeTotal / 60) % 24;
                    let wm = wakeTotal % 60;
                    results.push({ time: ('0'+wh).slice(-2) + ':' + ('0'+wm).slice(-2), cycles: c });
                }
            } else { calcError = true; }
        ">Calculate</button>

        <template x-if="calcError">
            <div class="alert alert-warning mt-2">Please enter a valid time.</div>
        </template>

        <template x-if="results.length > 0">
            <div class="mt-2">
                <p class="fw-bold mb-1" x-text="mode === 'wakeup' ? 'Recommended bed times:' : 'Recommended wake-up times:'"></p>
                <template x-for="r in results" :key="r.time">
                    <div class="alert alert-success py-1 mb-1">
                        <strong x-text="r.time"></strong>
                        <span class="text-muted small" x-text="' (' + r.cycles + ' cycles, ' + (r.cycles * 1.5) + ' hrs)'"></span>
                    </div>
                </template>
            </div>
        </template>
    </div>
</div>
