<?php
namespace app\admin\validate;
use think\Validate;

class Repairs extends Validate{
    protected $rules=[
        ['name','require','姓名不能为空'],
        ['del','require','电话不能为空'],
        ['addr','require','地址不能为空'],
        ['title','require','标题不能为空'],
        ['content','require','内容不能为空'],
    ];
}