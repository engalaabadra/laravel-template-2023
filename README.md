# Talninah Project
# Laravel10

## How to use:

  - clone the repo.
  - composer install
  - php artisan generate:key
  - php artisan optimize:clear
  - php artisan passport:install
  - php artisan storage:link
  - php artisan migrate:refresh --seed
    OR
  - php artisan migrate:refresh
  - php artisan db:seed

# Technologies And Packages that were used:
## Authentication:
### Login And Register
    
    by using packages  sanctum and passport:

    these packages installed default in laravel 9 and 10 , but i will select passport , because  its contain many features more than sanctum 

    which is support OAuth , Apis token , but will need to keep the token in storage counter to sanctum (keep this token in auth in laravel default)

    but will use passport Because there are advantages in it more comprehensive than sanctum

    https://stoffel.io/blog/laravel-passport-vs-sanctum

    send into email or phone no.:
    by using  MAIL_HOST : smtp.gmail.com to send into email
    And Vonage to send into phone no.
    https://dashboard.nexmo.com/getting-started/sms

### Laratust : for roles, psermissions:

    - composer require "santigarcor/laratrust:3.2.*"
    - in config/app.php in providers array:
        Laratrust\LaratrustServiceProvider::class,
    - in config/app.php in aliases  array:
        'Laratrust'   => Laratrust\LaratrustFacade::class,
    - php artisan vendor:publish --tag="laratrust"
    - app/Http/Kernel.php in array : routeMiddleware 
    'role' => \Laratrust\Middleware\LaratrustRole::class,
    'permission' => \Laratrust\Middleware\LaratrustPermission::class,
    'ability' => \Laratrust\Middleware\LaratrustAbility::class,
    - in file laratrust_seeder.php will define permissions and roles
    'roles_structure' => [
        'superadmin' => [
         
        ],

        'permissions_map' => [

        ]
# 
## HMVC:
    - composer require nwidart/laravel-modules

    - php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider"

    
    or To publish only the config: 
 
    - php artisan vendor:publish --provider="Nwidart\Modules\LaravelModulesServiceProvider" --tag="config"

    - in composer.json in autoloading using psr-4 :
      "Modules\\": "Modules/"

    - composer dump-autoload

    - php artisan module:make Auth 


## Names Modules in this project:
    - Auth :
        for management Users,Roles,Permissions
    - Geocodes :
        for management Countries,Cities,States,Areas,Addresses
    - Activites
        for management Activities in website

## Scopes (Local And Global) Traits And helpers :
    - Scopes:
        ActiveScope : for make active when status =1 in whole project
        LanguageScope 
    - Traits: 
        AuthTrait
        EloquentTrait
        GeneralAttributesTrait
        PrivateAttributesTrait
        ProccessSendingCodes
    for functions that use general in website
    
## Programmer:

- Eng-Alaa Badra (Laravel Developer).

