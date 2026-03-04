<?php // Age Calculator Template ?>
<div class="card mb-4 calculator age-calculator">
    <div class="card-body" x-data="{ dob: '', result: null, years: null, months: null, days: null }">
        <h4 class="card-title mb-3">Age Calculator</h4>
        <div class="mb-2">
            <label for="age-dob">Date of Birth:</label>
            <input id="age-dob" type="date" x-model="dob" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (dob) {
                let birth = new Date(dob);
                let today = new Date();
                if (birth > today) { result = null; return; }
                years  = today.getFullYear() - birth.getFullYear();
                months = today.getMonth() - birth.getMonth();
                days   = today.getDate()  - birth.getDate();
                if (days < 0)   { months--; let d = new Date(today.getFullYear(), today.getMonth(), 0); days += d.getDate(); }
                if (months < 0) { years--; months += 12; }
                result = true;
            }
        ">Calculate</button>
        <template x-if="result">
            <div class="alert alert-success mt-2">
                Age: <strong x-text="years + ' years, ' + months + ' months, ' + days + ' days'"></strong>
            </div>
        </template>
        <template x-if="dob && !result">
            <div class="alert alert-warning mt-2">Please enter a valid past date.</div>
        </template>
    </div>
</div>
