<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MembersModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

class MembersController extends BaseController
{
	use ResponseTrait;

	public function index()
	{
		$memberModel = new MembersModel();
		$members = $memberModel->findAll();
		return $this->getResponse([
			'message' => 'Liste des membres',
			'data' => $members
		]);
	}

	public function create()
	{
		$data = [
			'nom' => $this->request->getPost('nom'),
			'date_naissance' => $this->request->getPost('date_naissance'),
		];
		$rules = [
			'nom' => 'required',
			'date_naissance' => 'required|valid_date',
		];
		$input = $this->getRequestInput($this->request);
		if (!$this->validateRequest($input, $rules)) {
			return $this->getResponse(
				$this->validator->getErrors(),
				ResponseInterface::HTTP_BAD_REQUEST
			);
		}
		$memberEmail = $input['email'];
		$memberModel = new MembersModel();
		$memberInsert = $memberModel->insert($data);
		$member = $memberModel->find($memberInsert);
		return $this->getResponse([
			'message' => 'Membre créé avec succès',
			'data' => $member
		]);
	}

	public function show($id)
	{
		try {
			$memberModel = new MembersModel();
			$member = $memberModel->findMemberById($id);
			// return $this->getResponse('Membre non trouvé');
			return $this->getResponse([
				'message' => 'Membre affiché avec succès',
				'data' => $member
			]);
		} catch (Exception $e) {
			return $this->getResponse(
				[
					'message' => 'Membre non trouvé',
				],
				ResponseInterface::HTTP_NOT_FOUND
			);
		}
		if (!$member) {
		}
	}

	public function update($id)
	{
		$memberModel = new MembersModel();
		if (!$memberModel->find($id)) {
			return $this->failNotFound('Membre non trouvé');
		}
		$input = $this->request->getRawInput();
		$data = [
			'nom' => $input['nom'],
			'date_naissance' => $input['date_naissance'],
		];
		$memberModel->update($id, $data);
		return $this->response->setJSON([
			'message' => 'Membre modifié avec succès',
			'data' => $data
		]);
	}

	public function delete($id)
	{
		$memberModel = new MembersModel();
		// $member = $memberModel->find($id);
		if (!$memberModel->find($id)) {
			return $this->failNotFound('Membre non trouvé');
		}
		$memberModel->delete($id);
		return $this->response->setJSON([
			'message' => 'Membre supprimé avec succès',
		]);
	}
}
