<?PHP
namespace common\component;

use yii\rbac\Rule;
 
class AuthorRule extends Rule
{

 public $name='isAuthor';

    public function execute($user, $item, $params)
    {
        return isset($params['Articles']) ? $params['Articles']->author_id==$user : false;
    }

}



?>