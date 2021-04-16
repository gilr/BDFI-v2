<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class Website extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;
    use RevisionableTrait;

    protected $revisionEnabled = true;
     
    //Remove old revisions (works only when used with $historyLimit)
    protected $revisionCleanup = true;
    //Stop tracking revisions after 'N' changes have been made.
    protected $historyLimit = 100;

	protected $revisionForceDeleteEnabled = true;
	protected $revisionCreationsEnabled = true;

    protected $dontKeepRevisionOf = ['deleted_by'];

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

    public function getTruncatedUrlAttribute()
    {
        $url = $this->url;
        $len = mb_strlen($url);
        return $len <= 50 ? $url : mb_substr($url,0,50) . "<span style='bold;background-color:lightgreen;'>&mldr;</span>";
    }

}
