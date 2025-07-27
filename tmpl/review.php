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

    $imageTag = LayoutHelper::render('joomla.content.intro_image', $item);
    preg_match('/src=["\']([^"\']+)["\']/', $imageTag, $matches);
    $imageUrl = Uri::root() . $matches[1];

    $placeholder = Uri::base() . 'modules/mod_dc_carouselarticles/tmpl/img/blank.webp';

    $review_styles = "

        $cssId .dc-ca-review-name {
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            background: {$titleBgColor};
        }

        $cssId .dc-ca-review-name {$articleHeadingTag}{
            color: {$titleTextColor};
            font-size: {$titleFontSize}px;
            margin:0px;
        }

        $cssId .dc-ca-review-content{
            color: {$textColor};
            font-size: {$textFontSize}px;
        }

        $cssId .dc-ca-quote-top .dc-ca-quote-icon svg {
            fill: {$quoteTopColor};
            color: {$quoteTopColor};
        }

        $cssId .dc-ca-quote-bottom .dc-ca-quote-icon svg {
            fill: {$quoteBottomColor};
            color: {$quoteBottomColor};
        }
    ";
?>

<style>
    <?php echo $review_styles; ?>
</style>

<div class="dc-ca-review">
	<div class="dc-ca-review-inner h-100 p-3">

		<div class="dc-ca-review-panel">

			<div class="dc-ca-quote-top text-start">
                <span class="dc-ca-quote-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46" width="46" height="46">
                        <path d="M13 14.725c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 
                                2.491.392 4.396 2.547 4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275zm-13 
                                0c0-5.141 3.892-10.519 10-11.725l.984 2.126c-2.215.835-4.163 3.742-4.38 5.746 2.491.392 4.396 2.547 
                                4.396 5.149 0 3.182-2.584 4.979-5.199 4.979-3.015 0-5.801-2.305-5.801-6.275z" fill="currentColor"/>
                    </svg>
                </span>
            </div>

			<div class="dc-ca-review-image">
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

			<div class="dc-ca-title dc-ca-review-name">
				<<?php echo $articleHeadingTag; ?> class="dc-ca-review-title"><?php echo $item->title; ?></<?php echo $articleHeadingTag; ?>>
			</div>

			<div class="dc-ca-review-content">
				<p>
					<?php echo mb_substr(strip_tags($item->introtext), 0, 360); ?>...
				</p>
			</div>

			<div class="dc-ca-quote-bottom text-end">
                <span class="dc-ca-quote-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 46 46" width="46" height="46">
                        <path d="M19 17.275c0 5.141-3.892 10.519-10 11.725l-.984-2.126c2.215-.835 4.163-3.742 4.38-5.746
                                -2.491-.392-4.396-2.547-4.396-5.149 0-3.182 2.584-4.979 5.199-4.979 3.015 0 5.801 2.305 5.801 6.275zm13 
                                0c0 5.141-3.892 10.519-10 11.725l-.984-2.126c2.215-.835 4.163-3.742 4.38-5.746-2.491-.392-4.396-2.547 
                                -4.396-5.149 0-3.182 2.584-4.979 5.199-4.979 3.015 0 5.801 2.305 5.801 6.275z" fill="currentColor"/>
                    </svg>
                </span>
            </div>

		</div>

		<div class="dc-ca-review-extra">
			<!-- Optional additional content -->
		</div>

	</div>
</div>

