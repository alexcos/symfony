<?php
/**
 * This configuration file is used by G4UtilBundle/Pdf.php.
 *
 * These settings replace the defaults in vendor/tcpdf/config/tcpdf_config.php.
 * See that file for explanation of individual settings.
 */

// Don't load the default tcpdf settings
define('K_TCPDF_EXTERNAL_CONFIG', true);

// --------------------
// Environment settings
// --------------------
define('K_PATH_MAIN',   __DIR__ . '/../../../../../vendor/tcpdf/');
define('K_PATH_FONTS',  K_PATH_MAIN.'fonts/');
define('K_PATH_CACHE',  __DIR__ . '/../../../../../app/cache/');
define('K_PATH_IMAGES', K_PATH_MAIN.'images/');
define('K_BLANK_IMAGE', K_PATH_IMAGES.'_blank.png');

define('K_PATH_URL',       'http://disabledPdfUrl/'); // we do not currently need to expose a URL
define('K_PATH_URL_CACHE', K_PATH_URL.'cache/');

// --------------------
// Application settings
// --------------------

// meta properties
define('PDF_CREATOR', '');
define('PDF_AUTHOR', '');

// header/footer properties
define('PDF_HEADER_TITLE', '');
define('PDF_HEADER_STRING', '');
define('PDF_HEADER_LOGO', '');
define('PDF_HEADER_LOGO_WIDTH', 0);
define('PDF_MARGIN_HEADER', 0);
define('PDF_MARGIN_FOOTER', 0);

// page properties
define('PDF_PAGE_FORMAT', 'A4');
define('PDF_PAGE_ORIENTATION', 'P'); // P=portrait, L=landscape
define('PDF_UNIT', 'mm');            // pt=point, mm=millimeter, cm=centimeter, in=inch

define('PDF_MARGIN_TOP', 15);
define('PDF_MARGIN_BOTTOM', 10);
define('PDF_MARGIN_LEFT', 10);
define('PDF_MARGIN_RIGHT', 10);

define('PDF_FONT_NAME_MAIN', 'helvetica');
define('PDF_FONT_SIZE_MAIN', 10);

define('PDF_FONT_NAME_DATA', 'helvetica');
define('PDF_FONT_SIZE_DATA', 8);

define('PDF_FONT_MONOSPACED', 'courier');

/**
 * ratio used to adjust the conversion of pixels to user units
 */
define('PDF_IMAGE_SCALE_RATIO', 1.25);

/**
 * magnification factor for titles
 */
define('HEAD_MAGNIFICATION', 1.1);

/**
 * height of cell repect font height
 */
define('K_CELL_HEIGHT_RATIO', 1.2);

/**
 * title magnification respect main font size
 */
define('K_TITLE_MAGNIFICATION', 1.3);

/**
 * reduction factor for small font
 */
define('K_SMALL_RATIO', 2/3);

/**
 * set to true to enable the special procedure used to avoid the overlappind of symbols on Thai language
 */
define('K_THAI_TOPCHARS', false);

/**
 * if true allows to call TCPDF methods using HTML syntax
 * IMPORTANT: For security reason, disable this feature if you are printing user HTML content.
 * NOTE: we use this to print barcode in BoardingPassController
 */
define('K_TCPDF_CALLS_IN_HTML', true);
