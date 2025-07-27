<?php 
    /**
     * @package     Joomla.Site
     * @subpackage  mod_dc_carouselarticles
     *
     * @copyright   Copyright (C) 2025 Design Cart. All rights reserved.
     * @license     GNU General Public License version 2 or later; see LICENSE.txt
     */

    defined('_JEXEC') or die; 

    use Joomla\CMS\Language\Text;

    $moduleId = (int) $module->id;

    $headingTag = strtolower($params->get('heading_tag', 'h3'));
    preg_match('/h([1-6])/', $headingTag, $matches);
    $baseLevel = isset($matches[1]) ? (int)$matches[1] : 3;
    $articleHeadingLevel = min(6, $baseLevel + 1);
    $articleHeadingTag = 'h' . $articleHeadingLevel;

    $cssId    = '#dc-ca-carousel-' . $moduleId;

    $styles = "

        $cssId .dc-ca-review-inner, 
        $cssId .dc-ca-portfolio-inner,
        $cssId .dc-ca-article-inner{
            background-color: {$bgColor};
            color: {$textColor};
            font-size: {$textFontSize}px;
        }

        $cssId .dc-ca-heading ".$headingTag."{
            color: {$headingColor};
            font-size: {$headingFontSize}px;
        }
    
        
        $cssId .dc-ca-description {
            color: {$descriptionColor};
            font-size: {$descriptionFontSize}px;
        }

        $cssId .dc-ca-carousel-wrapper{
            padding-left:60px;
            padding-right:60px;
        }

        $cssId .owl-prev {
            display: inline-block;
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            background: {$prevBgColor} !important;
            color: {$prevTextColor} !important;
            -webkit-border-radius: 50px;
            border-radius: 50px;
            font-size: 34px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: -60px;
        }

        $cssId .owl-next {
            display: inline-block;
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            background-color: {$nextBgColor} !important;
            color: {$nextTextColor} !important;
            -webkit-border-radius: 50px;
            border-radius: 50px;
            font-size: 34px;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: -60px;
        }

    ";

    
?>

<style>
    <?php echo $styles; ?>
</style>

<div id="dc-ca-carousel-<?php echo $moduleId; ?>" class="dc-ca-carousel-container">

	<?php if ($heading) : ?>
		<div class="dc-ca-heading">
			<<?php echo $headingTag; ?> class="dc-ca-heading-text">
				<?php echo $heading; ?>
			</<?php echo $headingTag; ?>>
		</div>
	<?php endif; ?>

	<?php if ($description) : ?>
		<div class="dc-ca-description">
			<?php echo $description; ?>
		</div>
	<?php endif; ?>

	<div class="dc-ca-carousel-wrapper">
		<div id="dc-ca-owl-<?php echo $moduleId; ?>" class="owl-carousel owl-theme dc-ca-owl">
			<?php foreach ($items as $item) : ?>
				<div class="dc-ca-item">
					<?php 
                        $templateFile = __DIR__ . '/' . $template . '.php';
                        if (file_exists($templateFile)) {
                            require $templateFile;
                        }
                    ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>

<script>
	jQuery(document).ready(function($) {
		$('#dc-ca-owl-<?php echo $moduleId; ?>').owlCarousel({
			loop: true,
			margin: 10,
			nav: true,
			dots: false,
			responsive: {
				0: {
					items: <?php echo max(1, $visible - 3); ?>
				},
				600: {
					items: <?php echo max(1, $visible - 2); ?>
				},
				1000: {
					items: <?php echo $visible; ?>
				}
			}
		});
	});
</script>

