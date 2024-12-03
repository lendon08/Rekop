<?php

namespace App\Enums;

enum TrackingTraffic: string
{
    case PAID = 'Paid';
    case ORGANIC = 'Organic';
    case ALL = 'All';
}
