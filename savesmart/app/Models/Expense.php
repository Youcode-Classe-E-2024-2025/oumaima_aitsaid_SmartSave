<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = ['family_member_id', 'category_id', 'amount', 'date', 'description'];

    public function familyMember()
    {
        return $this->belongsTo(FamilyMember::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}