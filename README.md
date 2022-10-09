
# Application Build Instructions

### Install Dependencies
```bash
  composer install
  npm install
```

### Create .env file
```bash
  cp .env.example .env
```

### Generate application key
```bash
  php artisan key:generate
```

### Database config
- Create an empty database for the application
- In the .env file, add database information (DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD) to allow Laravel to connect to the database

### Migrate and seed the database
```bash
  php artisan migrate --seed
```

### Start develop server
```bash
  php artisan serve --port=80
```

### Use the application
- Open your browser and go to the url https://localhost
- Login with the accounts below:
```bash
Role: Administrator
Username: admin@tma.com
Password: 123
----------------------------------------
Role: Staff
Username: staff-1@tma.com
Password: 123
----------------------------------------
Role: Manager
Username: manager@tma.com
Password: 123
----------------------------------------
Role: Director
Username: director@tma.com
Password: 123
```
