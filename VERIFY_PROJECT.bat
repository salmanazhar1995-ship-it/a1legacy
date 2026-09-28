@echo off
setlocal
cd /d "%~dp0"
echo ========================================
echo A1Legacy project verification
echo ========================================
php -l app\Http\Controllers\PublicMediaController.php || goto :fail
php -l app\Support\MediaStorage.php || goto :fail
php -l app\Rules\SafeImageUpload.php || goto :fail
php -l app\Http\Requests\StoreSectionItemRequest.php || goto :fail
php -l app\Http\Requests\UpdateSectionItemRequest.php || goto :fail
php -l app\Http\Requests\UpdateSiteSettingsRequest.php || goto :fail
php -l routes\web.php || goto :fail
if not exist "storage\app\public\neutron\YELxzwaOxsExrGvBT572FFZii2Q0370.png" goto :missing_image
echo.
echo SUCCESS: core image upload and media files are present.
echo You can now run: php artisan migrate

echo Then run: php artisan serve
pause
exit /b 0

:missing_image
echo ERROR: seeded image file is missing from storage\app\public\neutron
pause
exit /b 1
:fail
echo ERROR: verification failed. See the message above.
pause
exit /b 1
