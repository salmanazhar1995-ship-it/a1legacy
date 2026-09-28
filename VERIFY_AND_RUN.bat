@echo off
setlocal
cd /d "%~dp0"

echo ==========================================
echo   A1Legacy - Verify and Run
echo ==========================================

where php >nul 2>nul
if errorlevel 1 goto :nophp
if not exist artisan goto :noartisan

php -l app\Http\Controllers\PublicMediaController.php || goto :fail
php -l app\Support\MediaStorage.php || goto :fail
php -l app\Rules\SafeImageUpload.php || goto :fail
php -l routes\web.php || goto :fail

if not exist storage\app\public\neutron\YELxzwaOxsExrGvBT572FFZii2Q0370.png goto :noimage

if exist public\hot del /q public\hot >nul 2>nul
if exist bootstrap\cache\config.php del /q bootstrap\cache\config.php >nul 2>nul
if exist bootstrap\cache\routes-v7.php del /q bootstrap\cache\routes-v7.php >nul 2>nul
if exist bootstrap\cache\routes.php del /q bootstrap\cache\routes.php >nul 2>nul

echo.
echo Basic verification passed.
echo Starting http://127.0.0.1:8000
echo.
php artisan serve --host=127.0.0.1 --port=8000
pause
exit /b %errorlevel%

:nophp
echo ERROR: PHP is not available in PATH.
pause
exit /b 1
:noartisan
echo ERROR: artisan not found.
pause
exit /b 1
:noimage
echo ERROR: seeded image files are missing.
pause
exit /b 1
:fail
echo ERROR: PHP syntax verification failed.
pause
exit /b 1
