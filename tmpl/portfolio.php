<?php 

    /**
     * @package     Joomla.Site
     * @subpackage  mod_dc_carouselarticles
     *
     * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */

    defined('_JEXEC') or die; 
    use Joomla\CMS\Layout\LayoutHelper;
    use Joomla\CMS\Uri\Uri;
    use Joomla\Component\Content\Site\Helper\RouteHelper;
	use Joomla\CMS\HTML\HTMLHelper;
	use Joomla\CMS\Language\Text;

    $imageTag = LayoutHelper::render('joomla.content.intro_image', $item);
    preg_match('/src=["\']([^"\']+)["\']/', $imageTag, $matches);
    $imageUrl = Uri::root() . $matches[1];

    $images = json_decode($item->images);
    $mainImage = '';

    if (!empty($images->image_fulltext)) {
        $mainImage = Uri::root() . ltrim($images->image_fulltext, '/');
    } elseif (!empty($images->image_intro)) {
        $mainImage = Uri::root() . ltrim($images->image_intro, '/');
    }

    $placeholder = Uri::base() . 'modules/mod_dc_carouselarticles/tmpl/img/blank.webp';

    $portfolio_styles = "
        $cssId .dc-ca-portfolio-header {
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            background: {$titleBgColor};
        }

        $cssId .dc-ca-portfolio-header {$articleHeadingTag}{
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            text-align:left;
            margin:0px;
        }

        $cssId .dc-ca-portfolio-description{
            color: {$textColor};
            font-size: {$textFontSize}px;
            text-align:left;
        }

        $cssId .dc-ca-portfolio-info{
            color: {$infoColor};
            font-size: {$infoFontSize}px;
            text-align:left;
        }

        $cssId .dc-ca-portfolio-more{
            text-align:left;
        }

        $cssId .dc-ca-portfolio-more a{
            color: {$moreTextColor};
            font-size: {$moreFontSize}px;
            background: {$moreBgColor};
        }

        $cssId .dc-ca-portfolio-more a:hover{
            color: {$moreTextColorHover};
            background: {$moreBgColorHover};
        }
    ";
?>

<style>
    <?php echo $portfolio_styles; ?>
</style>

<div class="dc-ca-portfolio">
	<div class="dc-ca-portfolio-inner h-100 p-3">

		<a href="<?php echo $mainImage; ?>" class="glightbox dc-ca-portfolio-link">
			<div class="dc-ca-portfolio-image-wrapper">

				<style>
					#dc-ca-thumb-<?php echo $item->id; ?> {
						background-image: url('<?php echo $imageUrl; ?>');
						background-size: cover;
						background-position: center;
					}
				</style>

				<img
					id="dc-ca-thumb-<?php echo $item->id; ?>"
					class="dc-ca-portfolio-thumb"
					src="<?php echo $placeholder; ?>"
					alt="<?php echo strip_tags($item->title); ?>"
					aria-label="<?php echo strip_tags($item->title); ?>"
				/>
			</div>
		</a>
        <a href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid); ?>" class="dc-ca-portfolio-link">
            <div class="dc-ca-portfolio-header">

                <?php if ($showDate) : ?>
                    <div class="dc-ca-portfolio-info">
                        <span class="dc-ca-date">
                            <i class="fa fa-calendar"></i>
                            <?php echo HTMLHelper::_('date', $item->publish_up ?: $item->created, Text::_('DATE_FORMAT_LC3')); ?>
                        </span>
                    </div>
                <?php endif; ?>

                <<?php echo $articleHeadingTag; ?> class="dc-ca-portfolio-title"><?php echo $item->title; ?></<?php echo $articleHeadingTag; ?>>
                <div class="dc-ca-portfolio-description">
                    <?php echo strip_tags($item->introtext); ?>
                </div>
            </div>
        </a>

        <?php if($moreText != ''): ?>
            <div class="dc-ca-portfolio-more">
                <a href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid); ?>"><?php echo $moreText; ?></a>
            </div>
        <?php endif; ?>
	</div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        GLightbox({ selector: ".glightbox" });
    });
</script>
