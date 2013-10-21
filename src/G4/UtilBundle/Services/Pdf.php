<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Services
 */
namespace G4\UtilBundle\Services;

// Use our config settings instead of Tcpdf's defaults
require_once __DIR__ . '/../Resources/config/pdf_config.php';

// Require the TCPDF class
require_once __DIR__.'/../../../../vendor/tcpdf/tcpdf.php';

/**
 * Symfony service for the TCPDF library installed at vendor/tcpdf.
 */
class Pdf extends \TCPDF
{

    /**
     * @var string	Send file to browser. Uses browser plug-in to display (if installed).
     */
    const INLINE = 'I';

    /**
     * @var string	Causes browser to open download dialog.
     */
    const DOWNLOAD = 'D';

    /**
     * @var string	Save as file on local (server) filesystem.
     */
    const LOCALFILE = 'F';

    /**
     * @var string	Return document as a string.
     */
    const STRING = 'S';

    /**
     * @var string	Return document in base64 mime multi-part format.
     */
    const MIME_EMAIL = 'E';

    /**
     * @var string	Save file locally and send to browser plug-in.
     */
    const LOCALFILE_AND_INLINE = 'FI';

    /**
     * @var string	Save file locally and send to browser for download.
     */
    const LOCALFILE_AND_DOWNLOAD = 'FD';


    /**
     * Contains any universal settings.
     *
     * This method is automatically run via the services.yml 'calls' parameter.
     *
     * @return void
     */
    public function init()
    {
        $this->setPrintHeader(false);
        $this->setPrintFooter(false);
    }


    /**
     * Uses the TCPDF method to serialize data.
     *
     * @param mixed $data Data to serialize
     *
     * @return string
     */
    public function serialize($data)
    {
        return $this->serializeTCPDFtagParameters($data);
    }


    /**
     * Convert HTML string to PDF
     *
     * @param string $html     HTML to convert
     * @param string $delivery One of the delivery constants
     * @param string $filename Note: Ignored if delivery = self::STRING
     *
     * @return mixed (Varies by $delivery)
     */
    public function htmlToPdf($html, $delivery = self::STRING, $filename = 'doc.pdf')
    {
        $this->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
        $this->AddPage();
        $this->writeHTML($html, true, false, true, false, '');
        return $this->Output($filename, $delivery);
    }
}