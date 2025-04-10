<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'role_user');
    }
    public function abilities() 
    {
        return $this->hasMany(RoleAbility::class);
    }


    public static function rules()
    {
        return [
            'name'      => 'required|string|max:255',
            'abilities' => 'required|array',
        ];
    }

    public static function createWithAbilities(Request $request)
    {
        $role = Role::create([
            'name' => $request->post('name'),
        ]);

        foreach ($request->post('abilities') as $ability => $value) {
            RoleAbility::create([
                'role_id'    => $role->id,
                'ability' => $ability,
                'type'       => $value,
            ]);
        }

        return $role;

    }

    public function updateWithAbilities(Request $request)
    {
        $this->update([
            'name' => $request->post('name'),
        ]);

        foreach ($request->post('abilities') as $ability => $value) {
            RoleAbility::UpdateORCreate([
                'role_id'    => $this->id,
                'ability' => $ability,
            ], [
                'type' => $value,
            ]);
        }

        return $this;
    }
}
