<?php

namespace G4\UtilBundle;

require_once __DIR__ . '/../../../vendor/tcpdf/barcodes.php';

/**
 * Extends the TCPDFBarcode class
 */
class Barcode extends \TCPDFBarcode
{
    /**
     * @var string Full url to the symfony web/bundles directory (g4_sy2web)
     */
    private $sy2web;


    /**
     * sy2web getter
     *
     * @return string
     */
    public function getSy2web()
    {
        return $this->sy2web;
    }


    /**
     * sy2web setter
     *
     * @param string $url
     */
    public function setSy2web($url)
    {
        $this->sy2web = $url;
    }

	/**
	 * Overrides TCPDFBarcode::getBarCodeHTML - this one uses a 1 pixel image (black.gif) instead of CSS background-color.  Some browsers don't print background colors by default.
	 *
	 * Return an HTML representation of barcode.
	 *
	 * @param int    $w     Width of a single bar element in pixels.
	 * @param int    $h     Height of a single bar element in pixels.
	 * @param string $color Foreground color for bar elements (background is transparent).
	 * @param string $label Text to print below barcode.
	 *
 	 * @return string HTML code.
	 */
	public function getBarcodeHTML($w=2, $h=30, $color='black', $label=null)
	{
	    $sy2web = $this->getSy2web();

		$adjH = $h;
		if (!is_null($label)) {
			$adjH += 20;
		}

		$html = '<span style="font-size:0;position:relative;display:block;margin-left:auto;margin-right:auto;width:'.($this->barcode_array['maxw'] * $w).'px;height:'.($adjH).'px;">'."\n";
		// print bars
		$x = 0;
		foreach ($this->barcode_array['bcode'] as $k => $v) {
			$bw = round(($v['w'] * $w), 3);
			$bh = round(($v['h'] * $h / $this->barcode_array['maxh']), 3);
			if ($v['t']) {
				$y = round(($v['p'] * $h / $this->barcode_array['maxh']), 3);
				// draw a vertical bar
				$html .= '<img src="'.$sy2web.'/g4checkin/black.gif" style="width:'.$bw.'px;height:'.$bh.'px;position:absolute;left:'.$x.'px;top:'.$y.'px;" />';
			}
			$x += $bw;
		}
		if (!is_null($label)) {
			$html .= '<span style="position:absolute;font-size:15px;top:'.$h.'px">' . $label . '</span>';
		}
		$html .= '</span>'."\n";
		return $html;
	}
}