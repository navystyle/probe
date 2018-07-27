<?php

use App\Models\Traits\HiddenCol;
use Base\User as BaseUser;
use Propel\Runtime\Map\TableMap;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser
{
    use HiddenCol {
        toArray as protected toArrayHiddenCol;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'Password', 'ConfirmCode', 'Activated',
    ];

    /**
     * @param string $keyType
     * @param bool $includeLazyLoadColumns
     * @param array $alreadyDumpedObjects
     * @param bool $includeForeignObjects
     * @return array
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {
        $data = $this->toArrayHiddenCol($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, $includeForeignObjects);
        if (is_array($data)) {
//            $data['Role'] = $this->getRole()->toArray();
        }

        return $data;
    }
}
