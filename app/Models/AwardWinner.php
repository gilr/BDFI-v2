<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class AwardWinner extends Model
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

    protected $dontKeepRevisionOf = ['deleted_by'];

    public function award_category()
    {
        return $this->belongsTo('App\Models\AwardCategory');
    }
    public function award()
    {
        return $this->belongsTo('App\Models\Award');
    }
    public function author()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function author2()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function author3()
    {
        return $this->belongsTo('App\Models\Author');
    }
    
}
