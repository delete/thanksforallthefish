# Thanks For All The Fish Micro Web Framework

A micro web framework to help you to setup a new web project.

> Code like a dolphin. 

## One more, why?
I needed to learn PHP and I did not want to use frameworks, so, what is the best way to learn? Creating something from scratch! Thus a micro web framework was born.

> Working in progress. :]


## Installation

## Extra downloads

TFATF uses an template engine called [Smarty](http://www.smarty.net), and you can use the manager script to download
and install easily.

`$ ./manager.sh -i`

The script will give the Smarty directory 777 permissions and apache user/group.

`chmod 777 -R core/vendors/smarty`.
`chown apache:apache -R core/vendors/smarty/templates_c`/.


## Usage example

[On this repository](https://github.com/delete/thanksforallthefish-example) there is a full site example.


## Testing

### Using container Docker

Just run: `$ ./manager.sh -t`



# Documentation

## Modules

Modules are modular applications, that can be used as "plug and play" on differents projects, and they live on `modules/` directory.

Each module has it own `templates/` folder and controllers.

### URLs (routing)

Every request pass throw `index.php` file, and instantiated the Router class calling the right controller and the right method(page controller) to render the view.

To set a route, a global variable as an array must be define on `settings.php` file, following: `routeName => controllerName`.

Example:

```php
$GLOBALS["config"] = [
    ...
    "routes" => [
        "site" => "SiteController",
    ],
    ...
```

The URL will be avaiable as: `mysite.com/site`.

#### Setting a default controller and page controller

Example:

```php
$GLOBALS["config"] = [
    ...
    "routes" => [
        "site" => "SiteController",
    ],
    "defaults" => [
        "controller" => "SiteController",
        "method" => "index"
    ],
    ...
```

### Controllers

Controllers must extends from Controller abstract class and its constructor function must define a
`templateDir` variable as `$this->templateDir = dirname(__FILE__) . "/templates/"`.

Example:

```php
class SiteController extends Controller
{    
    public $view;
    public $templateDir;
    
    function __construct($view=null) {
        parent::__construct($view);

        $this->templateDir = dirname(__FILE__) . "/templates/";
    }
    // others methods
}
```

#### Setting an page controller

Page controllers are defined as a Controller method:

```php
class SiteController extends Controller
{    
    ...
    public function index()
    {
        ...
    }
    ...
}
```

To return an HTML file as a response, the `view->load()` method must be called.

`view->load()` method receive two params: the path to the HTML file(the **.html** extension it is not necessary) and context variables(optional).
The context variable will be available to access on template by the array key: `{$page}`.

Example:

```php
public function index()
{
    $context = ["page" => 'index'];
    $template = 'index';
    $this->view->load($this->templateDir . $template, $context);
}
```

The URL will be avaiable as: `mysite.com/site`, `mysite.com/site/index` or `mysite.com/index`.

### Templates (view)

The templates files should be inside the modules -> application directory, like: `modules/website/templates/`.

To separete PHP code and HTML, a template engine called [Smarty](http://www.smarty.net) is used. You can see more about Smarty on its own [documentation](http://www.smarty.net/docs/en/).

### Static files

All static files like images, stylesheets, JS,... Must be on `public/` directory, organized as your wish.

The file will be avaiable as: `mysite.com/style.css`, or `mysite.com/website/style.css`.

## Environment config file

Create an env.json file on `configs/env.json` project directory with the following content:

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

**ALERT:** This file **must** be added on `.gitignore` file!

## String definitions

Globals strings like `path` and `uri/url` are defined on `configs/define.php` file.

## Tests

All the tests must be created on `tests/` folder, following the same structure as the tested code.

Example: If the Api class on `modules/api/Api.php` is tested, the test should be created on `tests/modules/api/ApiTest.php` with a ApiTest class. 

**Attention**: The file must have the class name plus **Test.php** as the example above.

## Contributing

Want to contribute? [Follow these recommendations](https://github.com/delete/thanksforallthefish/blob/master/CONTRIBUTING.md).

## Meta

Fellipe Pinheiro – [@pinheirofellipe](https://twitter.com/pinheirofellipe) – pinheiro.llip[at]gmail[dot]com

Distributed under the MIT license. See [``LICENSE``](https://opensource.org/licenses/MIT) for more information.

[https://github.com/delete/thanksforallthefish](https://github.com/delete/thanksforallthefish)