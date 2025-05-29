<?php

namespace VoipMs\V2\Enum;

/**
 * Represents email attachment format options for voicemails.
 * Values should be confirmed with the getVoicemailAttachmentFormats API method.
 */
enum EmailAttachmentFormat: string
{
    /** WAV audio format (uncompressed). */
    case WAV = 'wav';

    /** MP3 audio format (compressed). */
    case MP3 = 'mp3';

    /** WAV49 audio format (GSM compressed). */
    case WAV49 = 'wav49'; // Common in Asterisk/VoIP for GSM format

    /** OGG Vorbis audio format. */
    case OGG = 'ogg';
}
