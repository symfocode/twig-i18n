Symfocode/Twig-i18n DateI18nExtension
=====================================
## Use

app/config/config.yml
```yml
parameters:
    site_system_locales: 
        en: 
            name: "English"
            date_time: 'd/m/Y H:i:s'
            short_date: 'd/m/y'
            medium_date: 'd-M-Y'
            long_date: 'j F Y'
            full_date: 'j F Y'
            some_format: 'D, j M Y'
        de: 
            name: "Deutsch"
            date_time: 'd.m.Y H:i:s'
            short_date: 'd.m.y'
            medium_date: 'd.m.Y'
            long_date: 'j. F Y'
            full_date: 'l, j. F Y'
            some_format: 'D, j M Y'
        fr: 
            name: "Français"
            date_time: 'd/m/Y H:i:s'
            short_date: 'd/m/y'
            medium_date: 'd M Y'
            long_date: 'j F Y'
            full_date: 'l j F Y'
            some_format: 'D, j M Y'
services:
    symfocode.twig.date_i18n_extension:
        class: SymfoCode\Twig\I18n\Extension\DateI18nExtension
        arguments: [@request_stack, @translator, %site_system_locales%]
        tags:
            - { name: twig.extension }
```

app/Resources/views/base.html.twig
```twig
<div class="date-time">{{ datetime|localedate('date_time') }}</div>
<div class="short-date">{{ datetime|localedate('short_date') }}</div>
<div class="medium-date">{{ datetime|localedate('medium_date') }}</div>

<div class="long-date">{{ datetime|locale_date('long_date') }}</div>
<div class="full-date">{{ datetime|locale_date('full_date') }}</div>
<div class="some-format">{{ datetime|locale_date('some_format') }}</div>
```

## Result

http://example.com/de/
```html
<div class="date-time">04.01.2015 02:04:12</div>
<div class="short-date">04.01.15</div>
<div class="medium-date">04.01.2015</div>

<div class="long-date">4. Januar 2015</div>
<div class="full-date">Sonntag, 4. Januar 2015</div>
<div class="some-format">So, 4. Jan 2015</div>
```
