<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Web Para Guardar Gastos

## Pasos para duplicar el proyecto

# Instalamos el proyecto, se generará la carpeta vendor
composer install

# Copiamos el .env.example para crear el archivo .env
cp .env.example .env

# Generamos la llave del proyecto
php artisan key:generate

# Generamos el acceso directo para los archivos
php artisan storage:link

# Corremos los migrations para generar la BD, la BD debe estar creada previamente
php artisan migrate:fresh --seed

# Generamos la llave JWT
php artisan jwt:secret

## Despues de ejecutar los migrate
# Ejecutar los siguientes comandos en la base de datos
Para que los registros log se puedan leer mejor
``` sql
CREATE EXTENSION pg_trgm;
CREATE INDEX idx_sender_serial_sender_request ON sender_request USING gin(sender_serial gin_trgm_ops);
CREATE INDEX idx_sr_content_request_sender_request ON sender_request USING gin(sr_content_request gin_trgm_ops);
```

### Cambios a base de datos para modificacion manual de estaciones
```sql
update block set block_latitude = -12.1153296, block_longitude = -75.1446031, block_name='Sapallanga', block_status=1 where block_serial = 'WF13-ES22-01';
update block set block_latitude = -11.7297663, block_longitude = -75.5617055, block_name='Acolla', block_status=1 where block_serial = 'WF13-ES22-02';
update block set block_latitude = -11.9338623, block_longitude = -75.3241246, block_name='San Jeronimo', block_status=1 where block_serial = 'WF13-ES22-03';
update block set block_latitude = -7.903649, block_longitude = -78.5732907, block_name='Otuzco', block_status=1 where block_serial = 'WF13-ES22-04';
update block set block_latitude = -8.509633, block_longitude = -78.677058, block_name='Nuevo Chao', block_status=1 where block_serial = 'WF13-ES22-05';
update block set block_latitude = -11.1576442, block_longitude = -76.0101559, block_name='Junin', block_status=1 where block_serial = 'WF13-ES22-06';
update block set block_latitude = -7.337541, block_longitude = -79.562318, block_name='Jequetepeque', block_status=1 where block_serial = 'WF13-ES22-07';
update block set block_latitude = -8.0472785, block_longitude = -78.4969069, block_name='Julcan', block_status=1 where block_serial = 'WF13-ES22-08';
update block set block_latitude = -6.103832, block_longitude = -76.921433, block_name='Jepelacio', block_status=1 where block_serial = 'WF13-ES22-09';
update block set block_latitude = -6.581547, block_longitude = -76.317388, block_name='Juan Guerra', block_status=1 where block_serial = 'WF13-ES22-10';
update block set block_latitude = -11.8424922, block_longitude = -76.3807669, block_name='Matucana', block_status=1 where block_serial = 'WF13-ES22-11';
update block set block_latitude = -7.006310, block_longitude = -76.438682, block_name='San Cristobal de Sisa', block_status=1 where block_serial = 'WF13-ES22-12';
update block set block_latitude = -11.923552, block_longitude = -76.662477, block_name='Ricardo Palma', block_status=1 where block_serial = 'WF13-ES22-13';
update block set block_latitude = -10.6633523, block_longitude = -76.7726212, block_name='Oyón', block_status=1 where block_serial = 'WF13-ES22-15';


update block set block_status=0 where block_serial = 'WF13-ES22-11';
update block set block_status=0 where block_serial = 'WF13-ES22-13';
update block set block_status=0 where block_serial = 'WF13-ES22-14';
update block set block_status=0 where block_serial = 'WF13-ES22-15';
update block set block_status=0 where block_serial = 'WF13-ES22-16';
update block set block_status=0 where block_serial = 'WF13-ES22-17';
```


php artisan db:seed --class=PSISSeeder
php artisan db:seed --class=PSIS_TIPOSeeder
php artisan db:seed --class=MeasurementUnitSeeder
php artisan db:seed --class=ParameterSeeder
php artisan db:seed --class=SensorModelSeeder
php artisan db:seed --class=WF14ES22_Seeder

update block set block_status=0 where block_serial = 'WF14-ES22-01';
update block set block_latitude = -5.394428333, block_longitude = -80.61093333, block_name='Nueva Zona More', block_status=1 where block_serial = 'WF14-ES22-02';
update block set block_latitude = -4.327823, block_longitude = -80.182614, block_name='Playas Norte', block_status=1 where block_serial = 'WF14-ES22-03';
update block set block_latitude = -7.688506, block_longitude = -79.320166, block_name='Nueva Arenita', block_status=1 where block_serial = 'WF14-ES22-04';
update block set block_latitude = -8.693365, block_longitude = -74.62685, block_name='San Antonio de Honoria', block_status=0 where block_serial = 'WF14-ES22-05';
update block set block_latitude = -7.3067533, block_longitude = -76.6495366, block_name='Costarica', block_status=0 where block_serial = 'WF14-ES22-06';


## Correccion de nombre de tabla user por user_table

select * from public.user
DROP TABLE public.user;

php artisan migrate:refresh --path=/database/migrations/2014_10_12_000000_create_usuario_table.php
php artisan db:seed --class=UsuariosIniciales

update slot set parameter_id = 14 where parameter_id = 4;
update slot set parameter_id = 15 where parameter_id = 5;
update slot set parameter_id = 4 where parameter_id = 2;
update slot set parameter_id = 9 where parameter_id = 6 and block_id <= 21;


update sensor set sensor_codename='pH' where sm_id = 1;
update sensor set sensor_codename='Temperatura' where sm_id = 2;
update sensor set sensor_codename='Cloro Residual' where sm_id = 3;
update sensor set sensor_codename='Corriente Alterna' where sm_id = 4;
update sensor set sensor_codename='Corriente Continua' where sm_id = 5;
update sensor set sensor_codename='Caudal' where sm_id = 6;
update sensor set sensor_codename='pH' where sm_id = 7;
update sensor set sensor_codename='Temperatura' where sm_id = 8;
update sensor set sensor_codename='Cloro Residual' where sm_id = 9;
update sensor set sensor_codename='Turbidez' where sm_id = 10;
update sensor set sensor_codename='Caudal' where sm_id = 11;
update sensor set sensor_codename='Velocidad del agua' where sm_id = 12;

## Modificaciones para integracion DATASS

php artisan db:seed --class=WebhookSeeder