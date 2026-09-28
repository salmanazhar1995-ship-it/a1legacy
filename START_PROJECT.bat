@echo off
setlocal
cd /d "%~dp0"

echo ==========================================
echo   A1Legacy - Start Project
echo ==========================================
echo Project: %CD%
echo.

where php >nul 2>nul
if errorlevel 1 (
  echo ERROR: PHP is not available in PATH.
  echo Use your MAMP PHP 8.3 executable or add PHP to PATH.
  pause
  exit /b 1
)

if not exist artisan (
  echo ERROR: artisan not found in this folder.
  pause
  exit /b 1
)

if exist public\hot del /q public\hot >nul 2>nul
if exist bootstrap\cache\config.php del /q bootstrap\cache\config.php >nul 2>nul
if exist bootstrap\cache\routes-v7.php del /q bootstrap\cache\routes-v7.php >nul 2>nul
if exist bootstrap\cache\routes.php del /q bootstrap\cache\routes.php >nul 2>nul

if not exist storage\app\public\neutron\YELxzwaOxsExrGvBT572FFZii2Q0370.png (
  echo ERROR: Default image files are missing from storage\app\public\neutron.
  pause
  exit /b 1
)

echo Starting Laravel at http://127.0.0.1:8000
echo Press Ctrl+C to stop.
echo.
php artisan serve --host=127.0.0.1 --port=8000
pause
