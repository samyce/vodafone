<?php


namespace app\enum;

/**
 * Class ActionEnum
 * @package app\enum
 *
 * Enum for actions
 */
class ActionEnum
{
    const CREDIT = 'CREDIT < 200';
    const LAST_TOP_UP_DATE = 'LAST TOP UP DATE > 5 months';
    const CREDIT_LAST_TOP_UP_DATE = 'CREDIT <= 300 && LAST TOP UP DATE < 2 months';
}
