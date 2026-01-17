#!/bin/bash

echo "SwapApp Installation Script"
echo "================================"
echo ""

# Backend Setup
echo "Setting up Backend (Laravel)..."
cd backend

if [ ! -f ".env" ]; then
    echo "Creating .env file..."
    cp .env.example .env
fi

echo "Installing Composer dependencies..."
composer install

echo "Generating application key..."
php artisan key:generate

echo "Running migrations..."
php artisan migrate

echo "Creating storage link..."
php artisan storage:link

echo "Backend setup complete!"
echo ""

# Frontend Setup
cd ../frontend
echo "Setting up Frontend (Vue)..."

echo "Installing npm dependencies..."
npm install

echo "Frontend setup complete!"
echo ""

# Final Instructions
cd ..
echo "Installation Complete!"
echo ""
echo "To start the application:"
echo ""
echo "Terminal 1 (Backend):"
echo "  cd backend && php artisan serve"
echo ""
echo "Terminal 2 (Frontend):"
echo "  cd frontend && npm run dev"
echo ""
echo "Then open: http://localhost:5173"
echo ""
