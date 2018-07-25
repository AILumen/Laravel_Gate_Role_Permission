<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'slug', 'body', 'user_id',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }


    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }





    ////////////////////////////////////////////////////////


        /*
            Local scopes allow you to define common sets of constraints that you may easily re-use throughout your application. 
            
            For example, you may need to frequently retrieve all users that are considered "popular". To define a scope, prefix an Eloquent model method with scope.
        */
            //LOCAL SCOPE
            /*
                public function scopePopular($query)
                {
                    return $query->where('votes', '>', 100);
                }

                public function scopeActive($query)
                {
                    return $query->where('active', 1);
                }


                //Utilizing A Local Scope

                    $users = App\User::popular()->active()->orderBy('created_at')->get();

            */


            // Dynamic Scopes

                    /*
                        public function scopeOfType($query, $type)
                        {
                            return $query->where('type', $type);
                        }
                    
                        //Utilizing A Dynamic Scope
                            $users = App\User::ofType('admin')->get();
                    */

       
        






    
}
