<?php
namespace PHPMVC\lib;

trait InputFilter
{
    public function filterInteger($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
    }

    public function filterFloat($input)
    {
        return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

    }
    public function filterString($input)
    {
        return htmlentities(strip_tags($input), ENT_QUOTES, "UTF-8");
    }

}