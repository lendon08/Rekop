<?php

namespace App\Enums;

enum TrackingSearchEngine: string
{
    case GOOGLE = 'Google';
    case YAHOO = 'Yahoo';
    case BING = 'Bing';
    case ALLSEARCH = 'All Search';
}
