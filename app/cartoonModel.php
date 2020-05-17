<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cartoonModel extends Model
{
    //表
    protected $table = 'photo';
    //主键
    protected $primaryKey = 'id';
    //定义是否能操作时间
    public $timestamps = true;
    //设置字段
    protected $fillable = ['id','name','photo','cartoon','created_at'];

}
