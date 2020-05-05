<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helpers\MainHelper;

class TagResource extends Model {
  public static $idField = NULL;
  public static function createTag($value, $tag) {
    $attrs = array();
    $attrs[self::$idField] = $value;
    $attrs['tag'] = $tag;
    return parent::create( $attrs );
  }
  public static function getAllCurrentTags($value) {
    return $this->where(self::$idField, $value)->get();
  }
  public static function updateModelTags($tags, $value) {
        $all = self::getAllCurrentTags($value);
        foreach ($tags as $tag) {
            $current = FALSE;
            foreach ($all as $item) {
                if ($item->tag == $tag) {
                    $current = $item;
                    break;
                }
            }
            if (!$current) {
                self::createTag( $value, $tag );
            }
        }
      foreach ($all as $tag) {
          $found = FALSE;
          foreach ($tags as $item) {
            if ($item == $tag->tag) {
              $found = TRUE;
            }
          }
          if (!$found) {
            $tag->delete();
          }
      }

  }
}


