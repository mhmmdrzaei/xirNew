<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

      add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','gallery','caption','style','script']);
  add_theme_support('custom-logo', [
    'height' => 200, 'width' => 600, 'flex-height' => true, 'flex-width' => true,
  ]);

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
        'footer'  => __('Footer Menu', 'sage'),
    ]);

    add_action('init', function () {
  register_post_type('artist', [
    'label' => 'Residents',
    'labels' => ['singular_name' => 'Resident'],
    'public' => true,
    'has_archive' => true,
    'show_in_rest' => true,
    'supports' => ['title','editor','thumbnail','excerpt'],
    'menu_icon' => 'dashicons-admin-users',
    'rewrite' => ['slug' => 'residents'],
  ]);

  register_taxonomy('resident_status', ['resident'], [
    'label' => 'Resident Status',
    'public' => true,
    'hierarchical' => false,
    'show_in_rest' => true,
    'rewrite' => ['slug' => 'resident-status'],
  ]);

  // Ensure common terms exist (optional).
  if (!term_exists('current', 'resident_status')) { wp_insert_term('Current', 'resident_status', ['slug' => 'current']); }
  if (!term_exists('past', 'resident_status'))    { wp_insert_term('Past', 'resident_status', ['slug' => 'past']); }
});

add_action('pre_get_posts', function ($q) {
  if (!is_admin() && $q->is_main_query() && $q->is_post_type_archive('resident')) {
    $q->set('meta_key', 'residence_year');
    $q->set('orderby', ['meta_value_num' => 'DESC', 'date' => 'DESC']);
    $q->set('posts_per_page', 12);
  }
});


/**
 * ACF local fields (requires ACF Pro for repeater).
 * If you don't have ACF Pro, create these fields manually in the UI.
 */
add_action('acf/init', function () {
  if (!function_exists('acf_add_local_field_group')) return;

  acf_add_local_field_group([
    'key' => 'group_resident_fields',
    'title' => 'Resident Fields',
    'location' => [[['param' => 'post_type','operator' => '==','value' => 'resident']]],
    'fields' => [
      [
        'key' => 'field_residence_year',
        'label' => 'Residence Year',
        'name' => 'residence_year',
        'type' => 'number',
        'required' => 0,
        'min' => 1900, 'max' => 3000,
      ],
      [
        'key' => 'field_social_links',
        'label' => 'Social Media Links',
        'name' => 'social_media_links',
        'type' => 'repeater',
        'layout' => 'table',
        'collapsed' => 'field_social_title',
        'button_label' => 'Add Link',
        'sub_fields' => [
          [
            'key' => 'field_social_title',
            'label' => 'Social Title',
            'name' => 'social_platform',
            'type' => 'text',
          ],
          [
            'key' => 'field_social_url',
            'label' => 'Social URL',
            'name' => 'social_link',
            'type' => 'url',
          ],
        ],
      ],
    ],
  ]);
});
    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});
