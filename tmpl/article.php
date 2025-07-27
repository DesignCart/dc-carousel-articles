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
    use Joomla\CMS\HTML\HTMLHelper;
    use Joomla\CMS\Language\Text;
    use Joomla\Component\Content\Site\Helper\RouteHelper;

    $hex = ltrim($titleBgColor, '#');
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    $titleBgRgba = "rgba($r, $g, $b, 0.8)";

    $article_styles = "

        $cssId .dc-ca-article-header {
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            background: {$titleBgRgba};
        }

        $cssId .dc-ca-article-header {$articleHeadingTag}{
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            text-align:left;
            margin:0px;
        }

        $cssId .dc-ca-article-content{
            color: {$textColor};
            font-size: {$textFontSize}px;
            text-align:left;
        }

        $cssId .dc-ca-article-info{
            color: {$infoColor};
            font-size: {$infoFontSize}px;
            text-align:left;
        }

        $cssId .dc-ca-article-more{
            text-align:left;
        }

        $cssId .dc-ca-article-more a{
            color: {$moreTextColor};
            font-size: {$moreFontSize}px;
            background: {$moreBgColor};
        }

        $cssId .dc-ca-article-more a:hover{
            color: {$moreTextColorHover};
            background: {$moreBgColorHover};
        }

    ";
?>

<style>
    <?php echo $article_styles; ?>
</style>

<div class="dc-ca-article">
	<div class="dc-ca-article-inner h-100 p-3">
		<a href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid); ?>" class="dc-ca-article-link">
			<div class="dc-ca-article-image-wrapper">
				<?php echo LayoutHelper::render('joomla.content.intro_image', $item); ?>

				<div class="dc-ca-article-header">
					<<?php echo $articleHeadingTag; ?> class="dc-ca-article-title">
						<?php echo $item->title; ?>
					</<?php echo $articleHeadingTag; ?>>
				</div>
			</div>
		</a>

		<div class="dc-ca-article-content">
            <?php if ($showDate) : ?>
                <div class="dc-ca-article-info">
                    <span class="dc-ca-date">
                        <i class="fa fa-calendar"></i>
                        <?php echo HTMLHelper::_('date', $item->publish_up ?: $item->created, Text::_('DATE_FORMAT_LC3')); ?>
                    </span>
                </div>
            <?php endif; ?>

			<?php echo strip_tags($item->introtext); ?>

            <?php if($moreText != ''): ?>
                <div class="dc-ca-article-more">
                    <a href="<?php echo RouteHelper::getArticleRoute($item->id, $item->catid); ?>"><?php echo $moreText; ?></a>
                </div>
            <?php endif; ?>
		</div>
	</div>
</div>

