<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 08.10.18
 * Time: 12:50
 */

namespace App\Services;

use App\{User, Role, Customer, Detail};
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminViewHelper
{
    protected $menu_name;

    /**
     * Get URI name for admin panel
     *
     * @return string
     */
    public function getAdminMenuName()
    {
        $this->menu_name = $this->menu_name??str_ireplace('admin/','',Request::capture()->path());

        return $this->menu_name;
    }

}