<?php


class Post extends Eloquent
{
    public function user()
    {
        return $this->belongsTo('User');
    }

    protected $fillable = array('user_id', 'title', 'body');
    protected $guarded = array('id', 'created_at', 'updated_at');
}