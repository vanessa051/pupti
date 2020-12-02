<?php

namespace PrimeSlider\Modules\General\Skins;


use Elementor\Skin_Base as Elementor_Skin_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Skin_Meteor extends Elementor_Skin_Base {

    public function get_id() {
        return 'meteor';
    }

    public function get_title() {
        return esc_html__('Meteor', 'bdthemes-prime-slider');
    }

    public function render_navigation_dots() {
        $settings = $this->parent->get_settings_for_display();

        ?>

        <?php if ($settings['show_navigation_dots']) : ?>

            <ul class="bdt-slideshow-nav bdt-dotnav bdt-dotnav-vertical bdt-margin-large-right bdt-position-center-right"></ul>

        <?php endif; ?>

        <?php
    }

    public function render_footer() {
        $settings = $this->parent->get_settings_for_display();

        ?>

        </ul>

                <?php $this->render_navigation_dots(); ?>

                <div class="bdt-prime-slider-footer-content bdt-height-small bdt-flex-middle bdt-position-bottom" bdt-grid>
                    <div class="bdt-width-1-6">
                        <?php $this->parent->render_scroll_button(); ?>
                    </div>
                    <div class="bdt-width-1-6">
                        <div class="bdt-slide-thumbnav-img bdt-height-small">
                            <?php $slide_index = 1;
                                    foreach ($settings['slides'] as $slide) : ?>
                                <li bdt-slideshow-item="<?php echo ($slide_index - 1); ?>" data-label="<?php echo str_pad($slide_index, 2, '0', STR_PAD_LEFT); ?>">

                                    <?php if (($slide['background'] == 'image') && $slide['image']) : ?>
                                        <?php $this->parent->rendar_item_image($slide, $slide['title']); ?>
                                    <?php elseif (($slide['background'] == 'video') && $slide['video_link']) : ?>
                                        <?php $this->parent->rendar_item_video($slide); ?>
                                    <?php elseif (($slide['background'] == 'youtube') && $slide['youtube_link']) : ?>
                                        <?php $this->parent->rendar_item_youtube($slide); ?>
                                    <?php endif; ?>

                                </li>
                            <?php $slide_index++;
                                    endforeach; ?>
                        </div>
                    </div>
                    <div class="bdt-width-expand bdt-social-background bdt-height-small">
                        <ul class="bdt-ps-meta">
                            <?php $slide_index = 1;
                            foreach ($settings['slides'] as $slide) : ?>
                                <li bdt-slideshow-item="<?php echo ($slide_index - 1); ?>" data-label="<?php echo str_pad($slide_index, 2, '0', STR_PAD_LEFT); ?>">

                                    <?php if ($slide['excerpt'] && ('yes' == $settings['show_excerpt'])) : ?>
                                        <div class="bdt-slider-excerpt bdt-column-1-2" bdt-slideshow-parallax="y: 300,0,-100; opacity: 1,1,0">
                                            <?php echo wp_kses_post($slide['excerpt']); ?>
                                        </div>
                                    <?php endif; ?>

                                </li>
                            <?php $slide_index++;
                            endforeach; ?>

                        </ul>
                    </div>
                    <div class="bdt-width-1-6 bdt-flex bdt-flex-middle bdt-flex-center bdt-height-small  bdt-social-bg-color bdt-padding-remove">
                        <?php $this->parent->render_social_link('top'); ?>
                    </div>
                </div>

            </div>
        </div>
        <?php $this->parent->render_offcanvas(); ?>
        <?php
    }

    public function render_item_content($slide_content) {
        $settings = $this->parent->get_settings_for_display();

        $this->parent->add_render_attribute(
			[
				'title-link' => [
					'class' => [
						'bdt-slider-title-link',
					],
					'href'   => $slide_content['title_link']['url'] ? esc_url($slide_content['title_link']['url']) : 'javascript:void(0);',
					'target' => $slide_content['title_link']['is_external'] ? '_blank' : '_self'
				]
			], '', '', true
		);

        ?>
        <div class="bdt-prime-slider-container">
            <div class="bdt-slideshow-content-wrapper bdt-position-z-index">
                <div class="bdt-prime-slider-wrapper">
                    <div class="bdt-prime-slider-content">
                        <div class="bdt-prime-slider-desc">

                            <?php if ($slide_content['sub_title'] && ('yes' == $settings['show_sub_title'])) : ?>
                                <div class="bdt-sub-title">
                                    <h4 bdt-slideshow-parallax="x: 300,0,-100; opacity: 1,1,0">
                                        <?php echo wp_kses_post($slide_content['sub_title']); ?>
                                    </h4>
                                </div>
                            <?php endif; ?>

                            <?php if ($slide_content['title'] && ('yes' == $settings['show_title'])) : ?>
                                <div class="bdt-main-title"  bdt-slideshow-parallax="x: 500,0,-100; opacity: 1,1,0">
                                    <<?php echo esc_html($settings['title_html_tag']); ?> class="bdt-title-tag">
                                        <?php if ('' !== $slide_content['title_link']['url']) : ?>
                                            <a <?php echo $this->parent->get_render_attribute_string( 'title-link' ); ?>>
                                        <?php endif; ?>
                                            <?php echo wp_kses_post($slide_content['title']); ?>
                                        <?php if ('' !== $slide_content['title_link']['url']) : ?>
                                            </a>
                                        <?php endif; ?>
                                    </<?php echo esc_html($settings['title_html_tag']); ?>>
                                </div>
                            <?php endif; ?>

                            <div bdt-slideshow-parallax="x: 700,0,-100; opacity: 1,1,0">

                                <?php $this->parent->render_button($slide_content); ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    public function render_slides_loop() {
        $settings = $this->parent->get_settings_for_display();

        $kenburns_reverse = $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '';

        foreach ($settings['slides'] as $slide) : ?>

            <li class="bdt-slideshow-item bdt-flex bdt-flex-middle elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?>">
                <?php if ('yes' == $settings['kenburns_animation']) : ?>
                    <div class="bdt-position-cover bdt-animation-kenburns<?php echo esc_attr($kenburns_reverse); ?> bdt-transform-origin-center-left">
                    <?php endif; ?>

                    <?php if (($slide['background'] == 'image') && $slide['image']) : ?>
                        <?php $this->parent->rendar_item_image($slide, $slide['title']); ?>
                    <?php elseif (($slide['background'] == 'video') && $slide['video_link']) : ?>
                        <?php $this->parent->rendar_item_video($slide); ?>
                    <?php elseif (($slide['background'] == 'youtube') && $slide['youtube_link']) : ?>
                        <?php $this->parent->rendar_item_youtube($slide); ?>
                    <?php endif; ?>

                    <?php if ('yes' == $settings['kenburns_animation']) : ?>
                    </div>
                <?php endif; ?>

                <?php if ('none' !== $settings['overlay']) :
                                $blend_type = ('blend' == $settings['overlay']) ? ' bdt-blend-' . $settings['blend_type'] : ''; ?>
                    <div class="bdt-overlay-default bdt-position-cover<?php echo esc_attr($blend_type); ?>"></div>
                <?php endif; ?>

                <?php

                $this->render_item_content($slide);

                ?>
            </li>

        <?php endforeach;
    }

    public function render() {
        
        $skin_name = 'meteor';

        $this->parent->render_header($skin_name);

        $this->render_slides_loop();

        $this->render_footer();
            
    }
}
