<?php

namespace VoipMs\V2\Enum;

/**
 * Represents authentication type options for accounts/subaccounts.
 * Values should be confirmed with the getAuthTypes API method.
 */
enum AuthType: int
{
    /** IP based authentication. */
    case IP = 1;

    /** SIP Password based authentication. */
    case PASSWORD = 2;

    /** IP and SIP Password based authentication. */
    case IP_AND_PASSWORD = 3;
}
