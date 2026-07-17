#!/bin/bash

# Wait for MySQL to be ready
echo "Waiting for MySQL to be ready..."
for i in $(seq 1 30); do
    if mysqladmin ping -h mysql -u root -p"${DB_PASSWORD:-root}" --silent &>/dev/null; then
        echo "MySQL is ready!"
        break
    fi
    echo "Still waiting for MySQL... ($i/30)"
    sleep 1
done

# Generate app key if not set
if [ -z "$(php artisan key:show 2>/dev/null)" ]; then
    echo "Generating application key..."
    php artisan key:generate --force
fi

# Run migrations
echo "Running migrations..."
php artisan migrate --force

# Run seeders
echo "Running seeders..."
php artisan db:seed --force

echo "Setup complete!"
