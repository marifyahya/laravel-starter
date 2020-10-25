<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteOption extends Model
{
    use HasFactory;

    protected $table = 'site_options';
    protected $primaryKey = 'option_id';
    protected $fillable = [
        'option_name',
        'option_value',
        'autoload'
    ];
    public $timestamps = false;

    public static function saveOption($optionName, $optionValue) {
        $option = SiteOption::where('option_name', $optionName)->first();
        if (is_null($option)) {
            SiteOption::create([
                'option_name' => $optionName,
                'option_value' => $optionValue,
                'autoload' => 'yes'
            ]);
        } else {
            $option->update([
                'option_value' => $optionValue,
            ]);
        }

        return;
    }
}
