<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Lx\Storage\StorageInterface;

class DvdsController extends BaseController
{
	/**
	 * @var StorageInterface
	 */
	private $storage;

	/**
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		parent::__construct($request);
		$this->storage = app()->make('StorageDvds');
	}

	public function add()
	{
		try {
			$result = $this->storage->insert([
				'dvdId' => $this->readInput('id'),
				'dvdTitle' => $this->readInput('title'),
				'dvdLocation' => $this->readInput('location')
			]);

			if ($result) {
				return $this->apiResponseSuccess();
			}
		} catch (\Exception $e) {
		}

		return $this->apiResponseFailure();
	}

	public function update($id)
	{
		try {
			$result = $this->storage->update([
				'dvdLocation' => $this->readInput('location')
			], $id);

			if ($result) {
				return $this->apiResponseSuccess();
			}
		} catch (\Exception $e) {
		}

		return $this->apiResponseFailure();
	}

	public function delete($id)
	{
		try {
			$result = $this->storage->delete($id);

			if ($result) {
				return $this->apiResponseSuccess();
			}
		} catch (\Exception $e) {
		}

		return $this->apiResponseFailure();
	}

	public function listAll()
	{
		try {
			$result = $this->storage->getList();

			if ($result) {
				return $this->apiResponseSuccess($result);
			}
		} catch (\Exception $e) {
		}

		return $this->apiResponseFailure();
	}

	public function searchByField($field, $value)
	{
		// prepare input
		$field = 'dvd' . ucwords($field);
		$value = urldecode($value);

		try {
			$resultSet = [];

			foreach ($this->storage->getList() as $item) {
				if (isset($item[$field]) && $item[$field] === $value) {
					$resultSet[] = $item;
				}
			}

			return $this->apiResponseSuccess($resultSet);

		} catch (\Exception $e) {
		}

		return $this->apiResponseFailure();
	}
}
