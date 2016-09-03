# Thanks For All The Fish Framework

Create an env.json file on root project directory with the following content:

```sh
{
    "dbhost": "db",
    "dbuser": "root",
    "dbpassword": "phpapptest",
    "dbname": "",
    "debug": "true",
    "emailhost": "",
    "emailport": "",
    "emailusername": "",
    "emailpassword": "",
    "smtpauth": "true",
    "smtpsecure": "tls",
    "rootPath": "/var/www/site",
    "publicPath": "/var/www/site/public"
}
```

# Documentation

## Modules

### Controllers

### URLs (routing)

### Templates

### Static files

## Environment config file

## Global variables

## String definitions

## Tests

### Template engine

Before run the webserver, you need to download the template engine [Smarty](smarty.net).
Download the files to `core/vendors` directory!

Then give the directory 777 permissions: `chmod 777 -R core/vendors/smarty`.
And the right permission to user/group: `chown 48:48 -R core/vendors/smarty/templates_c`/. (48:48 if you are using Docker)


## Running

### Using container Docker

Site on port 80.

```sh
# docker-composer build
# docker-composer up web
```

## Testing

### Using container Docker

Just run: `# ./runTests.sh`

Or 

`# docker run -v $(pwd):/var/www/mysite --rm phpunit/phpunit /var/www/mysite/tests`