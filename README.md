# Merging Laravel Applications Guide
This guide provides instructions for merging a Laravel application from GitHub into an existing Laravel application on a Debian Linux VM.

## Prerequisites
Debian Linux VM
Existing Laravel application
Git installed
Composer installed
Sufficient disk space for both applications

## Backup Procedure
Before beginning, create a backup of your existing application:
```bash
cp -r existing-app backup-app
```

## Step-by-Step Merge Process
1. Clone New Application
Clone the GitHub repository to a temporary location:
```bash
git clone https://para.cs.umd.edu/435-project/sel.git sel
```
2. Check for File Conflicts
Before copying files, check for potential conflicts:
```bash
# Check routes directory for conflicts
for file in sel/routes/*; do
    if [ -f "existing-app/routes/$(basename $file)" ]; then
        echo "Warning: $(basename $file) already exists in routes/"
    fi
done

# Repeat for other directories
for file in sel/app/*; do
    if [ -f "existing-app/app/$(basename $file)" ]; then
        echo "Warning: $(basename $file) already exists in app/"
    fi
done
```
3. Copy Application Files
Transfer files using the interactive flag to prevent accidental overwrites:
```bash
# Routes
cp -ri sel/routes/* existing-app/routes/

# Application files (Controllers, Models, etc.)
cp -ri sel/app/* existing-app/app/

# Database migrations
cp -ri sel/database/migrations/* existing-app/database/migrations/

# Views
cp -ri sel/resources/views/* existing-app/resources/views/

# Public assets
cp -ri sel/public/* existing-app/public/
```
For critical files like `web.php`, manual merging is recommended

```bash
# Create backup of existing web.php
cp existing-app/routes/web.php existing-app/routes/web.php.bak

# View differences
diff sel/routes/web.php existing-app/routes/web.php

# Open files for manual merge
nano existing-app/routes/web.php
```
4. Update Dependencies
Compare and merge composer.json files:
```bash
# View differences
diff sel/composer.json existing-app/composer.json

# Edit composer.json
nano existing-app/composer.json

# Validate the file
composer validate

# Install dependencies
composer install
```

5. Environment Setup
Set up the environment configuration:
```bash
# Create .env file
cp .env.example .env
php artisan key:generate
```

6. Database Migration
Execute migrations to update the database schema:
```bash
php artisan migrate
```

## Troubleshooting

### Composer Dependencies
```bash
# If composer.json validation fails
composer validate
composer update

# Version conflicts
# Check Laravel versions in both apps
cat composer.json | grep laravel/framework

# Option 1: Upgrade existing app
composer require laravel/framework:^[version]

# Option 2: Use existing app's composer.json
cp existing-app/composer.json sel/composer.json
composer update
```

### Database Setup
```bash
# Install MariaDB and PHP MySQL
apt-get update
apt-get install php-mysql mariadb-server

# Start MariaDB
systemctl start mariadb
systemctl enable mariadb

# Configure security
mysql_secure_installation

# Create database and user
mysql -u root
CREATE DATABASE laravel_db;
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'your_password';
GRANT ALL PRIVILEGES ON laravel_db.* TO 'laravel_user'@'localhost';
FLUSH PRIVILEGES;
```

### Environment Configuration
```bash
# Create .env file
cp .env.example .env
php artisan key:generate

# Configure database in .env
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=your_password
```

### Migration Issues
```bash
# If migration fails due to duplicate tables
# Option 1: Fresh migration (deletes existing data)
php artisan migrate:fresh

# Option 2: Delete duplicate migration
rm database/migrations/[duplicate_migration_file]
php artisan migrate

# Option 3: Run specific migrations
php artisan migrate --path=/database/migrations/specific_migration.php
```

## Potential Issues and Solutions
### File Conflicts

- Use cp -i flag for interactive copying
- Create backups of important files before modifying
- Manually merge critical files like routes and configs
- Use diff to compare files before merging

### Namespace Conflicts

- Check for duplicate namespace declarations
- Resolve conflicts by renaming classes or restructuring namespaces
- Update any references to modified namespaces

### Route Conflicts

- Review all route names and URLs in both applications
- Modify conflicting route names
- Update route group prefixes if needed

### Asset Conflicts

- Check for duplicate asset names in public directory
- Rename conflicting assets and update their references

### Post-Merge Verification

- Test all routes from both applications
- Verify database functionality
- Check for proper asset loading
- Test any integrated features

### Rollback Procedure
If issues occur, restore from backup:
```bash
rm -rf existing-app
cp -r backup-app existing-app
```
