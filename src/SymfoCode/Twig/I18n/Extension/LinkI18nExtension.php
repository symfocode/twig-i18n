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

/**
 * Makes it easy to create locale links.
 *
 * @author Yuriy Davletshin <yuriy.davletshin@gmail.com>
 */
class LinkI18nExtension extends \Twig_Extension
{
    /**
     * @var RequestStack $requestStack Request stack
     */
    protected $requestStack;

    /**
     * @var string $activeCssClass CSS class of active elements
     */
    protected $activeCssClass;

    /**
     * Constructor.
     *
     * @param RequestStack $requestStack   Request stack
     * @param string       $activeCssClass CSS class of active elements
     */
    public function __construct(RequestStack $requestStack, $activeCssClass = 'active')
    {
        $this->requestStack = $requestStack;
        $this->activeCssClass = $activeCssClass;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('active_link', array($this, 'activeLink'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('active_locale', array($this, 'activeLocale'), array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('active_route', array($this, 'activeRoute'), array('is_safe' => array('html'))),
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
    public function activeLink($route, $classes = '')
    {
        $attribute = '';
        $request = $this->requestStack->getCurrentRequest();
        if ($request->get('_route') === $route) {
            $classes .= ' ' . $this->activeCssClass;
        }
        if ($classes) {
            $attribute = ' class="' . ltrim($classes) . '"';
        }

        return $attribute;
    }

    /**
     * Returns a string with class attribute.
     *
     * @param string $locale  The locale of the current link
     * @param string $classes Classes of the current element
     *
     * @return string The attribute of the element
     */
    public function activeLocale($locale, $classes = '')
    {
        $attribute = '';
        $request = $this->requestStack->getCurrentRequest();
        if ($request->get('_locale') === $locale) {
            $classes .= ' ' . $this->activeCssClass;
        }
        if ($classes) {
            $attribute = ' class="' . ltrim($classes) . '"';
        }

        return $attribute;
    }

    /**
     * Returns the current route.
     *
     * @return string The current route
     */
    public function activeRoute()
    {
        $request = $this->requestStack->getCurrentRequest();

        return $request->get('_route');
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'link_i18n';
    }
}
