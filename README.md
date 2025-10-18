# WordPress Calculator (Alpine.js)

A lightweight and customizable calculator plugin for WordPress, built using [Alpine.js](https://alpinejs.dev/). This plugin allows you to easily embed interactive calculators on any post or page using a shortcode.

---

## Features



## Calculator Checklist

Below is a checklist of calculators, showing which are currently implemented and which are pending:

### Fitness
| Calculator Name                        | Status      |
|----------------------------------------|-------------|
| Ideal Weight Calculator                 | ✅ Implemented |
| Pace Calculator                         | ✅ Implemented |
| Army Body Fat Calculator                | ✅ Implemented |
| Lean Body Mass Calculator               | ✅ Implemented |
| Healthy Weight Calculator               | ✅ Implemented |
| Calories Burned Calculator              | ✅ Implemented |
| One Rep Max Calculator                  | ✅ Implemented |
| Target Heart Rate Calculator            | ✅ Implemented |

### Pregnancy
| Calculator Name                        | Status      |
|----------------------------------------|-------------|
| Pregnancy Calculator                    | ✅ Implemented |
| Pregnancy Weight Gain Calculator        | ✅ Implemented |
| Pregnancy Conception Calculator         | ✅ Implemented |
| Due Date Calculator                     | ✅ Implemented |
| Conception Calculator                   | ✅ Implemented |
| Period Calculator                       | ✅ Implemented |

### Other
| Calculator Name                        | Status      |
|----------------------------------------|-------------|
| Macro Calculator                        | ⬜ Pending      |
| Carbohydrate Calculator                 | ⬜ Pending      |
| Protein Calculator                      | ⬜ Pending      |
| Fat Intake Calculator                   | ⬜ Pending      |
| TDEE Calculator                         | ⬜ Pending      |
| GFR Calculator                          | ⬜ Pending      |
| Body Type Calculator                    | ⬜ Pending      |
| Body Surface Area Calculator            | ⬜ Pending      |
| Blood Alcohol Concentration (BAC) Calculator | ⬜ Pending |
| BMI Calculator – Body Mass Index         | ✅ Implemented |
| BMI Calculator for Kids                 | ⬜ Pending      |
| BMI Calculator for Men                  | ⬜ Pending      |
| BMI Calculator for Teens                | ⬜ Pending      |
| BMI Calculator for Women                | ⬜ Pending      |
| BMI Weight Loss Calculator              | ⬜ Pending      |
| Geriatric BMI Calculator                | ⬜ Pending      |

### Body measurements calculators 📏
| Calculator Name                        | Status      |
|----------------------------------------|-------------|
| ABSI Calculator                         | ⬜ Pending      |
| Adjusted Body Weight Calculator         | ⬜ Pending      |
| BAI Calculator - Body Adiposity Index   | ⬜ Pending      |
| Body Fat Calculator                     | ⬜ Pending      |
| Body Frame Size Calculator              | ⬜ Pending      |
| Body Shape Calculator                   | ⬜ Pending      |
| BRI Calculator — Body Roundness Index   | ⬜ Pending      |
| BSA Calculator – Body Surface Area      | ⬜ Pending      |
| Draw Length Calculator                  | ⬜ Pending      |
| Bedridden Patient Height Calculator     | ⬜ Pending      |
| Face Shape Calculator                   | ⬜ Pending      |
| FFMI Calculator (Fat-Free Mass Index)   | ⬜ Pending      |
| Ideal Weight Calculator                 | ✅ Implemented |
| Karvonen Formula Calculator             | ⬜ Pending      |
| Lean Body Mass Calculator               | ✅ Implemented |
| Overweight Calculator                   | ⬜ Pending      |
| Ponderal Index Calculator               | ⬜ Pending      |
| RFM Calculator (Relative Fat Mass)      | ⬜ Pending      |
| Skinfold Body Fat Calculator            | ⬜ Pending      |
| Waist to Hip Ratio Calculator           | ⬜ Pending      |
| Waist to Height Ratio Calculator        | ⬜ Pending      |
| Weight Loss Percentage Calculator       | ⬜ Pending      |

### Dietary calculators 🥗
| Calculator Name                        | Status      |
|----------------------------------------|-------------|
| Added Sugar Intake Calculator           | ⬜ Pending      |
| BEE Calculator                          | ⬜ Pending      |
| Harris-Benedict Calculator (Basal Metabolic Rate) | ⬜ Pending |
| Katch-McArdle Calculator                | ⬜ Pending      |
| BMR Calculator (Basal Metabolic Rate, Mifflin St Jeor Equation) | ⬜ Pending |
| Calorie Calculator                      | ⬜ Pending      |
| Calorie Deficit Calculator              | ⬜ Pending      |
| Carb Calculator (Carbohydrates)         | ⬜ Pending      |
| Diet Risk Score Calculator              | ⬜ Pending      |
| DRI Calculator                          | ⬜ Pending      |
| EER Calculator — Estimated Energy Requirement | ⬜ Pending |
| Fat Intake Calculator                   | ⬜ Pending      |
| Fiber Calculator                        | ⬜ Pending      |
| Gastric Sleeve Weight Loss Calculator   | ⬜ Pending      |
| IIFYM Calculator (If It Fits Your Macros) | ⬜ Pending    |
| Keto Calculator                         | ⬜ Pending      |
| Macro Calculator                        | ⬜ Pending      |
| Maintenance Calorie Calculator          | ⬜ Pending      |
| Meal Calorie Calculator                 | ⬜ Pending      |
| Micronutrient Calculator                | ⬜ Pending      |
| Net Carbs Calculator                    | ⬜ Pending      |
| Protein Calculator                      | ⬜ Pending      |
| Quarantine Activity Calculator          | ⬜ Pending      |
| RMR Calculator - Resting Metabolic Rate | ⬜ Pending      |
| Calorie Intake Calculator (Simple)      | ⬜ Pending      |
| Sodium in Salt Calculator               | ⬜ Pending      |
| TDEE Calculator - Total Daily Energy Expenditure | ⬜ Pending |
| Vitamin Calculator                      | ⬜ Pending      |
| Vitamin A Calculator                    | ⬜ Pending      |
| Vitamin D Calculator                    | ⬜ Pending      |
| Weight Gain Calculator                  | ⬜ Pending      |
| Weight Watchers Points Calculator       | ⬜ Pending      |

<!-- The checklist continues for all categories and calculators you provided. For brevity, only the first several categories are shown here. You can expand this further as needed. -->

<!-- Add more calculators and update status as you implement them -->
## Installation
1. **Download or Clone the Repository:**
   ```bash
   git clone https://github.com/Shakeelnasafian/calculator.git
   ```

2. **Upload to WordPress Plugins:**
   - Compress the folder into a `.zip`.
   - Upload via **WordPress Admin → Plugins → Add New → Upload Plugin**.

3. **Activate the Plugin:**
   - Go to **Plugins** in your WordPress dashboard.
   - Click **Activate** on "WordPress Calculator".

---

## Usage

1. After activating, insert the shortcode wherever you want the calculator to appear:
   ```
   [calculator]
   ```

2. The calculator will render on your page using Alpine.js.

---

## Requirements

- WordPress 5.0+
- PHP 7.4+
- No additional dependencies required (Alpine.js is included)

---

## Customization

- Edit the JavaScript in `/assets/js/` for custom logic.
- Modify the plugin template to change styles or structure.
- Extend with additional calculation logic as needed.

---

## Contributing

Contributions are welcome!
1. Fork the repo
2. Create a feature branch
3. Submit a pull request

---

## License

This project is licensed under the [MIT License](LICENSE).
