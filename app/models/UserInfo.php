<?php

use Robbo\Presenter\PresentableInterface;

class UserInfo extends Eloquent implements PresentableInterface{

    /**
     * Get the comment's content.
     *
     * @return string
     */

    protected $table = 'user_infos';

   
    public function getPresenter()
    {
        return new CommentPresenter($this);
    }

    public function user(){
        return $this->belongsTo('User');
    }
}
