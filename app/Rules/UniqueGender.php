<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueGender implements ValidationRule
{
    protected string $electorsTable;
    protected string $temposTable;
   protected  int $voterId;
    public function __construct(int $voterId, string $electorsTable = 'electors', string $temposTable = 'tempos')
    {
        $this->electorsTable = $electorsTable;
        $this->temposTable = $temposTable;
        $this->voterId=$voterId;
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Get gender from elector_id (passed as $value)
        $gender = DB::table($this->electorsTable)
            ->where('id', $value)
            ->value('gender');
        if (!$gender) {
            $fail('Gender not found for the selected elector.');
            return;
        }
         $exists = DB::table($this->temposTable)
        ->join($this->electorsTable, "{$this->electorsTable}.id", '=', "{$this->temposTable}.elector_id")
        ->where("{$this->electorsTable}.gender", $gender)
        ->where("{$this->temposTable}.voter_id", $this->voterId)
        ->exists();
        if ($exists) {
            $fail("A student with gender '$gender' already exists.");
        }
    }
}
