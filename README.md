# Surplus Backend Challange

## Developed and tested in
- Laravel 9.19
- MacOS Monterey 12.6.3 & Ubuntu 22.04.1 LTS
- PHP 8.1.2 Non Thread Safe
- Mysql server 8.0.32

## Setup
- `composer install`
- Environments to be filled:
    - DB_CONNECTION=mysql
    - DB_HOST=127.0.0.1
    - DB_PORT=3306
    - DB_DATABASE=DBNAME
    - DB_USERNAME=DBUSER
    - DB_PASSWORD=DBPASS
- `php artisan key:generate`
- `php artisan migrate:fresh --seed`
- `php artisan storage:link`

## API Docs
Postman documentation available in the file `Surplus.postman_collection.json` or below for cURL commands

<br>

## Category
---
#### Get all Category
```
curl --location --request GET '127.0.0.1:8000/api/category'
```
#### Get category by ID
- category_id - the id of the category

```
curl --location --request GET '127.0.0.1:8000/api/category/{category_id}'
```
#### Create Category
```
curl --location --request POST '127.0.0.1:8000/api/category' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "PT.SEGA FUN MEGA"
}'
```
#### Update Category
- category_id - the id of the category
```
curl --location --request PUT '127.0.0.1:8000/api/category/{category_id}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "PT.METALURGI"
}'
```
#### Delete Category
- category_id - the id of the category
```
curl --location --request DELETE '127.0.0.1:8000/api/category/{category_id}'
```
<br>

## Product
---
#### Get all product
```
curl --location --request GET '127.0.0.1:8000/api/product'
```
#### Get product by ID
- product_id - the id of the product
```
curl --location --request GET '127.0.0.1:8000/api/product/{product_id}'
```
#### Create product
- categories - array of category ids
```
curl --location --request POST '127.0.0.1:8000/api/product' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "Metal SIX 8542",
    "description": "Sample Text442",
    "categories":[1,2,3]
}'
```
#### Update product
- product_id - the id of the product
- categories - array of category ids
```
curl --location --request PUT '127.0.0.1:8000/api/product/{product_id}' \
--header 'Content-Type: application/json' \
--data-raw '{
    "name": "PT.VINESAUCE VINCENT VINNY",
    "description": "Sample Text",
    "categories":[5,10]
}'
```
#### Delete product
- product_id - the id of the product
```
curl --location --request DELETE '127.0.0.1:8000/api/product/{product_id}'
```


<br>

## Image
---
#### Get all image
- product_id - the id of the product
```
curl --location --request GET '127.0.0.1:8000/api/product/{product_id}/image'
```
#### Get image by ID
- product_id - the id of the product
- image_id - the id of the image
```
curl --location --request GET '127.0.0.1:8000/api/product/{product_id}/image/{image_id}'
```
#### Create image
- product_id - the id of the product
```
curl --location --request POST '127.0.0.1:8000/api/product/{product_id}/image' \
--form 'name="Lamp Band"' \
--form 'image=@"/home/asary/Downloads/ezgif-2-e8bbd13a28.png"'
```
#### Update image
- product_id - the id of the product
- image_id - the id of the image
```
curl --location --request POST '127.0.0.1:8000/api/product/{product_id}/image/{image_id}' \
--form 'name="SAMPLE TEXT"' \
--form 'image=@"/home/asary/Downloads/ezgif-2-712cadf30d.png"' \
--form '_method="PUT"'
```
#### Delete image
- product_id - the id of the product
- image_id - the id of the image
```
curl --location --request DELETE '127.0.0.1:8000/api/product/{product_id}/image/{image_id}'
```