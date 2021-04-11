<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class Author extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;
    use RevisionableTrait;

    protected $revisionEnabled = true;
     
    //Remove old revisions (works only when used with $historyLimit)
    protected $revisionCleanup = true;
    //Stop tracking revisions after 'N' changes have been made.
    protected $historyLimit = 10000;

	protected $revisionForceDeleteEnabled = true;
	protected $revisionCreationsEnabled = true;

    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function country2()
    {
        return $this->belongsTo('App\Models\Country', 'country2_id');
    }

    public function quality()
    {
        return $this->belongsTo('App\Models\Quality');
    }

    public function websites()
    {
        return $this->hasMany('App\Models\Website');
    }

    public function signatures()
    {
        return $this->belongsToMany('App\Models\Author', 'signatures', 'author_id', 'signature_id');
    }

    public function references()
    {
        return $this->belongsToMany('App\Models\Author', 'signatures', 'signature_id', 'author_id');
    }

}