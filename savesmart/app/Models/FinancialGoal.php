<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialGoal extends Model
{
    use HasFactory;

    protected $fillable = ['family_member_id', 'name', 'target_amount', 'target_date', 'saved_amount'];

    public function familyMember()
    {
        return $this->belongsTo(FamilyMember::class);
    }
}