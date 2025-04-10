<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public static function rules($id = 0)
    {
        return [
            'name'        => "required|string|min:1|max:255|unique:departments,name,$id",
            'description' => 'nullable|string',
        ];
    }

    public function doctors()
    {
        return $this->belongsTo(Doctor::class);
    }
}
