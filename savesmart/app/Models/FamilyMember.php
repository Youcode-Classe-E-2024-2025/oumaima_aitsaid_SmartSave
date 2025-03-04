<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class FamilyMember extends Model
{
    use HasFactory;

    protected $fillable = ['family_id', 'name', 'password'];

    // Hash the password before saving
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function financialGoals()
    {
        return $this->hasMany(FinancialGoal::class);
    }
}
