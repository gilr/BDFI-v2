<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class Website extends Model
{
    use HasFactory;
    use SoftDeletes;
    use RevisionableTrait;
    use Userstamps;

    protected $revisionEnabled = true;
     
    //Remove old revisions (works only when used with $historyLimit)
    protected $revisionCleanup = true;
    //Stop tracking revisions after 'N' changes have been made.
    protected $historyLimit = 100;

	protected $revisionForceDeleteEnabled = true;
	protected $revisionCreationsEnabled = true;

    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function website_type()
    {
        return $this->belongsTo('App\Models\WebsiteType');
    }
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }

}
