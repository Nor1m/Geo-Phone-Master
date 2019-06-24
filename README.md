# Nor1m-Geo-Phone-Master
![alt text](http://nor1m.ru/uploads/banner/11.png)
- Contributors: Vitaly Mironov
- Donate link: https://paypal.me/nor1m
- Tags: multi-city, geo, geo phone, geo data, geo master, geotargeting
- Requires at least: 4.0
- Tested up to: 4.1
- Stable tag: 4.9.8

## Description
The plugin is designed to allow the user to receive data depending on their geographical location. For example, display the phone on the site depending on the city, region, or city. Also has a multi function town, in order to allow the user to enter the desired subdomain site.

## Author
 
* Author: Vitaly Mironov
* Author Site: http://nor1m.ru
 
## Installation
 
1) Upload `nor1m-geo-phone-master` to the `/wp-content/plugins/` directory
2) Activate the plugin through the 'Plugins' menu in WordPress
3) Use

## Screenshots
 
1. An example implementation https://image.ibb.co/jRZJqe/Screenshot_2.png
2. Multi-city http://prntscr.com/kzmtsc
3. Geotargeting http://prntscr.com/kzmtyu
4. Settings http://prntscr.com/kzmu2o
5. Help http://prntscr.com/kzmu78
6. Theme http://prntscr.com/kzmudb
7. Import/Export http://prntscr.com/kzmuhs

## Demo
http://ngpm.syberia-shop.ru/test-geo-phone-master/

## Shortcodes

#### Геотаргетинг
```php
[NGP label='Ярлык']Значение по умолчанию[/NGP]
```
#### Геотаргетинг: вывод страны
```php
[NGP_MY_GEO country]
```
#### Геотаргетинг: вывод региона
```html
[NGP_MY_GEO region]
```
#### Геотаргетинг: вывод города
```php
[NGP_MY_GEO city]
```
#### Геотаргетинг: вывод IP
```php
[NGP_MY_GEO ip]
```
#### Геотаргетинг: вывод ISO кода страны
```php
[NGP_MY_GEO country_iso]
```
#### Геотаргетинг: вывод ISO кода региона
```html
[NGP_MY_GEO region_iso]
```
#### Геотаргетинг: вывод долготы страны
```php
[NGP_MY_GEO country_lon]
```
#### Геотаргетинг: вывод широты страны
```php
[NGP_MY_GEO country_lat]
```
#### Геотаргетинг: вывод долготы региона
```php
[NGP_MY_GEO region_lon]
```
#### Геотаргетинг: вывод широты региона
```php
[NGP_MY_GEO region_lat]
```
#### Виджет мультигород
```php
[NGSC def_city='Город по умолчанию' def_link='Ссылка по умолчанию']
```
#### Список разрешенных тегов и атрибутов для правил геотаргетинга
| Тег        | Атрибут           |
| ------------- |-------------|
| p        | (class, id)           | 
| a        | (href, class, id)           | 
| b        | (class, id)           | 
| i        | (class, id)           | 
| span        | (class, id)           | 
| strong        | (class, id)           | 
| br        |            | 


## Upgrade Notice
= 1.3 =
* New Design
* New Themes
* Added Import/Export
  
= 1.5 =
* Added English language. 
* Added new geotargeting commands. 
* Added a new theme for the widget.
## License
 
The COS Search provider plugin is copyright © 2018 with
[GNU General Public License][] by Vitaly Mironov. 
 
This program is free software; you can redistribute it
and/or modify it under the terms of the
[GNU General Public License][] as published by the Free
Software Foundation; either version 2 of the License, or
(at your option) any later version.
 
This program is distributed in the hope that it will be
useful, but WITHOUT ANY WARRANTY; without even the implied
warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
PURPOSE. See the GNU General Public License for more details.
 
[GNU General Public License]: http://www.gnu.org/copyleft/gpl.html
