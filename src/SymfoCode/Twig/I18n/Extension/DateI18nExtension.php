<?php

/**
 * Part of the symfocode/twig-i18n package.
 *
 * @package   symfocode/twig-i18n
 * @copyright 2014 Yuriy Davletshin
 * @license   http://opensource.org/licenses/mit-license/ The MIT License (MIT)
 */
namespace SymfoCode\Twig\I18n\Extension;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Translation\Translator;

/**
 * Makes it easy to create locale dates.
 *
 * @author Yuriy Davletshin <yuriy.davletshin@gmail.com>
 */
class DateI18nExtension extends \Twig_Extension
{
    /**
     * @var \Twig_Environment $twig Twig environment
     */
    protected $twig;

    /**
     * @var \Symfony\Component\HttpFoundation\RequestStack $requestStack Request stack
     */
    protected $requestStack;

    /**
     * @var \Symfony\Component\Translation\Translator $translator The translator
     */
    protected $translator;

    /**
     * @var array $localesConfig Locales configuration
     */
    protected $localesConfig;

    /**
     * Constructor.
     *
     * @param \Symfony\Component\HttpFoundation\RequestStack $requestStack  Request stack
     * @param \Symfony\Component\Translation\Translator      $translator    The translator
     * @param array                                          $localesConfig Locales configuration
     */
    public function __construct(RequestStack $requestStack, Translator $translator, array $localesConfig)
    {
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->localesConfig = $localesConfig;
    }

    /**
     * {@inheritdoc}
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->twig = $environment;
    }

    /**
     * {@inheritdoc}
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('locale_date', array($this, 'localeDate')),
            new \Twig_SimpleFilter('localedate', array($this, 'localeDate')),
        );
    }

    /**
     * Returns a string with class attribute.
     *
     * @param string $route   The route of the current link
     * @param string $classes Classes of the current element
     *
     * @return string The attribute of the element
     */
    public function localeDate($date, $formatType = null, $timezone = null)
    {
        $request = $this->requestStack->getCurrentRequest();
        $locale = $request->get('_locale');
        $localeFormats = $this->localesConfig[$locale];
        if (null === $formatType || !isset($localeFormats[$formatType])) {
            $result = twig_date_format_filter($this->twig, $date, null, $timezone);
        } else {
            $format = $localeFormats[$formatType];
            if (!preg_match('/[DlMF]/', $format)) {
                $result = twig_date_format_filter($this->twig, $date, $format, $timezone);
            } else {
                $pattern = '/[dDjlNSwzWFmMntLoYyaABgGhHisueIOPTZcrU]/';
                $result = '';
                for ($i = 0; $i < mb_strlen($format, 'UTF-8'); $i++) {
                    $symbol = mb_substr($format, $i, 1, 'UTF-8');
                    if (preg_match($pattern, $symbol)) {
                        $value = twig_date_format_filter($this->twig, $date, $symbol, $timezone);
                        if (preg_match('/[DlMF]/', $symbol)) {
                            $value = $this->translator->trans($value);
                        }
                    } else {
                        $value = $symbol;
                    }
                    $result .= $value;
                }
            }
        }

        return $result;
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'date_i18n';
    }
}
