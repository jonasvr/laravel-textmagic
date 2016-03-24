#Laravel Textmagic

This is a Laravel 5 wrapper for the [Textmagic SMS API v2 PHP](https://github.com/textmagic/textmagic-rest-php)

##What is Textmagic?

TextMagic SMS API is a platform for building your own messaging app using our messaging infrastructure. It allows you to send and receive SMS text messages, query information about inbound and outbound messages, manage contacts, create templates (i.e. message formats and static texts) and schedule recurrent SMS messages as well as process bulk SMS messages.

https://www.textmagic.com/docs/api/
https://rest.textmagic.com/api/v2/doc


###Basic Installation

Add the service provider to the providers array in ```config/app.php```:

```php
...
Onwwward\Textmagic\TextmagicServiceProvider::class,
...
```

You can optionally use the facade for shorter code.
Add the facade to the alias array in ```config/app.php```:
```php
...
'Textmagic' => Onwwward\Textmagic\Facade\Textmagic::class,
...
```

### Configuration

After [adding the API key](https://my.textmagic.com/online/api/rest-api/keys) to your account, you'll need to provide the username and token. In Laravel you can publish the configuration file with `artisan`.

```bash
$ php artisan vendor:publish --provider="Onwwward\Textmagic\TextmagicServiceProvide" --tag="config"
```

> **Where's the file?** Laravel 5 will publish the config file to `/config/textmagic.php`.


#### Required config values

You'll need to update the `username` and `token` values in the config file with [your username and token](https://my.textmagic.com/online/api/rest-api/keys).


###Code Example

```php
  $text = "This is a Textmagic test message";
  $numbers = ['01234567891', '01234567891', '01234567891'];
  
  Textmagic::trigger('messages','create', [
      'text' => $text,
        'phones' => $numbers
    ]);  
```
            
###Todo
- Add more detailed logging
- Add ability to attach callback if request fails
- Add unit tests


###License
This plugin is released under the permissive MIT license. Your contributions are always welcome.