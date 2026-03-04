<?php // Ovulation Calculator Template ?>
<div class="card mb-4 calculator ovulation-calculator">
    <div class="card-body" x-data="{
        lastPeriod: '',
        cycleLength: '28',
        lutealPhase: '14',
        ovulationDate: null,
        fertileStart: null,
        fertileEnd: null,
        nextPeriod: null
    }">
        <h4 class="card-title mb-3">Ovulation Calculator</h4>
        <p class="text-muted small">Estimate your fertile window based on your cycle.</p>
        <div class="mb-2">
            <label for="ov-last">First day of last period:</label>
            <input id="ov-last" type="date" x-model="lastPeriod" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="ov-cycle">Average cycle length (days):</label>
            <input id="ov-cycle" type="number" x-model="cycleLength" min="21" max="45" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="ov-luteal">Luteal phase length (days):</label>
            <input id="ov-luteal" type="number" x-model="lutealPhase" min="10" max="16" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (lastPeriod && cycleLength && lutealPhase) {
                let lp   = new Date(lastPeriod);
                let cycle = parseInt(cycleLength), luteal = parseInt(lutealPhase);
                let ovDay = cycle - luteal;

                let ov    = new Date(lp); ov.setDate(lp.getDate() + ovDay);
                let fs    = new Date(lp); fs.setDate(lp.getDate() + ovDay - 5);
                let fe    = new Date(lp); fe.setDate(lp.getDate() + ovDay + 1);
                let np    = new Date(lp); np.setDate(lp.getDate() + cycle);

                let fmt = d => d.toLocaleDateString(undefined, { year:'numeric', month:'short', day:'numeric' });
                ovulationDate = fmt(ov);
                fertileStart  = fmt(fs);
                fertileEnd    = fmt(fe);
                nextPeriod    = fmt(np);
            }
        ">Calculate</button>
        <template x-if="ovulationDate">
            <div class="alert alert-success mt-2">
                <div>Estimated Ovulation: <strong x-text="ovulationDate"></strong></div>
                <div>Fertile Window: <strong x-text="fertileStart + ' – ' + fertileEnd"></strong></div>
                <div>Next Period Expected: <strong x-text="nextPeriod"></strong></div>
                <div class="text-muted small mt-1">These are estimates based on average cycle patterns.</div>
            </div>
        </template>
    </div>
</div>
