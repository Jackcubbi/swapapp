@echo off
echo ========================================
echo SwapApp Installation Script (Windows)
echo ========================================
echo.

REM Backend Setup
echo [Backend] Setting up Laravel...
cd backend

if not exist ".env" (
    echo Creating .env file...
    copy .env.example .env
)

echo Installing Composer dependencies...
call composer install

echo Generating application key...
call php artisan key:generate

echo Running migrations...
call php artisan migrate

echo Creating storage link...
call php artisan storage:link

echo [Backend] Setup complete!
echo.

REM Frontend Setup
cd ..\frontend
echo [Frontend] Setting up Vue...

echo Installing npm dependencies...
call npm install

echo [Frontend] Setup complete!
echo.

REM Final Instructions
cd ..
echo ========================================
echo Installation Complete!
echo ========================================
echo.
echo To start the application:
echo.
echo Terminal 1 (Backend):
echo   cd backend
echo   php artisan serve
echo.
echo Terminal 2 (Frontend):
echo   cd frontend
echo   npm run dev
echo.
echo Then open: http://localhost:5173
echo.
pause
