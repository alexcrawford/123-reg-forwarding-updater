# What? 

I had to update hundreds of domains on a 123-reg account to change the nameservers 
and forwarding URLs and doing it manually would have taken hours so I wrote this.

## Installation

Run `composer install`

Run `php artsan migrate`

Add your 123 Reg username, password, and optionally a default redirect URL to the env file.

```
123_REG_USERNAME=
123_REG_PASSWORD=
123_REG_TARGET_URL=
```

Import your list of domains and target redirect URLs to the `domains` table in the database.

## Running the script

`php artisan dusk`
