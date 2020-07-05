<?php

/**
 * Navbar active class helper
 *
 * @param $path
 * @param string $active
 * @return mixed|string
 */
function is_active($path, $active = 'active')
{
    return call_user_func_array('Request::is', (array) $path) ? $active : '';
}

