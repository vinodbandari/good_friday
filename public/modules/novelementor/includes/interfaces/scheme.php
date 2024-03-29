<?php

namespace NovElementor;

defined('_PS_VERSION_') or exit;

interface SchemeInterface
{
    public static function getType();

    public function getTitle();

    public function getDisabledTitle();

    public function getSchemeTitles();

    public function getDefaultScheme();

    public function printTemplateContent();
}
