<?php
/**
 * Template content
 * inside wordpress the loop
 * @package  DS
 */
if(is_single()||is_page()){
    the_content();
}
else{
    the_excerpt();
}
