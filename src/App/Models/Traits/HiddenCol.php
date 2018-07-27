<?php
namespace App\Models\Traits;

use Propel\Runtime\Map\TableMap;

trait HiddenCol
{
    /**
     * toArray 사용시 hidden field 를 제외 시켜줌
     *
     * @param string $keyType
     * @param bool $includeLazyLoadColumns
     * @param array $alreadyDumpedObjects
     * @param bool $includeForeignObjects
     * @return array
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        if (is_null($keyType)) {
            $tableMap = self::TABLE_MAP;
            $keyType = $tableMap::TYPE_PHPNAME;
        }

        $array = parent::toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, $includeForeignObjects);

        if (property_exists($this, 'hidden') && is_array($this->hidden)) {
            foreach ($this->hidden as $column) {
                if (is_array($array) && array_key_exists($column, $array)) {
                    unset($array[$column]);
                }
            }
        }

        return $array;
    }
}