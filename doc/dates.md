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

app/Resources/translations/messages.de.xlf
```xlf
<?xml version="1.0"?>
<xliff version="1.2" xmlns="urn:oasis:names:tc:xliff:document:1.2">
    <file source-language="en" datatype="plaintext" original="file.ext">
        <body>
            <trans-unit id="1">
                <source>January</source>
                <target>Januar</target>
            </trans-unit>
            <trans-unit id="2">
                <source>Jan</source>
                <target>Jan</target>
            </trans-unit>
            <trans-unit id="3">
                <source>February</source>
                <target>Februar</target>
            </trans-unit>
            <trans-unit id="4">
                <source>Feb</source>
                <target>Feb</target>
            </trans-unit>
            <trans-unit id="5">
                <source>March</source>
                <target>März</target>
            </trans-unit>
            <trans-unit id="6">
                <source>Mar</source>
                <target>Mär</target>
            </trans-unit>
            <trans-unit id="7">
                <source>April</source>
                <target>April</target>
            </trans-unit>
            <trans-unit id="8">
                <source>Apr</source>
                <target>Apr</target>
            </trans-unit>
            <trans-unit id="9">
                <source>May</source>
                <target>Mai</target>
            </trans-unit>
            <trans-unit id="10">
                <source>June</source>
                <target>Juni</target>
            </trans-unit>
            <trans-unit id="11">
                <source>Jun</source>
                <target>Jun</target>
            </trans-unit>
            <trans-unit id="12">
                <source>July</source>
                <target>Juli</target>
            </trans-unit>
            <trans-unit id="13">
                <source>Jul</source>
                <target>Jul</target>
            </trans-unit>
            <trans-unit id="14">
                <source>August</source>
                <target>August</target>
            </trans-unit>
            <trans-unit id="15">
                <source>Aug</source>
                <target>Aug</target>
            </trans-unit>
            <trans-unit id="16">
                <source>September</source>
                <target>September</target>
            </trans-unit>
            <trans-unit id="17">
                <source>Sep</source>
                <target>Sep</target>
            </trans-unit>
            <trans-unit id="18">
                <source>October</source>
                <target>Oktober</target>
            </trans-unit>
            <trans-unit id="19">
                <source>Oct</source>
                <target>Okt</target>
            </trans-unit>
            <trans-unit id="20">
                <source>November</source>
                <target>November</target>
            </trans-unit>
            <trans-unit id="21">
                <source>Nov</source>
                <target>Nov</target>
            </trans-unit>
            <trans-unit id="22">
                <source>December</source>
                <target>Dezember</target>
            </trans-unit>
            <trans-unit id="23">
                <source>Dec</source>
                <target>Dez</target>
            </trans-unit>
            <trans-unit id="24">
                <source>Sunday</source>
                <target>Sonntag</target>
            </trans-unit>
            <trans-unit id="25">
                <source>Sun</source>
                <target>So</target>
            </trans-unit>
            <trans-unit id="26">
                <source>Monday</source>
                <target>Montag</target>
            </trans-unit>
            <trans-unit id="27">
                <source>Mon</source>
                <target>Mo</target>
            </trans-unit>
            <trans-unit id="28">
                <source>Tuesday</source>
                <target>Dienstag</target>
            </trans-unit>
            <trans-unit id="29">
                <source>Tue</source>
                <target>Di</target>
            </trans-unit>
            <trans-unit id="30">
                <source>Wednesday</source>
                <target>Mittwoch</target>
            </trans-unit>
            <trans-unit id="31">
                <source>Wed</source>
                <target>Mi</target>
            </trans-unit>
            <trans-unit id="32">
                <source>Thursday</source>
                <target>Donnerstag</target>
            </trans-unit>
            <trans-unit id="33">
                <source>Thu</source>
                <target>Do</target>
            </trans-unit>
            <trans-unit id="34">
                <source>Friday</source>
                <target>Freitag</target>
            </trans-unit>
            <trans-unit id="35">
                <source>Fri</source>
                <target>Fr</target>
            </trans-unit>
            <trans-unit id="36">
                <source>Saturday</source>
                <target>Samstag</target>
            </trans-unit>
            <trans-unit id="37">
                <source>Sat</source>
                <target>Sa</target>
            </trans-unit>
        </body>
    </file>
</xliff>
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
