<?php

namespace VoipMs\V2\Enum;

/**
 * Represents options for voicemail setup.
 * These values typically determine how voicemail is handled or configured.
 * Values should be confirmed with the getVoicemailSetups API method.
 */
enum VoicemailSetupOption: int
{
    /** Standard Voicemail Setup. */
    case STANDARD = 1;

    /** Voicemail to Email only (no local storage). */
    case EMAIL_ONLY = 2;

    /** Forward to another extension, then voicemail. */
    case FORWARD_THEN_VM = 3;

    /** Custom setup A (example). */
    case CUSTOM_A = 4; // Example, actual values needed

    /** Custom setup B (example). */
    case CUSTOM_B = 5; // Example, actual values needed
}
