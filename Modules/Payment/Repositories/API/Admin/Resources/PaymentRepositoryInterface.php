<?php
namespace Modules\Payment\Repositories\API\Admin\Resources;

interface PaymentRepositoryInterface
{
   public function store($request,$model);
   public function update($request,$id,$model);

}
