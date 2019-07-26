<?php

namespace Supermetrics\Constants;

/**
 * Class ConstParams.
 */
final class ConstParams
{
    public const POST_URL = 'https://api.supermetrics.com/assignment/register';
    public const GET_URL = 'https://api.supermetrics.com/assignment/posts?';
    public const CLIENT_ID = 'ju16a6m81mhid5ue1z3v2g0uh';
    public const EMAIL = 'your@email.address';
    public const NAME = 'Your Name';
    public const SL_TOKEN = 'sl_token';
    public const PAGE = 'page';

    /**
     * @var array
     */
    public static $registerParams = [
        'client_id' => self::CLIENT_ID,
        'email' => self::EMAIL,
        'name' => self::NAME,
    ];
}

