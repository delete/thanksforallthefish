# php-scaffolding-site.

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
    "rootPath": "/var/www/mysite",
    "publicPath": "/var/www/mysite/public"
}
```

## Testing

### Using container Docker

Just run: `# ./runTests.sh`

Or 

`# docker run -v $(pwd):/var/www/mysite --rm phpunit/phpunit /var/www/mysite/tests`