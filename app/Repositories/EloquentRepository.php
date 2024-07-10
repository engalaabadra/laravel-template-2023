<?php

namespace App\Repositories;

use App\Scopes\ActiveScope;
use App\Scopes\LanguageScope;
use GeneralTrait;
class EloquentRepository
{
    use GeneralTrait;


    public function all($model){
        if(page()) return $this->getPaginatesData($model);
        else return $this->getAllData($model);
    }
    


    public function search($model,$words,$col){
        $modelData = $this->search($model,$words,$col);
        return  $modelData;
    }
    
   public  function trash($model){
       if(is_numeric($this->findAllItemsOnlyTrashed($model))) return 404;
        $modelData = $this->findAllItemsOnlyTrashed($model)->paginate(request()->total);
        return $modelData;
    }


    //methods for store
    public function store($data,$model){
        return $this->action($data,$model);
    }

    public function storeTrans($data,$model,$id){ 
        return $this->action($data,$model,$id);
    }
    
    public function show($id,$model){
        $item = $this->find($model,$id,'id');
        if(is_numeric($item)){
            return 404;
        }
        return $item;
    }

    public function update($data,$id,$model){
        return $this->action($data,$model,$id);
    }

    //methods for restoring
    public function restore($id,$model){
        $item = $this->findItemOnlyTrashed($id,$model);//get this item from trash 
        if(is_numeric($item)) return 404; //this item not found in trash to restore it
        else $item->restore();
        return $item;
        
    }

    public function restoreAll($model){
        $items = $this->findAllItemsOnlyTrashed($model);//get  items  from trash
        if(is_numeric($items)) return 404;
        else $items->restore();//restore all items from trash into items table
        return $items;    
    }

    //methods for deleting(with softdelete)
    public function destroy($id,$model){
        $forceDelete=0;
        return $this->deleteItem($id,$model,$forceDelete);
    }

    public function forceDelete($id,$model){
        $forceDelete=1;
        return $this->deleteItem($id,$model,$forceDelete);
    }
    //method normal delete(no softdelete)
    public function delete($id,$model){
        return $this->normalDeleteItem($id,$model);
    }
    //method change activate
    public function changeActivate($id,$model){
        return $this->changeActivateItem($id,$model);
    }
    
}

