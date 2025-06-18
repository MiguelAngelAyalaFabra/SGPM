<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

---

# SGPM

**SGPM** (*Sistema Gestor de Pagos de Matrículas*) es una aplicación web desarrollada en Laravel que permite gestionar alumnos, matrículas y pagos en clubes de refuerzo escolar y tareas dirigidas.

## Características

- Registro y gestión de alumnos y acudientes.
- Control de matrículas con planes, jornadas y descuentos.
- Gestión de pagos, abonos, moras y facturación.
- Reportes y estadísticas financieras.
- Notificaciones internas para pagos pendientes.

## Requisitos

- PHP >= 8.1
- Laravel >= 10
- MySQL
- Composer

## Instalación rápida

```bash
git clone https://github.com/MiguelAngelAyalaFabra/SGPM.git
cd SGPM
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
