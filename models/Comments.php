<?php
/**
 * Created by PhpStorm.
 * User: Роман
 * Date: 10.03.2022
 * Time: 9:46
 */

namespace app\models;


class Comments extends Model
{
    protected static $fields = [
        'fio',
        'email',
        'text',
        'created_at',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->tableName = "comments";
        $this->entityClass = Comments::class;
    }
}