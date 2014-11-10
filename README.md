Twig-i18n
=========
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/a23033e7-9aa9-433e-8601-13511362fc8c/mini.png)](https://insight.sensiolabs.com/projects/a23033e7-9aa9-433e-8601-13511362fc8c) [![Latest Stable Version](https://poser.pugx.org/symfocode/twig-i18n/v/stable.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![Latest Unstable Version](https://poser.pugx.org/symfocode/twig-i18n/v/unstable.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![Total Downloads](https://poser.pugx.org/symfocode/twig-i18n/downloads.svg)](https://packagist.org/packages/symfocode/twig-i18n) [![License](https://poser.pugx.org/symfocode/twig-i18n/license.svg)](https://packagist.org/packages/symfocode/twig-i18n)

Twig internationalization tools based on [Symfony2][1] components and [Twig][2].

Twig-i18n works with PHP 5.3.3 or later.

## Features

* The **LinkI18nExtension** makes it easy to create locale links.

## Installation

The recommended way to install Silex-i18n is [through
composer](http://getcomposer.org). Just create a `composer.json` file and
run the `php composer.phar install` command to install it:
```json
{
    "require": {
        "symfocode/twig-i18n": "0.1.*@dev"
    }
}
```

## Use

app/Resources/views/base.html.twig
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

app/config/config.yml
```yml
parameters:
    site_system_locales: 
        en: { abbr: "En", name: "English", flag: "gb-flag-icon" }
        de: { abbr: "De", name: "Deutsch", flag: "de-flag-icon" }
        fr: { abbr: "Fr", name: "Français", flag: "fr-flag-icon" }
twig:
    globals:
        system_locales: %site_system_locales%
services:
    symfocode.twig.link_i18n_extension:
        class: SymfoCode\Twig\I18n\Extension\LinkI18nExtension
        arguments: [@request_stack, "active"]
        tags:
            - { name: twig.extension }
```

## License

Twig-i18n is licensed under the MIT license.

[1]: http://symfony.com
[2]: http://twig.sensiolabs.org
