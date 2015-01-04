Twig-i18n
=========
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a23033e7-9aa9-433e-8601-13511362fc8c/mini.png)](https://insight.sensiolabs.com/projects/a23033e7-9aa9-433e-8601-13511362fc8c) [![Latest Stable Version](https://poser.pugx.org/symfocode/twig-i18n/v/stable.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![Latest Unstable Version](https://poser.pugx.org/symfocode/twig-i18n/v/unstable.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![Total Downloads](https://poser.pugx.org/symfocode/twig-i18n/downloads.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![License](https://poser.pugx.org/symfocode/twig-i18n/license.svg)](https://packagist.org/packages/symfocode/twig-i18n)

Internationalization tools based on [Symfony2][1] components and [Twig][2].

Twig-i18n works with PHP 5.3.3 or later.

## Features

* The **LinkI18nExtension** makes it easy to create locale links. [Learn more.](https://github.com/symfocode/twig-i18n/blob/master/doc/links.md "LinkI18nExtension")
```twig
<ul class="nav">
    <li {{- active_link('home') }}>
        <a href="{{ path('home') }}">Home</a>
    </li>
    <li {{- active_link('about') }}>
        <a href="{{ path('about') }}">Page</a>
    </li>
    <li {{- active_link('contacts', 'last-nav-item') }}>
        <a href="{{ path('contacts') }}">Some page (default locale)</a>
    </li>
</ul>
<ul class="lang">
    {% for locale, params in app.system_locales %}
    <li {{- active_locale(locale, params.flag) }}>
        <a href="{{ path(active_route(), {'_locale': locale}) }}" title="{{ params.name }}">
            {{ params.abbr }}
        </a>
    </li>
    {% endfor %}
</ul>
```

* The **DateI18nExtension** makes it easy to create custom date formats. [Learn more.](https://github.com/symfocode/twig-i18n/blob/master/doc/dates.md "DateI18nExtension")
```twig
<div>{{ datetime|localedate('date_time') }}</div>
<div>{{ datetime|localedate('short_date') }}</div>
<div>{{ datetime|localedate('medium_date') }}</div>

<div>{{ datetime|locale-date('long_date') }}</div>
<div>{{ datetime|locale-date('full_date') }}</div>
<div>{{ datetime|locale-date('some_format') }}</div>
```

## Installation

The recommended way to install Silex-i18n is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:
```json
{
    "require": {
        "symfocode/twig-i18n": "0.2.*@dev"
    }
}
```

## License

Twig-i18n is licensed under the MIT license.

[1]: http://symfony.com
[2]: http://twig.sensiolabs.org
