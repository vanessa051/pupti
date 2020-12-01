<?php
/**
 * Settings
 *
 * @since 1.13
 */

$options = get_option( 'wpmtst_options' );
?>
<h2><?php _e( 'Admin', 'strong-testimonials' ); ?></h2>

<table class="form-table" cellpadding="0" cellspacing="0">

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Pending Indicator', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
				<label>
					<input type="checkbox" name="wpmtst_options[pending_indicator]" <?php checked( $options['pending_indicator'] ); ?>>
					<?php _e( 'Show indicator bubble when new submissions are awaiting moderation.', 'strong-testimonials' ); ?>
                    <?php _e( 'On by default.', 'strong-testimonials' ); ?>
				</label>
			</fieldset>
		</td>
	</tr>

    <!-- @todo : delete commented line. For the moment let it be -->
	<!--<tr valign="top">
		<th scope="row">
			<?php /*_e( 'Reordering', 'strong-testimonials' ); */?>
		</th>
		<td>
			<fieldset>
			<label>
				<input type="checkbox" name="wpmtst_options[reorder]" <?php /*checked( $options['reorder'] ); */?>>
				<?php /*_e( 'Enable drag-and-drop reordering in the testimonial list.', 'strong-testimonials' ); */?>
				<?php /*_e( 'Off by default.', 'strong-testimonials' ); */?>
			</label>
            <p class="description"><?php /*_e( 'Then set <b>Order</b> to "menu order" in the View.', 'strong-testimonials' ); */?></p>
			</fieldset>
		</td>
	</tr>-->

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Custom Fields Meta Box', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
			<label>
				<input type="checkbox" name="wpmtst_options[support_custom_fields]" <?php checked( $options['support_custom_fields'] ); ?>>
				<?php _e( 'Show the <strong>Custom Fields</strong> meta box in the testimonial post editor. This does not affect the <strong>Client Details</strong> meta box.', 'strong-testimonials' ); ?>
				<?php _e( 'Off by default.', 'strong-testimonials' ); ?>
			</label>
            <p class="description"><?php _e( 'For advanced users.', 'strong-testimonials' ); ?></p>
			</fieldset>
		</td>
	</tr>
    <tr valign="top">
        <th scope="row">
            <?php _e( 'Permalinks', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox"
                           name="wpmtst_options[disable_rewrite]" <?php isset( $options['disable_rewrite'] ) ? checked( $options['disable_rewrite'] ) : ''; ?>>
                    <?php _e( 'Disable permalinks for testimonials.', 'strong-testimonials' ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
                <p class="description">
                    <?php esc_html_e( 'Prevent indexing of testimonials. This will overwrite the "Link to testimonial" settings from the "Views" section', 'strong-testimonials' ); ?>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr valign="top" <?php echo ( !isset( $options['disable_rewrite'] ) || '1' != $options['disable_rewrite'] ) ? '' : 'style="display:none;"'; ?> data-setting="single_testimonial_slug" >
        <th scope="row">
            <?php esc_html_e( 'Single Testimonial Slug', 'strong-testimonials' ); ?>
        </th>
        <td>
            <label>
                <input type="text" name="wpmtst_options[single_testimonial_slug]"
                       value="<?php echo esc_attr( $options['single_testimonial_slug'] ); ?>"/>
            </label>
            <p class="description"><?php esc_html_e( 'Change the permalink slug for a single entry testimonial. After changing this field, reset permalinks by going to Settings > Permalinks and clicking Save Changes.', 'strong-testimonials' ); ?></p>
        </td>
    </tr>

</table>

<hr/>
<h2><?php _e( 'Output', 'strong-testimonials' ); ?></h2>

<table class="form-table" cellpadding="0" cellspacing="0">

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Enable Touch', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
			<label>
				<input type="checkbox" name="wpmtst_options[touch_enabled]" <?php checked( $options['touch_enabled'] ); ?>>
				<?php _e( 'Enable touch swipe navigation in slideshows.', 'strong-testimonials' ); ?>
                <?php _e( 'On by default.', 'strong-testimonials' ); ?>
			</label>
            <p class="description"><?php _e( 'If you are having trouble scrolling long testimonials on a small screen, try disabling this.', 'strong-testimonials' ); ?></p>
			</fieldset>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Scroll Top', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
			<label>
				<input type="checkbox" name="wpmtst_options[scrolltop]" <?php checked( $options['scrolltop'] ); ?>>
				<?php printf( __( 'When a new page is selected in paginated Views, scroll to the top of the container minus %s pixels.', 'strong-testimonials' ), '<input type="text" name="wpmtst_options[scrolltop_offset]" value="' . $options['scrolltop_offset'] . '" size="3">' ); ?>
                <?php _e( 'On by default.', 'strong-testimonials' ); ?>
			</label>
			</fieldset>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Remove Whitespace', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
			<label>
				<input type="checkbox" name="wpmtst_options[remove_whitespace]" <?php checked( $options['remove_whitespace'] ); ?>>
				<?php _e( 'Remove space between HTML tags in View output to prevent double paragraphs <em>(wpautop)</em>.', 'strong-testimonials' ); ?>
                <?php _e( 'On by default.', 'strong-testimonials' ); ?>
			</label>
			</fieldset>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Comments', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[support_comments]" <?php checked( $options['support_comments'] ); ?>>
                    <?php _e( 'Allow comments on testimonials. Requires using your theme\'s single post template.', 'strong-testimonials' ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
			</fieldset>
			<p class="description"><?php _e( 'To enable comments:', 'strong-testimonials' ); ?></p>
			<ul class="description">
				<li><?php _e( 'For individual testimonials, use the <strong>Discussion</strong> meta box in the post editor or <strong>Quick Edit</strong> in the testimonial list.', 'strong-testimonials' ); ?></li>
				<li><?php _e( 'For multiple testimonials, use <strong>Bulk Edit</strong> in the testimonial list.', 'strong-testimonials' ); ?></li>
			</ul>
		</td>
	</tr>

	<tr valign="top">
		<th scope="row">
			<?php _e( 'Embed Width', 'strong-testimonials' ); ?>
		</th>
		<td>
			<fieldset>
                <?php printf(
                    /* Translators: %s is an input field. */
                    __( 'For embedded links (YouTube, Twitter, etc.) set the frame width to %s pixels.', 'strong-testimonials' ),
                    '<input type="text" name="wpmtst_options[embed_width]" value="' . $options['embed_width'] . '" size="3">' ); ?>
                <p class="description"><?php _e( 'Leave empty for default width (usually 100% for videos). Height will be calculated automatically. This setting only applies to Views.', 'strong-testimonials' ); ?></p>
                <p class="description">
                    <?php printf( '<a href="%s" target="_blank">%s</a>',
                        esc_url( 'https://codex.wordpress.org/Embeds' ),
                        __( 'More on embeds', 'strong-testimonials' ) ); ?>
                </p>
			</fieldset>
		</td>
	</tr>

    <tr valign="top">
        <th scope="row">
			<?php _e( 'Nofollow Links', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[nofollow]" <?php checked( $options['nofollow'] ); ?>>
					<?php _e( 'Add <code>rel="nofollow"</code> to URL custom fields.', 'strong-testimonials' ); ?>
                    <?php _e( 'On by default.', 'strong-testimonials' ); ?>
                </label>
                <p class="description">
	                <?php printf( 'To edit this value on your existing testimonials in bulk, try <a href="%s" target="_blank">%s</a> and set <code>nofollow</code> to <b>default</b>, <b>yes</b> or <b>no</b>.',
		                esc_url( 'https://wordpress.org/plugins/custom-field-bulk-editor/' ),
		                __( 'Custom Field Bulk Editor', 'strong-testimonials' ) ); ?>
                </p>
            </fieldset>
        </td>
    </tr>
    <tr valign="top">
        <th scope="row">
			<?php _e( 'Noopener Links', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[noopener]" <?php checked( $options['noopener'] ); ?>>
					<?php _e( 'Add <code>rel="noopener"</code> to URL custom fields.', 'strong-testimonials' ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>

    <tr valign="top">
        <th scope="row">
			<?php _e( 'Noreferrer Links', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[noreferrer]" <?php checked( $options['noreferrer'] ); ?>>
					<?php _e( 'Add <code>rel="noreferrer"</code> to URL custom fields.', 'strong-testimonials' ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    
    <tr valign="top">
        <th scope="row">
			<?php _e( 'Lazy Loading', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[lazyload]" <?php checked( $options['lazyload'] ); ?>>
                    <?php printf( __( 'Enable the Lazy Loading functionality.', 'strong-testimonials' ) ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    
    <?php if ( wpmtst_is_plugin_active( 'lazy-loading-responsive-images' ) ) : ?> 
    <tr valign="top">
        <th scope="row">
			<?php _e( 'No Lazy Loading Plugin', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[no_lazyload_plugin]" <?php checked( $options['no_lazyload_plugin'] ); ?>>
                    <?php printf( __( 'Exclude from <a href="%s" target="_blank">Lazy Loading Responsive Images</a> plugin.', 'strong-testimonials' ), esc_url( 'https://wordpress.org/plugins/lazy-loading-responsive-images/' ) ); ?>
                    <?php _e( 'On by default.', 'strong-testimonials' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    <?php else : ?>
        <input type="hidden" name="wpmtst_options[no_lazyload_plugin]" value="<?php echo $options['no_lazyload_plugin']; ?>">
    <?php endif; ?>
        
    <tr valign="top">
        <th scope="row">
			<?php _e( 'Upsells', 'strong-testimonials' ); ?>
        </th>
        <td>
            <fieldset>
                <label>
                    <input type="checkbox" name="wpmtst_options[disable_upsells]" <?php checked( $options['disable_upsells'] ); ?>>
                    <?php printf( __( 'Disable all upsells.', 'strong-testimonials' ) ); ?>
                    <?php _e( 'Off by default.', 'strong-testimonials' ); ?>
                </label>
            </fieldset>
        </td>
    </tr>
    
</table>
