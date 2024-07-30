<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offices extends Model
{
    use HasFactory;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'address',
        'alias',
        'category',
        'city',
        'office_title',
        'telephone_1',
        'telephone_2',
        'telephone_3',
        'telephone_4',
        'email_1',
        'email_2',
        'fax_number',
        'uan_number',
        'status',
    ];

    public static function getOffices()
    {
        $mOffices = [];
        $offices = self::all([
            'address',
            'alias',
            'category',
            'city',
            'office_title',
            'telephone_1',
            'telephone_2',
            'telephone_3',
            'telephone_4',
            'email_1',
            'email_2',
            'fax_number',
            'uan_number',
            'status'
        ]);

        if (!$offices->isEmpty()) {
            foreach ($offices as $se) {
                $mOffices[$se->alias] = [
                    'address' => $se->address,
                    'category' => $se->category,
                    'city' => $se->city,
                    'office_title' => $se->office_title,
                    'telephone_1' => $se->telephone_1,
                    'telephone_2' => $se->telephone_2,
                    'telephone_3' => $se->telephone_3,
                    'telephone_4' => $se->telephone_4,
                    'email_1' => $se->email_1,
                    'email_2' => $se->email_2,
                    'fax_number' => $se->fax_number,
                    'uan_number' => $se->uan_number,
                    'status' => $se->status,
                ];
            }
            return $mOffices;
        } else {
            return 'No office found';
        }
    }
// In your Office model
public static function getAllActiveOffices()
{
    return self::where('status', 1)->get();
}

    public static function getOfficesCount()
    {
        return self::where('status', '=', '1')->count();
    }
}