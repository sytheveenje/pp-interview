# Calculator in Laravel and Vue



https://github.com/user-attachments/assets/529d7228-3a05-41b5-9901-f7e564710a2b



## Goal
### Requirements
Build an API that supports four types of calculation operators:
- Addition
- Subtraction
- Division
- Multiplication
Every calculation should be stored for historical reference.

A calculator interface should be created (Vue.js) that allows the user enter their calculation and receive a response.
A "ticker tape" interface should be built that shows all previous calculations with the ability to delete an individual calculation or clear all previous calculations.

### Stretch Goal
To really impress the customers, your calculator should support more complex calculation chains and even additional calculation operators:
sqrt((((9*9)/12)+(13-4))*2)^2)

## Installation
1. Clone the repository
2. Copy the `.env.example` file to `.env`
3. Set the database credentials in the `.env` file
4. Make sure to have a sqlite database file in the `database` folder
  4.1 Run `touch database/database.sqlite`
  4.2 Run `touch database/testingdatabase.sqlite`'
  4.3 Run `php artisan migrate`
5. Run `composer install`
6. Run `npm install`
7. Run `npm run dev`
8. Run `php artisan serve`
9. Visit `http://localhost:8000`

## Testing

<img width="844" alt="Scherm­afbeelding 2024-12-28 om 16 09 18" src="https://github.com/user-attachments/assets/43735375-02b5-48b9-b832-e30e0ad999e5" />


- The User Model is not tested, as it is a default Laravel model. The rest has coverage.
- Run `php artisan db:seed --class=CalculationSeeder` to seed the database with some calculations.
- Run `php artisan test` to run the tests.
