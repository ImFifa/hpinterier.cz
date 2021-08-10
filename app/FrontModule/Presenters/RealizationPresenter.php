<?php declare(strict_types = 1);

namespace App\FrontModule\Presenters;

use K2D\Gallery\Models\GalleryModel;

class RealizationPresenter extends BasePresenter
{

	/** @inject GalleryModel */
	public GalleryModel $galleryModel;

	public function renderDefault(): void
	{
		$this->template->gallery1 = $this->repository->getImagesByGallery(1);
		$this->template->gallery2 = $this->repository->getImagesByGallery(2);
		$this->template->gallery3 = $this->repository->getImagesByGallery(3);
	}

	public function renderShow($slug): void
	{
		$id = 1;

		if ($slug === 'kancelarsky-nabytek-a-zidle') {
			$id = 1;
		} elseif ($slug === 'podlahy') {
			$id = 2;
		} else {
			$id = 3;
		}

		$gallery = $this->galleryModel->getGallery($id);

		$this->template->gallery = $gallery;
		$this->template->images = $this->repository->getImagesByGallery($gallery->id);
	}
}
