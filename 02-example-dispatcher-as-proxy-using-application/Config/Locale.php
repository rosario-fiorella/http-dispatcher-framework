<?php

declare(strict_types=1);

namespace App\Config;

class Locale
{
    public function __construct(string $lang = 'it_IT', string $codeset = 'UTF8', string $textdomain = 'app')
    {
        putenv('LC_ALL=' . $lang);
        putenv('LANG=' . $lang . '.' . $codeset);
        putenv('LANGUAGE=' . $lang . '.' . $codeset);

        bind_textdomain_codeset($textdomain, $codeset);
        bindtextdomain($textdomain, dirname(__DIR__) . '/locale/');

        setlocale(LC_ALL, $lang . '.' . $codeset);
        textdomain($textdomain);
    }
}
