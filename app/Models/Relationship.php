<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class Relationship extends Model
{
    use HasFactory;
    use Userstamps;
    use SoftDeletes;
    use RevisionableTrait;

    protected $revisionEnabled = true;
     
    //Remove old revisions (works only when used with $historyLimit)
    protected $revisionCleanup = true;
    //Stop tracking revisions after 'N' changes have been made.
    protected $historyLimit = 1000;

	protected $revisionForceDeleteEnabled = true;
	protected $revisionCreationsEnabled = true;

    public function author1()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function author2()
    {
        return $this->belongsTo('App\Models\Author');
    }
    public function relationship_type()
    {
        return $this->belongsTo('App\Models\RelationshipType');
    }

}
