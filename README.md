# Ecommerce Backend

This repo contains the devnology fullstack developer test, laravel backend.

# Requirements

-   Docker
-   Composer

## How to run?

1. Clone the repo
2. Run the following commands from within the project
    1. `composer install`
    2. `./vendor/bin/sail up `
3. On a separate terminal you must run the migrations to update the database to match the app models
    1. Temporarily change the .env variable `DB_HOST` value to `localhost`before running the following command
    2. `php artisan migrate`
    3. After completed run: `php artisan sync:products` (Further explanation below)
    4. After finished switch back the .env variable `DB_HOST` value to `pgsql` so that the app can connect to the database and the its data

# Decision Making

I decided to paginate the all products route, because there are a lot of products, which would make the frontend slower to load them all at once.
For the filter i applied a solution that i quite like because it allows for the creation of new filter by just adding a new class for it under ProductSearch/Filters.
As for the controller there is a service for each of them on where i created the actual logic to save to database, and in the controllers those methods are invoked.
For the validation of the create purchase form i used a FormRequest because it allows for a organized way to manage the rules for the form, and also return all the errors simply.

## What is `php artisan sync:products`?

Since there was a need to obtain the products for the ecommerce to be presented in frontend i made the decision to create a command that can be made to run automatically on a desired periodicity or via the terminal by the user.
That command will call the endpoints for each provider and sync those products to the database,
The reason behind of this decision is due to the following reasons:

-   It allows for the results to be paginated on the backend server
-   Better consistency across JSON response and same structure for all products
-   Allows for better optimization
-   Eliminates the need to call multiple servers in the frontend
-   Cleaner code and easier to understand the backend server
-   Allows for a similar approach as what would be in a real world application

### Observations

The backend was made simple to match the needed requirements, as per the time and as it is a Demo i felt like there was no need for user account and authorization, but i'm aware that in a real world application that would be required.
And also for the same reasons no payment method integration will be included for the current version.

# Endpoint documentation

A postman collection is included in the root of the project to document the endpoints existing in the backend server (E-Commerce Devnology.postman_collection).

For it to work properly is important that the variable in the collection (base_url) to be configured with the correct host of the backend application.

For example: http://localhost/api
