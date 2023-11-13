<?php
namespace Modules\Board\Repositories\API\Admin\Resources;

interface BoardRepositoryInterface
{
   public function store($request,$model);
   public function update($request,$id,$model);

}
