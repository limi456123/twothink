<?php
namespace app\admin\validate;
use think\Validate;

class Repairs extends Validate{
    protected $rules=[
        ['name','require','��������Ϊ��'],
        ['del','require','�绰����Ϊ��'],
        ['addr','require','��ַ����Ϊ��'],
        ['title','require','���ⲻ��Ϊ��'],
        ['content','require','���ݲ���Ϊ��'],
    ];
}