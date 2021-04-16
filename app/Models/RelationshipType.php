<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Venturecraft\Revisionable\RevisionableTrait;
use Wildside\Userstamps\Userstamps;

class RelationshipType extends Model
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

    public function getTruncatedNameAttribute()
    {
        $name=$this->name;
        $len=mb_strlen($name);
        return $len <= 25 ? $name : mb_substr($name,0,25) . "<span style='bold;background-color:lightgreen;'>&mldr;</span>";
    }

}
