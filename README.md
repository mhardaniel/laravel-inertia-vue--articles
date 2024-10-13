## Requirements

https://laravel.com/docs/10.x/installation#getting-started-on-windows

-   Docker Desktop
-   WSL

## Tech Stacks used

-   Laravel
-   Inertia JS (Vue JS)
-   CSS (Tailwind)
-   Database (SQlite)

## Running

1. open your terminal
2. git clone https://github.com/mhardaniel/laravel-inertia-vue--articles
3. cd laravel-inertia-vue--articles 
4. cp .env.example .env
5. php artisan key:generate
6. ./vendor/bin/sail up
7. sail npm install && npm run dev
7. php artisan migrate:fresh --seed
8. you can access the application in your web browser at: http://localhost:8002

## Logins
1. (editor) editor@app.com  password
2. (writer) writer@app.com  password

### Thank you, Regards

mhardaniel
