<?php

namespace VoipMs\V2\Enum;

/**
 * Represents protocol options.
 * Values should be confirmed with the getProtocols API method.
 */
enum ProtocolOption: int
{
    /** SIP Protocol. */
    case SIP = 1;

    /** IAX2 Protocol. */
    case IAX2 = 2;

    /** Both SIP and IAX2 Protocols. */
    case BOTH = 3;
}
