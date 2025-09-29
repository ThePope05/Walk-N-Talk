@echo off
SET PHP_HOME=C:\php
SET PATH=%PHP_HOME%;%PATH%
cd /d %~dp0
echo ======================================
echo   Laravel WalkTalk starten
echo   URL: http://127.0.0.1:8000
echo ======================================
php artisan serve
