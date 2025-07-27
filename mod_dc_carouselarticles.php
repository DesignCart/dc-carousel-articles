<?php
    /**
     * @package     Joomla.Site
     * @subpackage  mod_dc_carouselarticles
     *
     * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */
    defined('_JEXEC') or die;

    use Joomla\CMS\Helper\ModuleHelper;
    use Joomla\CMS\Factory;
    use Joomla\CMS\Uri\Uri;
    use Joomla\Component\Content\Site\Model\ArticlesModel;

    $lang = Factory::getApplication()->getLanguage();
    $lang->load('mod_dc_carouselarticles', __DIR__);

    $moduleId    = $module->id;
    $catids      = $params->get('catids', []);
    $heading     = $params->get('heading', '');
    $limit       = (int) $params->get('limit', 5);
    $visible     = (int) $params->get('visible', 3);
    $template    = $params->get('template', 'article');
    $description = $params->get('description', '');
    
    $bgColor                = $params->get('bg_color', '#efefef');
    $textColor              = $params->get('text_color', '#000000');
    $textFontSize           = $params->get('text_font_size', '14');

    $titleBgColor           = $params->get('title_bg_color', '#1ba6cb');
    $titleTextColor         = $params->get('title_text_color', '#ffffff');
    $titleFontSize          = $params->get('title_font_size', '18');

    $infoColor              = $params->get('info_color', '#888888');
    $infoFontSize           = $params->get('info_font_size', '12');

    $headingColor           = $params->get('heading_color', '#000000');
    $headingFontSize        = $params->get('heading_font_size', '36');

    $descriptionColor       = $params->get('description_color', '#000000');
    $descriptionFontSize    = $params->get('description_font_size', '18');

    $moreBgColor            = $params->get('more_bg_color', '#1ba6cb');
    $moreTextColor          = $params->get('more_text_color', '#ffffff');
    $moreFontSize           = $params->get('more_font_size', '14');
    $moreBgColorHover       = $params->get('more_bg_color_hover', '#20a08f');
    $moreTextColorHover     = $params->get('more_text_color_hover', '#ffffff');

    $prevBgColor            = $params->get('prev_bg_color', '#ffeb00');
    $prevTextColor          = $params->get('prev_text_color', '#000000');
    $nextBgColor            = $params->get('next_bg_color', '#20a08f');
    $nextTextColor          = $params->get('next_text_color', '#ffffff');

    $quoteTopColor          = $params->get('quote_top_color', '#262c38');
    $quoteBottomColor       = $params->get('quote_bottom_color', '#262c38');

    $showDate               = (bool) $params->get('show_date', 0);

    $moreText               = $params->get('more_text', '');

    $model = new ArticlesModel();
    $model->setState('list.start', 0);
    $model->setState('list.limit', $limit);
    $model->setState('filter.published', 1);

    if (!empty($catids)) {
        $model->setState('filter.category_id', $catids);
    }

    $items = $model->getItems();

    // Załaduj Owl Carousel z CDN
    $wa = Factory::getApplication()->getDocument()->getWebAssetManager();

    // CSS
    $wa->registerAndUseStyle('owl.carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css', [], ['defer' => false]);
    $wa->registerAndUseStyle('owl.theme.default', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css', [], ['defer' => false]);

    // JS (upewnij się, że jQuery jest załadowane wcześniej)
    $wa->registerAndUseScript('owl.carousel', 'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js', ['jquery'], ['defer' => true]);

    if($template == 'portfolio'){
        $wa->registerAndUseStyle('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css', [], ['defer' => false]);
        $wa->registerAndUseScript('glightbox', 'https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js', [], ['defer' => true]);
    }

    $doc = Factory::getApplication()->getDocument();
    $template = $params->get('template', 'article');
    $doc->addStyleSheet(Uri::base() . 'modules/mod_dc_carouselarticles/tmpl/css/' . $template . '.css');

    require ModuleHelper::getLayoutPath('mod_dc_carouselarticles', $params->get('layout', 'default'));
