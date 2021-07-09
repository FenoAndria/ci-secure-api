<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\Response;
use CodeIgniter\HTTP\ResponseInterface;

class Api extends BaseController
{
	/**
	 * Get all Clients
	 * @return Response
	 */
	public function index()
	{
		$this->enregistrementModel->join('services', 'services.id_service = enregistrement.id_service');
		$data = [
			'enregistrements' => $this->enregistrementModel->paginate(5),
			'pager' => $this->enregistrementModel->pager,
		];
		return $this->getResponse($data);
	}

	public function save()
	{
		$this->enregistrementModel->join('services', 'services.id_service = enregistrement.id_service');
		$data = $this->enregistrementModel->paginate(5);
		return $this->request->getMethod();
		// return $this->getResponse($data);
	}
	private function getResponse(array $responseBody, int $code = ResponseInterface::HTTP_OK)
	{
		return $this
			->response
			->setStatusCode($code)
			->setJSON($responseBody);
	}
}
