<?php // Calorie Deficit Calculator Template ?>
<div class="card mb-4 calculator calorie-deficit-calculator">
    <div class="card-body" x-data="{
        weight: '', height: '', age: '', gender: 'male', activity: '1.55',
        goal: 'lose05', tdee: null, target: null, deficit: null, weeks: null
    }">
        <h4 class="card-title mb-3">Calorie Deficit Calculator</h4>

        <div class="mb-2">
            <label>Gender:</label>
            <div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="cd-male"   value="male"   x-model="gender">
                    <label class="form-check-label" for="cd-male">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="cd-female" value="female" x-model="gender">
                    <label class="form-check-label" for="cd-female">Female</label>
                </div>
            </div>
        </div>
        <div class="mb-2">
            <label for="cd-weight">Weight (kg):</label>
            <input id="cd-weight" type="number" x-model="weight" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="cd-height">Height (cm):</label>
            <input id="cd-height" type="number" x-model="height" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="cd-age">Age (years):</label>
            <input id="cd-age" type="number" x-model="age" class="form-control w-100" />
        </div>
        <div class="mb-2">
            <label for="cd-activity">Activity Level:</label>
            <select id="cd-activity" x-model="activity" class="form-control w-100">
                <option value="1.2">Sedentary (desk job, no exercise)</option>
                <option value="1.375">Lightly Active (1-3 days/week)</option>
                <option value="1.55" selected>Moderately Active (3-5 days/week)</option>
                <option value="1.725">Very Active (6-7 days/week)</option>
                <option value="1.9">Extremely Active (athlete / 2× day)</option>
            </select>
        </div>
        <div class="mb-2">
            <label for="cd-goal">Weight Loss Goal:</label>
            <select id="cd-goal" x-model="goal" class="form-control w-100">
                <option value="lose025">Lose 0.25 kg/week (mild deficit)</option>
                <option value="lose05"  selected>Lose 0.5 kg/week (recommended)</option>
                <option value="lose075">Lose 0.75 kg/week</option>
                <option value="lose1">Lose 1 kg/week (aggressive)</option>
            </select>
        </div>
        <button class="btn btn-primary w-100" @click="
            if (weight && height && age) {
                let w = parseFloat(weight), h = parseFloat(height), a = parseInt(age), act = parseFloat(activity);
                let bmr = gender === 'male' ? (10*w + 6.25*h - 5*a + 5) : (10*w + 6.25*h - 5*a - 161);
                tdee = Math.round(bmr * act);
                let deficits = { lose025: 275, lose05: 550, lose075: 825, lose1: 1100 };
                let lossPerWeek = { lose025: 0.25, lose05: 0.5, lose075: 0.75, lose1: 1 };
                deficit = deficits[goal];
                target  = tdee - deficit;
                weeks   = Math.round(w * 0.1 / lossPerWeek[goal]); // approx weeks to lose 10% body weight
            }
        ">Calculate</button>
        <template x-if="tdee">
            <div class="alert alert-success mt-2">
                <div>Maintenance Calories (TDEE): <strong x-text="tdee + ' kcal/day'"></strong></div>
                <div>Daily Calorie Target: <strong x-text="target + ' kcal/day'"></strong></div>
                <div>Daily Deficit: <strong x-text="deficit + ' kcal'"></strong></div>
                <div class="text-muted small mt-1">Est. <span x-text="weeks"></span> weeks to lose 10% body weight.</div>
            </div>
        </template>
    </div>
</div>
