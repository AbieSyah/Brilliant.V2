# Brilliant.V2 - Camp Room Management System

A management system for monitoring room availability and usage in Brilliant camps with company profile promotion.

## Features
- Company Profile Promotion for Brilliant and Bieplus
- Room availability dashboard monitoring
- Room management for Brilliant
- Status monitoring (available, occupied, full)


## Tech Stack

- Laravel 12
- PHP 8.1+
- MySQL/MariaDB
- Filament v3.3
- TailwindCSS
- LiveWire

## Requirements

- PHP >= 8.2
- Composer
- Node.js & NPM
- MySQL/MariaDB
- Git

## Documentation for advanced development
- Filament https://filamentphp.com/docs/3.x/panels/getting-started
- Livewire https://laravel-livewire.com/docs/2.x/quickstart
- Bootstrap https://getbootstrap.com/docs/5.3/getting-started/introduction
- TailwindCSS https://tailwindcss.com/docs/installation/using-vite

## Installation Steps

1. Clone repository
```bash
git clone https://github.com/AbieSyah/Brilliant.V2.git
cd Brilliant.V2
```

2. Install PHP dependencies
```bash
composer install
```

3. Install NPM packages in terminal/windows powershell or command prompt
```bash
npm install
```

4. Setup environment file
```bash
php artisan key:generate
```

5. Configure database 


6. Run migrations 
```bash
php artisan migrate
```

7. Build assets for development
```bash
npm run dev
```

8. Build assets for production
```bash
npm run build
```

9. Start local development server
```bash
php artisan serve
```

10. Access the application
- Main URL
- Admin Dashboard: /admin

## Development Commands

- Run tests
```bash
php artisan test
```

- Clear all caches
```bash
php artisan optimize:clear
```

- Create new migration
```bash
php artisan make:migration create_table_name
```
