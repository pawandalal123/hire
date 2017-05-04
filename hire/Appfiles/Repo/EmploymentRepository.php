<?php
namespace Appfiles\Repo;

use Appfiles\Repo\EmploymentInterface;
use Illuminate\Container\Container as App;
use App\Model\Employment_details;

//echo "in here";
/**
 * Order Details Repository
 */
class EmploymentRepository implements EmploymentInterface
{
	use RepositoryTrait;

	protected $model,$app;
    /**
     * Order Details Repository
     */
    public function __construct(App $app)
    {
  
    	$this->app=$app;
    	$this->makeModel();  
    }

    public function getBy($condition, $columns = array('*')) {

        return Employment_details::where($condition)->first($columns);
    }
     public function getByRaw($condition, $columns = array('*')) {

        return Employment_details::whereRaw($condition)->first($columns);
    }

    public function getallBy($condition, $columns = array('*'))
    {
        return Employment_details::where($condition)->get($columns);
    }
     public function update(array $data, $condition) {
      
          $Employment_details = Employment_details::where($condition)->update($data);
          return $Employment_details;
    }
    public function getListraw($condition, $key,$value)
    {
        
        return Employment_details::where($condition)->lists($key,$value)->all();
    }
    public function delete($id) 
  {
    
        return Employment_details::destroy($id);
  }
    function model()
    {
        return 'App\Model\Employment_details';
    }
}
?>