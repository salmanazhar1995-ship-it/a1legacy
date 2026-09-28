@echo off
setlocal
cd /d "%~dp0"
echo.
echo === A1Legacy image/media verification ===
echo.
php artisan optimize:clear
if errorlevel 1 goto :fail

echo.
echo [1/3] Checking media routes...
php artisan route:list --path=media
if errorlevel 1 goto :fail

echo.
echo [2/3] Checking legacy storage route...
php artisan route:list --path=storage
if errorlevel 1 goto :fail

echo.
echo [3/3] Checking media folder...
if not exist "storage\app\public\neutron" mkdir "storage\app\public\neutron"
dir /b "storage\app\public\neutron" 2>nul

echo.
echo Verification finished. Now run: php artisan serve
pause
exit /b 0

:fail
echo.
echo Verification failed. Read the error shown above.
pause
exit /b 1
