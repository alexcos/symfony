<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Services
 */
namespace G4\UtilBundle\Services;

use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * Captcha 
 */
class Captcha extends ContainerAware
{
    private $apiHost;
    private $apiPort;
    private $apiKey;
    
    protected $container;

    
    /**
     * Initialize member variables
     * 
     * @param unknown $container
     */
    public function init($container) {
        $this->apiHost = $container->getParameter('recaptcha_api_host');
        $this->apiPort = $container->getParameter('recaptcha_api_port');
        $this->apiKey = $container->getParameter('recaptcha_api_key');
        
        $this->container = $container;
    }
	
    
	/**
	 * Verify the captcha submission
	 * 
	 * @param unknown $challenge
	 * @param unknown $response
	 * 
	 * @return boolean
	 */
	public function checkAnswer($challenge, $response, $userIPAddress)
	{
		// g4_service_skip_captcha can be set to bypass captcha in QA environments
		if ($this->container->getParameter('g4_service_skip_captcha')) {
			return true;
		}
		
		if (!$challenge or !$response) {
			return false;
		}
		
		$data = array(
				'privatekey' => $this->apiKey,
				'remoteip'   => $userIPAddress,
				'challenge'  => $challenge,
				'response'   => $response
		);
		
		return $this->httpPost(
				$this->apiHost, 
				$data, 
				$this->apiPort
		);
	}
	
	
	/**
	 * Submits HTTP POST to a recaptcha server
	 *
	 * @param string   $host API url
	 * @param array    $data parameters to recaptcha api
	 * @param int      $port API port
	 *
	 * @return boolean
	 */
	protected function httpPost($host, $data, $port = 80)
	{
		/** @var $service \G4\UtilBundle\ServicesCall */
		$service = $this->container->get('g4_services_call');
		$timeout = $this->container->getParameter('g4_timeout_reswebdefault');

		$service->addPost($host, $timeout, array(), $data, 'recaptcha');
		$serviceResults = $service->execute();

		$response = explode("\n", $serviceResults['recaptcha']);
		return ($response[0] === 'true') ? true : false;
	}
    
}