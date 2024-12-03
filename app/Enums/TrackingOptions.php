<?php

namespace App\Enums;

enum TrackingOptions: string
{

    case ALL = 'All Visitors';
    case SEARCH = 'Search';
    case WEB_REFERRALS = 'Web Referrals';
    case LANDING_PAGE = 'Landing Page';
    case LANDING_PARAMS = 'Landing Params';
    case DIRECT = 'Direct';
    case OTHER = 'Other';
}
