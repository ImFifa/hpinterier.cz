<?php declare(strict_types = 1);

namespace App\FrontModule\Presenters;

class RealizationPresenter extends BasePresenter
{

	public function renderDefault(): void
	{

	}

	public function renderShow($slug): void
	{
		$gallery = $this->repository->getGalleryBySlug($slug);

		$this->template->gallery = $gallery;
		$this->template->images = $this->repository->getImagesByGallery($gallery->id);
	}
}
