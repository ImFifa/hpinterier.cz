<?php

namespace App\Service;

use K2D\Core\Models\ConfigurationModel;
use K2D\Core\Models\LogModel;
use K2D\Core\Service\ModelRepository;
use K2D\Gallery\Models\GalleryModel;
use K2D\Gallery\Models\ImageModel;
use Nette\Database\Table\ActiveRow;

/**
 * @property-read GalleryModel $gallery
 * @property-read ImageModel $image
 */

class ProjectModelRepository extends ModelRepository
{
	public function getGalleryById(int $id): ActiveRow
	{
		return $this->gallery->getTable()->where("id", $id)->fetch();
	}

	public function getImagesByGallery(int $id): array
	{
		return $this->image->getTable()->where("gallery_id", $id)->order("position")->fetchAll();
	}


}
