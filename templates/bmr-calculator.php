<?php // BMR Calculator Template (Mifflin-St Jeor Equation) ?>
<div class="card mb-4 calculator bmr-calculator">
    <div class="card-body" x-data="{ weight: '', height: '', age: '', gender: 'male', bmr: null }">
        <h4 class="card-title mb-3">BMR Calculator</h4>
        <p class="text-muted small">Uses the Mifflin-St Jeor equation.</p>
        <div class="mb-2">
            <label>Gender:</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="bmr-male"   name="bmr-gender" value="male"   x-model="gender">
                    <label class="form-check-label" for="bmr-male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="bmr-female" name="bmr-gender" value="female" x-model="gender">
                    <label class="form-check-label" for="bmr-female">Female</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="bmr-weight">Weight (kg):</label>
            <input id="bmr-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="bmr-height">Height (cm):</label>
            <input id="bmr-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="bmr-age">Age (years):</label>
            <input id="bmr-age" type="number" x-model="age" class="form-control w-100" />
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && height && age) {
                let w = parseFloat(weight), h = parseFloat(height), a = parseInt(age);
                bmr = gender === 'male'
                    ? (10 * w + 6.25 * h - 5 * a + 5).toFixed(1)
                    : (10 * w + 6.25 * h - 5 * a - 161).toFixed(1);
            }
        ">Calculate</button>
        <template x-if="bmr">
            <div class="alert alert-success mt-2">
                BMR: <strong x-text="bmr + ' kcal/day'"></strong>
                <div class="text-muted small mt-1">This is the number of calories your body needs at complete rest.</div>
            </div>
        </template>
    </div>
</div>
