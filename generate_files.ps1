php artisan make:model Creator -m
php artisan make:model Post -m
php artisan make:resource CategoryResource
php artisan make:resource CreatorResource
php artisan make:resource PostResource
php artisan make:request StoreCategoryRequest
php artisan make:request UpdateCategoryRequest
php artisan make:request StoreCreatorRequest
php artisan make:request UpdateCreatorRequest
php artisan make:request StorePostRequest
php artisan make:request UpdatePostRequest
php artisan make:controller Api/Admin/CategoryController
php artisan make:controller Api/Admin/CreatorController
php artisan make:controller Api/Admin/PostController
php artisan make:controller Api/FrontendController
