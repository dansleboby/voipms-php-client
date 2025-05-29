<?php

namespace VoipMs\V2\Enum;

/**
 * Represents types of vanity toll-free numbers for searching.
 */
enum VanityTollFreeType: string
{
    /** Search for numbers with repeating digits or patterns (e.g., 8**-XXX-YYYY). */
    case ALL_STARS = '8**';

    /** Search for 800 numbers. */
    case TF_800 = '800';

    /** Search for 833 numbers. */
    case TF_833 = '833';

    /** Search for 844 numbers. */
    case TF_844 = '844';

    /** Search for 855 numbers. */
    case TF_855 = '855';

    /** Search for 866 numbers. */
    case TF_866 = '866';

    /** Search for 877 numbers. */
    case TF_877 = '877';

    /** Search for 888 numbers. */
    case TF_888 = '888';
}
