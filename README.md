## Installation

- 1. Clone the repository.
- 2. Install the dependencies and build the front-end assets: composer install && npm install && npm run craftable-prod
- 3. Create a copy of the .env.example file and rename it to .env: cp .env.example .env
- 4. Generate a new application key: php artisan key:generate
- 5. Set up your database connection in the .env file.
- 6. Run the database migrations and seeders:php artisan migrate:refresh --seed