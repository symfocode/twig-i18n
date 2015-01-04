Twig-i18n LinkI18nExtension
===========================
## Use

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

app/Resources/views/base.html.twig
```twig
<ul class="nav">
    <li {{- active_link('home', 'home-icon') }}>
        <a href="{{ path('home') }}">Home</a>
    </li>
    <li {{- active_link('about') }}>
        <a href="{{ path('about') }}">About</a>
    </li>
    <li {{- active_link('contacts') }}>
        <a href="{{ path('contacts') }}">Contacts</a>
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

## Result

http://example.com/fr/about/
```html
<ul class="nav">
    <li class="home-icon">
        <a href="/fr/">Home</a>
    </li>
    <li class="active">
        <a href="/fr/about/">About</a>
    </li>
    <li>
        <a href="/fr/contacts/">Contacts</a>
    </li>
</ul>
<ul class="lang">
    <li class="gb-flag-icon">
        <a href="/en/about/" title="English">
            En
        </a>
    </li>
    <li class="de-flag-icon">
        <a href="/de/about/" title="Deutsch">
            De
        </a>
    </li>
    <li class="fr-flag-icon active">
        <a href="/fr/about/" title="Français">
            Fr
        </a>
    </li>
</ul>
```
