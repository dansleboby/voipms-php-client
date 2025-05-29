<?php

namespace VoipMs\V2\Enum;

/**
 * Represents SMS/MMS message type options (Received/Sent).
 * API typically uses 1 for received, 0 for sent.
 */
enum SmsMessageType: int
{
    case RECEIVED = 1;
    case SENT = 0;
}
