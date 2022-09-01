<?php

namespace App\Models;

use CodeIgniter\Model;

class Enregistrement extends Model
{
	protected $table = 'Enregistrement';
	protected $primaryKey = 'id_enregistrement';
	protected $allowedFields = ['id_enregistrement', 'id_service', 'quantite', 'prix_unitaire', 'total', 'created_ats'];

	public function dailyEvaluation(int $jour)
	{
		$date = date('Y-m-d', strtotime($jour . " days"));
		$this->select();
		$this->where('DATE(created_at)', $date);
		$query = $this->get();
		$data['liste'] = $query->getResult();
		if ($data['liste']) {
			$this->select('SUM(quantite * prix_unitaire) AS total');
			$this->where('DATE(created_at)', $date);
			$queryTotal = $this->get();
			$data['total'] = $queryTotal->getRow()->total;
			return $data;
		}
	}
	public function weeklyEvaluation(String $jour)
	{
		$toMonday = 1 - date("N", strtotime($jour));
		$monday = date("Y-m-d", strtotime($jour . " " . $toMonday . " days"));
		$saturday = date("Y-m-d", strtotime($monday . " +5 days"));
		$this->select();
		$this->where("DATE(created_at) BETWEEN '" . $monday . "' AND '" . $saturday . "'");
		$query = $this->get();
		$data['liste'] = $query->getResult();
		if ($data['liste']) {
			$this->select('SUM(quantite * prix_unitaire) AS total');
			$this->where("DATE(created_at) BETWEEN '" . $monday . "' AND '" . $saturday . "'");
			$queryTotal = $this->get();
			$data['total'] = $queryTotal->getRow()->total;
			return $data;
		}
	}
	public function monthlyEvaluation( $mois)
	{
		$this->select();
		$this->where("MONTH(created_at)", $mois);
		$this->join('services', 'services.id_service = enregistrement.id_service');
		$query = $this->get();
		$data['liste'] = $query->getResult();
		if ($data['liste']) {
			$this->select('SUM(quantite * prix_unitaire) AS total');
			$this->where("MONTH(created_at)", $mois);
			$queryTotal = $this->get();
			$data['total'] = $queryTotal->getRow()->total;
			return $data;
		}
	}
}
