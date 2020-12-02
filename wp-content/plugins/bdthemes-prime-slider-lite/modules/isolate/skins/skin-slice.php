<?php

namespace PrimeSlider\Modules\Isolate\Skins;

use Elementor\Group_Control_Image_Size;
use Elementor\Icons_Manager;
use Elementor\Skin_Base as Elementor_Skin_Base;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Skin_Slice extends Elementor_Skin_Base {

    public function get_id() {
        return 'slice';
    }

    public function get_title() {
        return esc_html__('Slice', 'bdthemes-prime-slider');
    }

    public function render_navigation_arrows() {
		$settings = $this->parent->get_settings_for_display();

		?>

            <?php if ($settings['show_navigation_arrows']) : ?>
            <div class="bdt-navigation-arrows">
                <a class="bdt-prime-slider-previous" href="#" bdt-slidenav-previous bdt-slideshow-item="previous"></a>
    
                <a class="bdt-prime-slider-next" href="#" bdt-slidenav-next bdt-slideshow-item="next"></a>
            </div>

        
			<?php endif; ?>

		<?php
	}

    public function render_navigation_dots() {
        $settings = $this->parent->get_settings_for_display();

        ?>

        <?php if ($settings['show_navigation_dots']) : ?>

            <ul class="bdt-ps-dotnav">
                <?php $slide_index = 1; foreach ( $settings['slides'] as $slide ) : ?>
                    <li bdt-slideshow-item="<?php echo ($slide_index - 1); ?>" data-label="<?php echo str_pad( $slide_index, 2, '0', STR_PAD_LEFT); ?>" ><a href="#"><?php echo str_pad( $slide_index, 2, '0', STR_PAD_LEFT); ?></a></li>
                <?php $slide_index++;  endforeach; ?>

                <span><?php echo str_pad( $slide_index - 1, 2, '0', STR_PAD_LEFT); ?></span>
            </ul>

        <?php endif; ?>

        <?php
    }

    public function render_footer($slide) {
        $settings = $this->parent->get_settings_for_display();

        ?>

                </ul>

                <?php if ('yes' == $settings['show_play_button']) : ?>
                <div class="bdt-position-bottom-right bdt-position-z-index bdt-visible@s">
                    <div class="bdt-slide-thumbnav-img bdt-height-small">
                        <?php $slide_index = 1;
                        foreach ($settings['slides'] as $slide) : ?>
                            <li bdt-slideshow-item="<?php echo ($slide_index - 1); ?>" data-label="<?php echo str_pad($slide_index, 2, '0', STR_PAD_LEFT); ?>">
    
                                <?php $this->parent->rendar_item_image($slide, $slide['title']); ?>
    
                            </li>
                        <?php $slide_index++;
                        endforeach; ?>
    
                        <div class="bdt-skin-slice-play-btn">
                            <?php $slide_index = 1;
                            foreach ($settings['slides'] as $slide) : ?>
                                <div class="slice-play-btn" bdt-slideshow-item="<?php echo ($slide_index - 1); ?>" data-label="<?php echo str_pad($slide_index, 2, '0', STR_PAD_LEFT); ?>">

                                    <?php $this->render_play_button($slide); ?>

                                </div>
                            <?php $slide_index++;
                            endforeach; ?>

                        </div>
                    </div>
                </div>
                <?php endif; ?>


                <div class="bdt-flex bdt-position-bottom">
                    <div class="bdt-width-1-1 bdt-width-1-2@s">
                        <div class="bdt-grid">
                            <div class="bdt-width-5-6 bdt-width-2-3@s">
                                <div class="bdt-slide-text-btn-area">
                                <?php $slide_index = 1;
                                foreach ($settings['slides'] as $slide) : ?>
                                    <div class="bdt-slide-nav-arrows" bdt-slideshow-item="<?php echo ($slide_index - 1); ?>">

                                        <?php if ($slide['excerpt'] && ('yes' == $settings['show_excerpt'])) : ?>
                                            <div class="bdt-slider-excerpt">
                                                <?php echo wp_kses_post($slide['excerpt']); ?>
                                            </div>
                                        <?php endif; ?>

                                        <div class="bdt-skin-slide-btn">
                                            <?php $this->parent->render_button($slide); ?>
                                        </div>
                                    </div>
                                <?php $slide_index++;
                                endforeach; ?>
                                    
                                    <?php $this->render_navigation_arrows(); ?>
                                    <?php $this->render_navigation_dots(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <?php $this->render_social_link(); ?>
        </div>
        <?php $this->parent->render_offcanvas(); ?>
        <?php
    }

    public function render_social_link($position = 'left', $class = []) {
		$settings  = $this->parent->get_active_settings();

		if ('' == $settings['show_social_icon']) {
			return;
		}

		$this->parent->add_render_attribute('social-icon', 'class', 'bdt-prime-slider-social-icon');
		$this->parent->add_render_attribute('social-icon', 'class', $class);

		?>

			<div <?php echo $this->parent->get_render_attribute_string('social-icon'); ?>>

				<?php
						foreach ($settings['social_link_list'] as $link) :
							$tooltip = ('yes' == $settings['social_icon_tooltip']) ? ' title="' . esc_attr($link['social_link_title']) . '" bdt-tooltip="pos: ' . $position . '"' : ''; ?>

					<a href="<?php echo esc_url($link['social_link']); ?>" target="_blank" <?php echo $tooltip; ?>>
						<?php Icons_Manager::render_icon($link['social_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?>
					</a>
				<?php endforeach; ?>
			</div>

		<?php
	}

    protected function render_play_button($slide) {
		$settings = $this->parent->get_settings_for_display();
		$id       = $this->parent->get_id();

		if ('' == $settings['show_play_button']) {
			return;
		}

		// remove global lightbox
		$this->parent->add_render_attribute( 'lightbox-content', 'data-elementor-open-lightbox', 'no', true );
		$this->parent->add_render_attribute( 'lightbox-content', 'href', $slide['lightbox_link']['url'], true );
		
		$this->parent->add_render_attribute( 'lightbox', 'class', 'bdt-slide-play-button bdt-position-bottom-right', true );
		$this->parent->add_render_attribute( 'lightbox', 'bdt-lightbox', 'video-autoplay: true;', true );
		
        ?>     
		<div <?php echo $this->parent->get_render_attribute_string( 'lightbox' ); ?>>			

			<a <?php echo $this->parent->get_render_attribute_string( 'lightbox-content' ); ?>>
                <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="play" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-play fa-w-14 fa-2x"><path fill="currentColor" d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6zm-16.2 55.1l-352 208C45.6 483.9 32 476.6 32 464V47.9c0-16.3 16.4-18.4 24.1-13.8l352 208.1c10.5 6.2 10.5 21.4.1 27.6z" class=""></path></svg>
			</a>

		</div>     
		<?php
	}

    public function render_item_content($slide_content) {
        $settings = $this->parent->get_settings_for_display();

        ?>
            <div class="bdt-prime-slider-wrapper">
                <div class="bdt-prime-slider-content">
                    <div class="bdt-prime-slider-desc">

                                
                        <?php if ($slide_content['title'] && ('yes' == $settings['show_title'])) : ?>
                        <div class="bdt-main-title">
                            <h4 bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0">
                                <?php echo prime_slider_first_word($slide_content['sub_title']); ?>
                            </h4>
                            <<?php echo esc_html($settings['title_html_tag']); ?> class="bdt-title-tag"  bdt-slideshow-parallax="y: 50,0,-50; opacity: 1,1,0">
                                <?php if ('' !== $slide_content['title_link']['url']) : ?>
                                    <a href="<?php echo esc_url($slide_content['title_link']['url']); ?>">
                                    <?php endif; ?>
                                    <?php echo prime_slider_first_word($slide_content['title']); ?>
                                    <?php if ('' !== $slide_content['title_link']['url']) : ?>
                                    </a>
                                <?php endif; ?>
                            </<?php echo esc_html($settings['title_html_tag']); ?>>
                        </div>
                        <?php endif; ?>

                        
                    </div>

                </div>
            </div>

        <?php
    }

    public function render_slides_loop() {
        $settings = $this->parent->get_settings_for_display();

        $kenburns_reverse = $settings['kenburns_reverse'] ? ' bdt-animation-reverse' : '';

        foreach ($settings['slides'] as $slide) : ?>

            <li class="bdt-slideshow-item bdt-flex bdt-flex-column bdt-flex-middle elementor-repeater-item-<?php echo $slide['_id']; ?>">
                <div class="bdt-width-1-1 bdt-width-1-2@s">
                    <?php $this->render_item_content($slide); ?>
                </div>
                <div class="bdt-width-1-1 bdt-width-1-2@s">
                    <div class="bdt-position-relative bdt-text-center bdt-slide-overlay">
                        <?php if ('yes' == $settings['kenburns_animation']) : ?>
                            <div class="bdt-position-cover bdt-animation-kenburns<?php echo esc_attr($kenburns_reverse); ?> bdt-transform-origin-center-left">
                            <?php endif; ?>
        
                                <?php $this->parent->rendar_item_image($slide, $slide['title']); ?>
        
                            <?php if ('yes' == $settings['kenburns_animation']) : ?>
                            </div>
                        <?php endif; ?>
        
                        <?php if ('none' !== $settings['overlay']) :
                                        $blend_type = ('blend' == $settings['overlay']) ? ' bdt-blend-' . $settings['blend_type'] : ''; ?>
                            <div class="bdt-overlay-default bdt-position-cover<?php echo esc_attr($blend_type); ?>"></div>
                        <?php endif; ?>
                    </div>
				</div>
            </li>

        <?php endforeach;
    }

    
    public function render() {
            
        $settings = $this->parent->get_settings_for_display();

        $skin_name = 'slice';

        $this->parent->render_header( $skin_name );

        $this->render_slides_loop();

        $this->render_footer('$slide');
    }
}
