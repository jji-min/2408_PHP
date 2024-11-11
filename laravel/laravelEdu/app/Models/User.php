<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // SoftDeletes 트레이트 : 해당 모델에 소프트딜리트를 적용하고 싶을 때 추가
    // softdelete된거 제외하고 가져옴

    // trait(트레이트)
    // 코드 재사용성을 위한 프로퍼티와 메소드의 그룹
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    // SoftDeletes해줘서 소프트딜리트됨
    // 빼면 물리적 삭제됨

    // 테이블명 정의하는 프로퍼티 (디폴트는 모델명의 복수형)
    protected $table = 'users';
    
    // PK를 지정하는 프로퍼티
    protected $primaryKey = 'u_id'; // protected $primaryKey 는 고정
    // 따로 프로퍼티를 지정하지 않으면 PK가 id라고 자동으로 인식함

    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';

    /**
     * upsert시 변경을 허용할 컬럼들을 설정하는 프로퍼티(화이트리스트)
     */
    protected $fillable = [
        'u_email'
        ,'u_password'
        ,'u_name'
        ,'created_at'
        ,'updated_at'
        ,'deleted_at'
    ];
    /**
     * upsert시 변경을 불허할 컬럼들을 설정하는 프로퍼티(블랙리스트)
     */
    // protected $guarded = [
    //     'id'
    // ];
    // 화이트리스트와 블랙리스트 둘중 하나만 선언하면 됨
    // 둘 다 프로퍼티명 고정
}
