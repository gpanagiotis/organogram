<?php
    
    namespace App\Models;
    
    use Illuminate\Database\Eloquent\Model;

    class ZLibWorkingPosition extends Model
    {
        
        protected $table = 'z__lib_working_positions';
        
        public static function getList()
        {
            return self::all()->pluck('title', 'id')->sortBy('ordering')->toArray();
        }
        
        
    }
