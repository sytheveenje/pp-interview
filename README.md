# Calculator in Laravel and Vue

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
2. Run `composer install`
3. Run `npm install`
4. Run `npm run dev`
5. Run `php artisan serve`
6. Visit `http://localhost:8000`

## Thought Process
2024-12-24
- I will need some sort of class that takes in a string and parses it into smaller calculations, although this is not necessary for the MVP, it is for the stretch goal and I think it's easier to already account for it.
- I will need a class that can take in a calculation and return the result (addition, subtraction, multiplication, division, sqrt and power)
- I will need a controller that handles the api request
- I will need something that validates the input
- I will need a way to store the calculations
- I will need a vue component that can take in a calculation and display the result
- I will need a vue component that can display the history of calculations, with the ability to delete a single calculation or clear all calculations
- I will need a way to communicate between the vue components and the api
- I will need a way to display errors

2024-12-25
- The client wants complex calculations, I have to choose between writing a parser or finding a package
  - I've chosen for a package, because it's faster and more robust
  - I will add a service that takes in a string and returns the result
  - The service will use the package to parse the string
  - That way we can easily write our own parser if we want to
- 