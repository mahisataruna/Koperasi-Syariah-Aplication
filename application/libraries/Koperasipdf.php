<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once('assets/dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

class Koperasipdf
{
	protected $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
	}

	public function generate($view, $data = array(), $filename = 'Laporan', $paper = 'A4', $orientation = 'portrait')
	{
		$options = new Options();
		$options->setIsRemoteEnabled(true);
		$dompdf = new Dompdf();
		$html = $this->ci->load->view($view, $data, TRUE);
		$dompdf->loadHtml(utf8_decode($html));
		$dompdf->set_option('isRemoteEnabled', TRUE);
		$dompdf->setPaper($paper, $orientation);

		$dompdf->render();
		$dompdf->stream($filename . '.pdf', array("Attachment" => FALSE));
	}
}