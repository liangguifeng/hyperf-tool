<?php

namespace Tool\Url;

class Url
{
    /**
     * Determine if the given path is a valid URL.
     *
     * @param string $path
     * @return bool
     */
    public function isValidUrl($path)
    {
        if (!preg_match('~^(#|//|https?://|(mailto|tel|sms):)~', $path)) {
            return filter_var($path, FILTER_VALIDATE_URL) !== false;
        }

        return true;
    }
}