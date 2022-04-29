<?php

/**
 * Custom search form in the header 
 */

?>

<form role="search" aria_label="" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <div class="search-container d-flex flex-row align-items-center justify-content-between">
        <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'sprystore'); ?> </span>
        <div class="search-glass" type="submit" id="button-addon2">
            <span>
                <svg class="search-icon" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0 0 16 9.5 6.5 6.5 0 1 0 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path>
                </svg>
            </span>
        </div>
        <div class="search-input-container d-flex flex-wrap">
            <input type="search" id="input-search" class="input-search" placeholder=<?php echo esc_attr_x('Search &hellip;', 'placeholder', 'sprystore'); ?> value="<?php echo the_search_query(); ?>" name="s" autocomplete="off" />
        </div>
        <div class="search-button-clean" id="search-button-clean">
            <span>
                <svg class="search-icon-clean hidden" focusable="false" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"></path>
                </svg>
            </span>
        </div>

    </div>

</form>