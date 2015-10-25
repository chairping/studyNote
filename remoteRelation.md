## 远程关系

####Province
    
    namespace App\Http\Model;
    use Illuminate\Database\Eloquent\Model;
    class Province extends  Model
    {
        protected $table = 'province';
        public $timestamps = false;
    
        public function districts() {
            return $this->hasManyThrough(District::class, City::class, 'province_id', 'city_id');
        }
    }
    
###City

    namespace App\Http\Model;
    use Illuminate\Database\Eloquent\Model;
    class City extends  Model
    {
        protected $table = 'city';
        public $timestamps = false;
    }
    
###District

    namespace App\Http\Model;
    use Illuminate\Database\Eloquent\Model;
    class District extends  Model
    {
        protected $table = 'district';
        public $timestamps = false;
    }
    
    
###USE
    
    $province = Province::find(12);
    $a = $province->districts;
    var_dump($a->toArray());