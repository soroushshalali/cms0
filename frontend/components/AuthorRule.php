<?PHP
namespace frontend\component;

use yii\rbac\Rule;
 
class AuthorRule extends Rule
{

 public $name='isAuthor';

    public function execute($user, $item, $params)
    {
        echo '<pre>';
        echo 'hoi';
        exit();
        return isset($params['post']) ? $params['post']->author_id==$user : false;
    }

}



?>