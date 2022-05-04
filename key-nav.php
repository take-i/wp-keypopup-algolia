<?php
/**
 * Plugin Name: Keyboard PopUP algolia search
 * Plugin URI: http://hack.gpl.jp/algolia_search/
 * Description: Algolia search that pops up by keyboard operation.
 * Author: JunkHack
 * Author URI: http://hack.gpl.jp/
 * Version: 1.0
 */

/**
 * Scripts for keyboard nav
 */
function jhkn_scripts() {
    global $post;
    
    $post_id = $post == null ? 0 : $post->ID;
    
    wp_enqueue_script('jquery');
    wp_enqueue_script('mice', plugins_url('mousetrap.min.js', __FILE__));
    wp_enqueue_script('mouse', plugins_url('mouse.js', __FILE__));
    wp_localize_script('mouse', 'mouse', array(
        'home' => home_url('/'),
        'list' => home_url('/list/'),
        'search' => home_url('/s/'),
    ) );
    
    wp_enqueue_style('mouse', plugins_url('mouse.css', __FILE__));
}

add_action('wp_enqueue_scripts', 'jhkn_scripts');
add_action('admin_enqueue_scripts', 'jhkn_scripts');

/**
 * Command Help area
 */
function jhkn_help() {
    ?>
    <div id="mouse">
        <div class="inner">
            <h1>Search</h1>
            
                    <form class="uagb-search-wrapper" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
                        <div class="uagb-search-form__container" role="tablist">

                            <input placeholder="Search" class="uagb-search-form__input aa-input" id="searchbox" type="search" name="s" title="Search" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="width: 80%;">
                            <pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: &quot;Open Sans&quot;, sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;">
                            </pre>
                        </div>
                    </form>

            <table>
                <tr>
                    <td class="divide">
                        <table>
                            <?php jhkn_help_helper(array('g', 'h'), 'home', __( 'Go to front page', 'knav' )); ?>
                            <?php jhkn_help_helper(array('g', 'l'), 'list', __( 'Go to List page', 'knav' )); ?>
                            <?php jhkn_help_helper(array('g', 's'), 'search', __( 'Go to Search page', 'knav' )); ?>
                        </table>                    
                    </td>
                    <td class="divide">
                        <table>
                            <?php jhkn_help_helper(array('/ or esc'), 'search', __( 'Toggle , Close the search box', 'knav' )); ?>
                            <?php jhkn_help_helper(array('.'), 'Focus', __( 'Focus the search box', 'knav' )); ?>
                            <?php jhkn_help_helper(array('Mouse Click'), 'unFocus', __( 'unFocus the search box', 'knav' )); ?>
                        </table>
                    
                    </td>
                </tr>
            </table>  
        </div>
    </div>
    <?php
}

add_action( 'wp_footer', 'jhkn_help' );
add_action( 'admin_footer', 'jhkn_help' );

/**
 * Prints the single command help
 * 
 * @param array $args command key combination
 * @param string $abbr abbriviation
 * @param string $desc command description
 */
function jhkn_help_helper($args, $abbr = '', $desc = '') {
    $cmd = array();
    $glue = ' <span class="thn">then</span> ';
    
    foreach( $args as $arg ) {
        $cmd[] = '<span class="cmd">' . $arg . '</span>';
    }
    ?>
    <tr>
        <td><?php echo implode( $glue, $cmd); ?></td>
        <td><?php echo $abbr == '' ? '&nbsp' : '<span class="help">&rarr; ' . $abbr . '</span>' ?></td>
        <td><?php echo $desc == '' ? '&nbsp' : $desc; ?></td>
    </tr>    
    <?php
}

?>